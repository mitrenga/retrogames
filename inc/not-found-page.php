<?php
/** 404 page, served by the front controller for unknown paths. */
http_response_code(404);
$B = htmlspecialchars($basePath ?? '/');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page not found — Retro Games</title>
  <meta name="robots" content="noindex">
  <link rel="icon" type="image/svg+xml" href="<?= $B ?>images/favicon.svg">

  <!-- Fonts (self-hosted, declared in css/style.css) -->
  <link rel="preload" href="<?= $B ?>fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= $B ?>fonts/space-grotesk-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= $B ?>fonts/press-start-2p-latin.woff2" as="font" type="font/woff2" crossorigin>

  <link rel="stylesheet" href="<?= $B ?>css/style.css">
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>

  <header class="site-header">
    <div class="container site-header__inner">
      <a class="logo" href="<?= $B ?>">
        <span class="stripe stripe--badge" aria-hidden="true"></span>
        RETRO<em>.</em>GAMES
      </a>
    </div>
  </header>

  <main id="main">
    <section class="section">
      <div class="container">
        <header class="section__head">
          <p class="eyebrow">Error 404</p>
          <h1>R Tape loading error, 0:1</h1>
          <p>This page doesn't exist — maybe the tape got chewed.
             Rewind and try one of the games instead.</p>
        </header>
        <div class="hero__actions">
          <a class="btn btn--primary" href="<?= $B ?>#games">Choose a game</a>
          <a class="btn" href="<?= $B ?>">Back to the homepage</a>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container site-footer__inner">
      <div>
        <p><strong>RETRO.GAMES</strong> — an unofficial fan project.</p>
        <p>All rights to the original games belong to their original authors.</p>
      </div>
      <div>
        <p><a href="https://github.com/mitrenga/retrogames" rel="external">Project on GitHub</a></p>
        <p>© 2026 retrogames.free</p>
      </div>
    </div>
  </footer>
</body>
</html>
