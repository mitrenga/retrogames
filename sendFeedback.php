<?php
// Feedback endpoint — e-mails the submitted message to the address configured in
// config.json ("feedback.to"). Delivery works exactly like in the gallery project:
// the "smtp" section of config.json feeds a minimal SMTP client (implicit TLS +
// AUTH LOGIN), with the local MTA via mail() as a fallback.
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST only']);
    exit;
}

$config = json_decode((string)@file_get_contents(__DIR__ . '/config.json'), true) ?: [];
$to = trim((string)($config['feedback']['to'] ?? ''));

// accepts both fetch() JSON and a plain HTML form post (no-JS fallback)
$isJson = str_contains($_SERVER['CONTENT_TYPE'] ?? '', 'application/json');
$body = $isJson ? (json_decode(file_get_contents('php://input'), true) ?? []) : $_POST;

$name = trim((string)($body['name'] ?? ''));
$email = trim((string)($body['email'] ?? ''));
$message = trim((string)($body['message'] ?? ''));
$honeypot = trim((string)($body['website'] ?? ''));   // hidden field, humans leave it empty

$reply = function (int $code, array $payload) use ($isJson): void {
    if (!$isJson && $code < 400) {          // plain form post: go back to the page
        header('Location: ./?sent=1#feedback', true, 303);
        exit;
    }
    http_response_code($code);
    echo json_encode($payload);
    exit;
};

if ($honeypot !== '') {
    $reply(200, ['ok' => true]);            // pretend success to bots
}

// time-trap: index.php embeds a signed timestamp of when the form was rendered;
// a missing/forged token means a bot, a too-fast submit means a bot as well
$tsKey = ($config['smtp']['password'] ?? '') . __DIR__;
[$ts, $sig] = array_pad(explode('.', (string)($body['ts'] ?? ''), 2), 2, '');
if ($ts === '' || !hash_equals(hash_hmac('sha256', $ts, $tsKey), $sig)) {
    $reply(200, ['ok' => true]);            // forged token: pretend success to bots
}
if ((int)$ts > time() - 4) {
    $reply(400, ['error' => 'that was quick! please take a moment and try again']);
}
if ((int)$ts < time() - 86400) {
    $reply(400, ['error' => 'this page was open for too long, please reload it and try again']);
}
if ($to === '') {
    $reply(500, ['error' => 'feedback address is not configured']);
}
if ($name === '' || $message === '' || mb_strlen($name) > 200 || mb_strlen($message) > 5000
    || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $reply(400, ['error' => 'please fill in your name, a valid e-mail and a message']);
}

// at most 5 messages per IP and hour – a cheap brake on mail spamming (same idea as gallery)
$RATE_FILE = sys_get_temp_dir() . '/retrogames-feedback-' . md5(__DIR__) . '.json';
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$now = time();
$log = is_file($RATE_FILE) ? (json_decode(file_get_contents($RATE_FILE), true) ?: []) : [];
$log = array_values(array_filter($log, fn($e) => ($e['time'] ?? 0) > $now - 3600));
if (count(array_filter($log, fn($e) => ($e['ip'] ?? '') === $ip)) >= 5) {
    $reply(429, ['error' => 'too many messages, please try again later']);
}
$log[] = ['ip' => $ip, 'time' => $now];
file_put_contents($RATE_FILE, json_encode($log), LOCK_EX);

$subject = '=?UTF-8?B?' . base64_encode("Retro Games – message from $name") . '?=';
$text = "Name: $name\n"
      . "E-mail: $email\n"
      . "IP: $ip\n"
      . "Page: https://retrogames.free/\n\n"
      . $message . "\n";

if (!empty($config['smtp']['host'])) {
    $sent = smtpSend($config['smtp'], $to, $subject, $text);
} else {   // fallback: local MTA via mail()
    $host = preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? 'localhost');
    $sent = mail($to, $subject, $text,
        "From: retrogames@$host\r\nReply-To: $email\r\nContent-Type: text/plain; charset=utf-8");
}

$sent ? $reply(200, ['ok' => true]) : $reply(500, ['error' => 'sending failed, please try again later']);

// Minimal SMTP client (implicit TLS + AUTH LOGIN) – works with Gmail using an
// app password; the "smtp" section of config.json provides host/port/user/password/from.
function smtpSend(array $smtp, string $to, string $subject, string $body): bool {
    $host = (string)($smtp['host'] ?? '');
    $port = (int)($smtp['port'] ?? 465);
    $from = (string)($smtp['from'] ?? $smtp['user'] ?? '');
    $fp = @stream_socket_client("ssl://$host:$port", $errno, $errstr, 15);
    if (!$fp) return false;
    stream_set_timeout($fp, 15);

    // reads a (possibly multi-line) reply and checks the status code
    $expect = function (string $code) use ($fp): bool {
        do { $line = fgets($fp, 1024); } while ($line !== false && isset($line[3]) && $line[3] === '-');
        return $line !== false && str_starts_with($line, $code);
    };
    $send = function (string $cmd, string $code) use ($fp, $expect): bool {
        fwrite($fp, $cmd . "\r\n");
        return $expect($code);
    };

    $body = preg_replace('/\r?\n/', "\r\n", $body);
    $body = str_replace("\r\n.", "\r\n..", $body);   // SMTP dot-stuffing

    $ok = $expect('220')
        && $send('EHLO retrogames', '250')
        && $send('AUTH LOGIN', '334')
        && $send(base64_encode((string)($smtp['user'] ?? '')), '334')
        && $send(base64_encode((string)($smtp['password'] ?? '')), '235')
        && $send("MAIL FROM:<$from>", '250')
        && $send("RCPT TO:<$to>", '250')
        && $send('DATA', '354')
        && $send("From: $from\r\nTo: $to\r\nSubject: $subject\r\n"
               . "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8\r\n\r\n"
               . $body . "\r\n.", '250');
    fwrite($fp, "QUIT\r\n");
    fclose($fp);
    return $ok;
}
