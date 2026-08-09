<?php
/**
 * Shared template for game detail pages. Included by the front controller
 * (index.php) with $slug set and inc/games.php already loaded in $games.
 */
$games = $games ?? require __DIR__ . '/games.php';

if (!isset($slug, $games[$slug])) {
  http_response_code(404);
  exit('Unknown game.');
}

$g   = $games[$slug];
$url = $webURL . $slug;
$img = $webURL . 'images/' . $g['cover'];
$B   = htmlspecialchars($basePath);
$videoGame = [
  '@context'      => 'https://schema.org',
  '@type'         => 'VideoGame',
  'name'          => $g['name'],
  'url'           => $url,
  'image'         => $img,
  'description'   => $g['description'],
  'datePublished' => $g['year'],
  'genre'         => $g['genre'],
  'gamePlatform'  => $g['platform'],
  'playMode'      => 'SinglePlayer',
  'publisher'     => ['@type' => 'Organization', 'name' => $g['publisher']],
];
if ($g['author']) {
  $videoGame['author'] = ['@type' => 'Person', 'name' => $g['author']];
}

$breadcrumbs = [
  '@context'        => 'https://schema.org',
  '@type'           => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Games', 'item' => $webURL],
    ['@type' => 'ListItem', 'position' => 2, 'name' => $g['name'], 'item' => $url],
  ],
];

$jsonFlags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($g['title']) ?></title>
  <meta name="description" content="<?= htmlspecialchars($g['description']) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($url) ?>">
  <link rel="icon" type="image/svg+xml" href="<?= $B ?>images/favicon.svg">

  <!-- Open Graph / social sharing -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Retro Games">
  <meta property="og:title" content="<?= htmlspecialchars($g['title']) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($g['description']) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($url) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($img) ?>">
  <meta property="og:image:width" content="800">
  <meta property="og:image:height" content="500">
  <meta property="og:image:alt" content="<?= htmlspecialchars($g['coverAlt']) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:image" content="<?= htmlspecialchars($img) ?>">

  <!-- Fonts (self-hosted, declared in css/style.css) -->
  <link rel="preload" href="<?= $B ?>fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= $B ?>fonts/space-grotesk-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= $B ?>fonts/press-start-2p-latin.woff2" as="font" type="font/woff2" crossorigin>

  <link rel="stylesheet" href="<?= $B ?>css/style.css">

  <!-- Structured data -->
  <script type="application/ld+json">
<?= json_encode($videoGame, $jsonFlags) ?>

  </script>
  <script type="application/ld+json">
<?= json_encode($breadcrumbs, $jsonFlags) ?>

  </script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>

  <header class="site-header">
    <div class="container site-header__inner">
      <a class="logo" href="<?= $B ?>">
        <span class="stripe stripe--badge" aria-hidden="true"></span>
        RETRO<em>.</em>GAMES
      </a>
      <button class="nav-toggle" aria-expanded="false" aria-controls="site-nav">Menu</button>
      <nav id="site-nav" class="site-nav" aria-label="Main navigation">
        <ul>
          <li><a href="<?= $B ?>#games">Games</a></li>
          <li><a href="<?= $B ?>#story">The Story</a></li>
          <li><a href="<?= $B ?>#feedback">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main">
    <article class="section game-detail">
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb">
          <a href="<?= $B ?>#games">Games</a> <span aria-hidden="true">/</span> <?= htmlspecialchars($g['name']) ?>
        </nav>

        <div class="game-detail__hero">
          <div class="game-detail__intro">
            <p class="eyebrow"><?= htmlspecialchars($g['year']) ?> · <?= htmlspecialchars($g['publisher']) ?></p>
            <h1><?= htmlspecialchars($g['name']) ?></h1>
            <p class="hero__lead"><?= htmlspecialchars($g['lead']) ?></p>
            <div class="hero__actions">
              <a class="btn btn--primary" href="<?= htmlspecialchars($g['playUrl']) ?>" rel="external">Play now — it's free</a>
              <?php if ($g['aboutUrl']): ?>
              <a class="btn btn--grey" href="<?= htmlspecialchars($g['aboutUrl']) ?>" rel="external">About this remake</a>
              <?php endif; ?>
            </div>
            <dl class="specs">
              <div><dt>Year</dt><dd><?= htmlspecialchars($g['year']) ?></dd></div>
              <div><dt>Genre</dt><dd><?= htmlspecialchars($g['genre']) ?></dd></div>
              <div><dt>Original</dt><dd><?= htmlspecialchars($g['original']) ?></dd></div>
              <?php if ($g['author']): ?>
              <div><dt>Author</dt><dd><?= htmlspecialchars($g['author']) ?></dd></div>
              <?php endif; ?>
            </dl>
          </div>
          <img src="<?= $B ?>images/<?= htmlspecialchars($g['cover']) ?>"
               alt="<?= htmlspecialchars($g['coverAlt']) ?>"
               width="800" height="500" fetchpriority="high">
        </div>

        <div class="game-detail__body">
          <?php foreach ($g['body'] as $paragraph): ?>
          <p><?= $paragraph ?></p>
          <?php endforeach; ?>
        </div>

        <div class="game-detail__footer-actions">
          <a class="btn btn--primary" href="<?= htmlspecialchars($g['playUrl']) ?>" rel="external">Play <?= htmlspecialchars($g['name']) ?> now</a>
          <a class="btn" href="<?= $B ?>#games">← All games</a>
        </div>
      </div>
    </article>
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

  <script src="<?= $B ?>js/main.js" defer></script>
</body>
</html>
