<?php

/**
 * Front controller (svision-style routing). The nginx config rewrites every
 * URL that is not an existing file to /index.php?<path>, so the query string
 * carries the requested page:
 *
 *   /              -> index.php?               -> home page
 *   /manic-miner   -> index.php?manic-miner    -> game detail page
 *   /anything-else -> index.php?anything-else  -> 404
 *
 * Tracking parameters appended by social networks and similar
 * (?fbclid=..., ?utm_source=...) are key=value pairs; they are not part of
 * the page path and are ignored. A game page with such a parameter is
 * redirected to its canonical URL.
 */

$query = rawurldecode($_SERVER['QUERY_STRING'] ?? '');
$parts = explode('&', $query);
$query = (strpos($parts[0], '=') === false) ? $parts[0] : '';
$extra = (count($parts) > 1 || $query === '') && $_SERVER['QUERY_STRING'] !== '';
$path  = trim($query, '/');

// Base URL of the deployment, svision-style: derived from the request so the
// site works both in production (https://retrogames.free/) and in test mode
// under a path prefix (e.g. https://willy2.shipard.pro:34444/retrogames/).
$webProtocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host        = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'];
$basePath    = preg_replace('~index\.php$~', '', $_SERVER['PHP_SELF']);
$webURL      = $webProtocol . '://' . $host . $basePath;

$games = require __DIR__ . '/inc/games.php';

if ($path === '') {
  require __DIR__ . '/inc/home-page.php';
}
elseif (isset($games[$path])) {
  if ($query !== $path || $extra) {
    // Canonicalize /manic-miner/ and /manic-miner?fbclid=... -> /manic-miner
    // so each page has one URL.
    header('Location: ' . $basePath . $path, true, 301);
    exit;
  }
  $slug = $path;
  require __DIR__ . '/inc/game-page.php';
}
else {
  require __DIR__ . '/inc/not-found-page.php';
}
