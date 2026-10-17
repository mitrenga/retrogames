# retrogames.free

A small portal for classic retro games playable in the browser — from Matthew Smith's
ZX Spectrum platformers to the arcade icons of Taito, Namco, Atari and Nintendo.
Live at **https://retrogames.free**.

An unofficial fan project. All rights to the original games belong to their original authors.

## What's inside

A single-page site in plain PHP/HTML/CSS/JS — no framework, no build step.

```
index.php          the whole page (game cards, history timeline, feedback form)
sendFeedback.php   feedback endpoint — e-mails the message via SMTP
css/style.css      the stylesheet
js/main.js         progressive enhancements (mobile nav, scroll reveal, form submit)
images/            game covers (real gameplay screenshots, 800×500) + favicon
config.json        local configuration — NOT in git, see below
sitemap.xml, robots.txt
```

## Local development

```sh
php -S localhost:8000
```

and open http://localhost:8000.

## Configuration

Copy `config.json.sample` to `config.json` and fill in:

- `feedback.to` — address that receives messages from the contact form
- `smtp` — host/port/user/password/from for sending mail (works with Gmail and an
  app password); when `smtp.host` is empty, the local MTA via `mail()` is used instead

`config.json` contains credentials and is gitignored — never commit it.

## Feedback form anti-spam

Three lightweight, self-hosted layers (no third-party captcha):

1. honeypot field — bots fill it and get a fake success
2. time-trap — the form carries an HMAC-signed render timestamp; submissions faster
   than 4 seconds are rejected
3. rate limit — at most 5 messages per IP per hour

## Adding a game

Copy one `<article class="game-card">` block in `index.php`, add an 800×500 cover to
`images/`, and add the game to the JSON-LD `ItemList` in the page head. Eyebrow label
colours cycle automatically by card position.
