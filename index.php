<?php
// Signed timestamp for the feedback form's time-trap: submissions arriving
// faster than a human could type are rejected by sendFeedback.php.
$cfgForTs = json_decode((string)@file_get_contents(__DIR__ . '/config.json'), true) ?: [];
$tsKey = ($cfgForTs['smtp']['password'] ?? '') . __DIR__;
$tsNow = time();
$tsToken = $tsNow . '.' . hash_hmac('sha256', (string)$tsNow, $tsKey);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Retro Games — Classic ZX Spectrum Games Playable in Your Browser</title>
  <meta name="description" content="Play faithful browser remakes of classic 8-bit games — Manic Miner, Jet Set Willy, Pac-Man, Space Invaders, Boulder Dash and more. No installation, no emulator, free retro gaming from the golden era.">
  <link rel="canonical" href="https://retrogames.free/">
  <link rel="icon" type="image/svg+xml" href="images/favicon.svg">

  <!-- Open Graph / social sharing -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Retro Games">
  <meta property="og:title" content="Retro Games — Classic ZX Spectrum Games in Your Browser">
  <meta property="og:description" content="Play faithful browser remakes of Manic Miner, Jet Set Willy, Pac-Man, Space Invaders and more. No installation, pure 8-bit nostalgia.">
  <meta property="og:url" content="https://retrogames.free/">
  <meta name="twitter:card" content="summary">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&family=Press+Start+2P&display=swap">

  <link rel="stylesheet" href="css/style.css">

  <!-- Structured data: website + the list of playable games -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Retro Games",
    "url": "https://retrogames.free/",
    "description": "Browser remakes of classic ZX Spectrum games. An unofficial fan project; all rights belong to the original authors.",
    "inLanguage": "en"
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Playable ZX Spectrum game remakes",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "item": {
          "@type": "VideoGame",
          "name": "Manic Miner",
          "url": "https://manicminer.free",
          "author": { "@type": "Person", "name": "Matthew Smith" },
          "publisher": { "@type": "Organization", "name": "Bug-Byte" },
          "datePublished": "1983",
          "gamePlatform": ["ZX Spectrum", "Web browser"],
          "genre": "Platform game",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 2,
        "item": {
          "@type": "VideoGame",
          "name": "Jet Set Willy",
          "url": "https://jetsetwilly.free",
          "author": { "@type": "Person", "name": "Matthew Smith" },
          "publisher": { "@type": "Organization", "name": "Software Projects" },
          "datePublished": "1984",
          "gamePlatform": ["ZX Spectrum", "Web browser"],
          "genre": "Platform game",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 3,
        "item": {
          "@type": "VideoGame",
          "name": "Jetpac",
          "url": "https://freejetpac.org/",
          "publisher": { "@type": "Organization", "name": "Ultimate Play the Game" },
          "datePublished": "1983",
          "gamePlatform": ["ZX Spectrum", "Web browser"],
          "genre": "Shooter",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 4,
        "item": {
          "@type": "VideoGame",
          "name": "Boulder Dash",
          "url": "https://boulder-dash.com/bd1/",
          "author": { "@type": "Person", "name": "Peter Liepa" },
          "publisher": { "@type": "Organization", "name": "First Star Software" },
          "datePublished": "1984",
          "gamePlatform": ["Atari 8-bit", "Web browser"],
          "genre": "Puzzle action",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 5,
        "item": {
          "@type": "VideoGame",
          "name": "Boulder Dash II",
          "url": "https://boulder-dash.com/bd2/",
          "publisher": { "@type": "Organization", "name": "First Star Software" },
          "datePublished": "1985",
          "gamePlatform": ["Atari 8-bit", "Web browser"],
          "genre": "Puzzle action",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 6,
        "item": {
          "@type": "VideoGame",
          "name": "Space Invaders",
          "url": "https://freeinvaders.org/",
          "author": { "@type": "Person", "name": "Tomohiro Nishikado" },
          "publisher": { "@type": "Organization", "name": "Taito" },
          "datePublished": "1978",
          "gamePlatform": ["Arcade", "Web browser"],
          "genre": "Shooter",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 7,
        "item": {
          "@type": "VideoGame",
          "name": "Pac-Man",
          "url": "https://freepacman.org/",
          "author": { "@type": "Person", "name": "Toru Iwatani" },
          "publisher": { "@type": "Organization", "name": "Namco" },
          "datePublished": "1980",
          "gamePlatform": ["Arcade", "Web browser"],
          "genre": "Maze chase",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 8,
        "item": {
          "@type": "VideoGame",
          "name": "Asteroids",
          "url": "https://freeasteroids.org/",
          "publisher": { "@type": "Organization", "name": "Atari" },
          "datePublished": "1979",
          "gamePlatform": ["Arcade", "Web browser"],
          "genre": "Shooter",
          "playMode": "SinglePlayer"
        }
      },
      {
        "@type": "ListItem",
        "position": 9,
        "item": {
          "@type": "VideoGame",
          "name": "Donkey Kong",
          "url": "https://freekong.org/",
          "author": { "@type": "Person", "name": "Shigeru Miyamoto" },
          "publisher": { "@type": "Organization", "name": "Nintendo" },
          "datePublished": "1981",
          "gamePlatform": ["Arcade", "Web browser"],
          "genre": "Platform game",
          "playMode": "SinglePlayer"
        }
      }
    ]
  }
  </script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>

  <header class="site-header">
    <div class="container site-header__inner">
      <a class="logo" href="/">
        <span class="stripe stripe--badge" aria-hidden="true"></span>
        RETRO<em>.</em>GAMES
      </a>
      <button class="nav-toggle" aria-expanded="false" aria-controls="site-nav">Menu</button>
      <nav id="site-nav" class="site-nav" aria-label="Main navigation">
        <ul>
          <li><a href="#games">Games</a></li>
          <li><a href="#story">The Story</a></li>
          <li><a href="#feedback">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main">
    <!-- ================= Hero ================= -->
    <section class="hero container">
      <p class="eyebrow">Arcade · ZX Spectrum · 8-bit classics</p>
      <h1>Classic 8-bit games, <span class="accent">playable in your browser</span>.</h1>
      <p class="hero__lead">
        Faithful remakes of legendary games from the golden age of arcades and 8-bit
        home computing — ZX Spectrum, Atari, Commodore and more. No installation,
        just press play.
      </p>
      <div class="hero__actions">
        <a class="btn btn--primary" href="#games">Choose a game</a>
        <a class="btn" href="#story">Read the story</a>
      </div>
      <div class="tapeload" role="presentation"></div>
    </section>

    <!-- ================= Games ================= -->
    <section id="games" class="section">
      <div class="container">
        <header class="section__head" data-reveal>
          <p class="eyebrow eyebrow--yellow">01 — Pick a game</p>
          <h2>The games</h2>
          <p>Legendary games of the 8-bit era — from Matthew Smith's ZX Spectrum
             platformers to the arcade icons of Taito, Namco, Atari and Nintendo —
             all playable for free in any modern browser.</p>
        </header>

        <div class="game-grid">
          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://manicminer.free" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/manic-miner-cover.png" alt="Manic Miner screenshot: Miner Willy in the Central Cavern with red platforms, keys and the air supply bar" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1983<br>Bug-Byte</p>
              <h3><a href="https://manicminer.free" rel="external">Manic Miner</a></h3>
              <p class="game-card__desc">
                Guide Miner Willy through twenty deadly caverns, collect every flashing
                item and reach the exit before the air runs out. The game that defined
                the British platformer.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1983</dd></div>
                <div><dt>Genre</dt><dd>Platformer</dd></div>
                <div><dt>Original</dt><dd>ZX Spectrum</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://manicminer.free" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://jetsetwilly.free" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/jet-set-willy-cover.png" alt="Jet Set Willy screenshot: The Bathroom room of Willy's mansion at 7:00am" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1984<br>Software Projects</p>
              <h3><a href="https://jetsetwilly.free" rel="external">Jet Set Willy</a></h3>
              <p class="game-card__desc">
                The morning after a wild party, Willy must tidy every room of his sprawling
                mansion before his housekeeper Maria lets him go to bed. Sixty rooms of
                pixel-perfect peril.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1984</dd></div>
                <div><dt>Genre</dt><dd>Platformer</dd></div>
                <div><dt>Original</dt><dd>ZX Spectrum</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://jetsetwilly.free" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://freejetpac.org/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/jetpac-cover.png" alt="Jetpac screenshot: Jetman assembling his rocket on green platforms while aliens swarm around" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1983<br>Ultimate Play the Game</p>
              <h3><a href="https://freejetpac.org/" rel="external">Jetpac</a></h3>
              <p class="game-card__desc">
                Rebuild and refuel your rocket while blasting waves of aliens as jetpack-wearing
                Jetman. The first hit from Ultimate Play the Game — the legendary studio that
                later became Rare.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1983</dd></div>
                <div><dt>Genre</dt><dd>Shooter</dd></div>
                <div><dt>Original</dt><dd>ZX Spectrum</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://freejetpac.org/" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://boulder-dash.com/bd1/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/boulder-dash-cover.png" alt="Boulder Dash screenshot: classic Commodore 64 title screen by Peter Liepa" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1984<br>First Star Software</p>
              <h3><a href="https://boulder-dash.com/bd1/" rel="external">Boulder Dash</a></h3>
              <p class="game-card__desc">
                Dig through caves as Rockford, collect diamonds — and don't get crushed by the
                boulders your own digging sets loose. Peter Liepa's physics-puzzle masterpiece,
                born on the Atari 8-bit computers.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1984</dd></div>
                <div><dt>Genre</dt><dd>Puzzle action</dd></div>
                <div><dt>Original</dt><dd>Atari 8-bit</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://boulder-dash.com/bd1/" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://boulder-dash.com/bd2/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/boulder-dash-2-cover.png" alt="Boulder Dash II screenshot: title screen with Rockford artwork by First Star Software" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1985<br>First Star Software</p>
              <h3><a href="https://boulder-dash.com/bd2/" rel="external">Boulder Dash II</a></h3>
              <p class="game-card__desc">
                Rockford returns in the official sequel: new caves, nastier layouts and even
                trickier boulder physics. Everything that made the original great, turned up
                a notch.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1985</dd></div>
                <div><dt>Genre</dt><dd>Puzzle action</dd></div>
                <div><dt>Original</dt><dd>Atari 8-bit</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://boulder-dash.com/bd2/" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://freeinvaders.org/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/space-invaders-cover.png" alt="Space Invaders screenshot: alien formation descending toward shields and the player cannon" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1978<br>Taito</p>
              <h3><a href="https://freeinvaders.org/" rel="external">Space Invaders</a></h3>
              <p class="game-card__desc">
                Tomohiro Nishikado's alien-blasting phenomenon that launched the arcade golden
                age — so popular it was blamed for a coin shortage in Japan. One cannon,
                five rows of invaders, no mercy.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1978</dd></div>
                <div><dt>Genre</dt><dd>Shooter</dd></div>
                <div><dt>Original</dt><dd>Arcade</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://freeinvaders.org/" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://freepacman.org/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/pac-man-cover.png" alt="Pac-Man screenshot: Pac-Man eating dots in the blue maze while four ghosts hunt him" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1980<br>Namco</p>
              <h3><a href="https://freepacman.org/" rel="external">Pac-Man</a></h3>
              <p class="game-card__desc">
                Toru Iwatani's maze-chase masterpiece and the most recognisable video game
                character ever made. Gobble every dot and outsmart four ghosts — each with
                its own devious personality.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1980</dd></div>
                <div><dt>Genre</dt><dd>Maze chase</dd></div>
                <div><dt>Original</dt><dd>Arcade</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://freepacman.org/" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://freeasteroids.org/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/asteroids-cover.png" alt="Asteroids screenshot: the player's vector ship surrounded by three drifting asteroid outlines" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1979<br>Atari</p>
              <h3><a href="https://freeasteroids.org/" rel="external">Asteroids</a></h3>
              <p class="game-card__desc">
                Atari's vector-graphics classic: spin, thrust and blast asteroids into
                ever-smaller shards while flying saucers hunt you down. Pure physics,
                pure panic — inertia never felt so dangerous.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1979</dd></div>
                <div><dt>Genre</dt><dd>Shooter</dd></div>
                <div><dt>Original</dt><dd>Arcade</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://freeasteroids.org/" rel="external">Play now</a>
              </div>
            </div>
          </article>

          <article class="game-card" data-reveal>
            <a class="game-card__media" href="https://freekong.org/" rel="external" aria-hidden="true" tabindex="-1">
              <img src="images/donkey-kong-cover.png" alt="Donkey Kong screenshot: first girder level with Kong and Pauline at the top and Mario below" width="800" height="500" loading="lazy">
            </a>
            <div class="game-card__body">
              <p class="eyebrow">1981<br>Nintendo</p>
              <h3><a href="https://freekong.org/" rel="external">Donkey Kong</a></h3>
              <p class="game-card__desc">
                Shigeru Miyamoto's barrel-jumping arcade platformer — the game that saved
                Nintendo's American arcade business and introduced the world to a little
                jumping hero later known as Mario.
              </p>
              <dl class="specs">
                <div><dt>Year</dt><dd>1981</dd></div>
                <div><dt>Genre</dt><dd>Platformer</dd></div>
                <div><dt>Original</dt><dd>Arcade</dd></div>
              </dl>
              <div class="game-card__actions">
                <a class="btn btn--primary" href="https://freekong.org/" rel="external">Play now</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ================= The Retro Games Story ================= -->
    <section id="story" class="section">
      <div class="container">
        <header class="section__head" data-reveal>
          <p class="eyebrow eyebrow--magenta">02 — A little history</p>
          <h2>The Retro Games Story</h2>
          <p>From a physicist's oscilloscope to the last days of the 8-bit home computer —
             four decades that invented video games as we know them.</p>
        </header>

        <ol class="timeline">
          <li data-reveal>
            <h3><span class="timeline__era">1958–62</span>The pioneers</h3>
            <p>Physicist William Higinbotham wires up <em>Tennis for Two</em> on an
               oscilloscope, and MIT students create <em>Spacewar!</em> on a PDP-1
               mainframe. Video games are born in the laboratory, years before anyone
               imagines selling them.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">1971–72</span>Games go commercial</h3>
            <p>Nolan Bushnell's Atari puts <em>Pong</em> into bars and arcades, and the
               Magnavox Odyssey — built on Ralph Baer's "Brown Box" — becomes the first
               home console. For the first time, you can pay to play.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">1977</span>The cartridge revolution</h3>
            <p>The Atari 2600 brings interchangeable game cartridges into the living room.
               One machine, endless games — the model that still defines consoles today.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">1978–82</span>The arcade golden age</h3>
            <p><em>Space Invaders</em>, <em>Pac-Man</em> and <em>Donkey Kong</em> turn
               arcades into a cultural phenomenon that out-earns Hollywood. Taito, Namco
               and Nintendo become legends; a coin shortage hits Japan.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">1982</span>The home computer boom</h3>
            <p>Sir Clive Sinclair's ZX Spectrum (from £125) and the Commodore 64 bring
               programmable machines to millions of homes. In Britain, a generation of
               bedroom coders starts writing games at the kitchen table.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">1983–86</span>Crash and cassette gold</h3>
            <p>The North American console market collapses under a flood of poor games.
               Meanwhile Europe's cassette scene thrives: Matthew Smith's
               <em>Manic Miner</em> and <em>Jet Set Willy</em> define the British
               platformer on the Spectrum.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">1985–89</span>Consoles strike back</h3>
            <p>Nintendo's NES and <em>Super Mario Bros.</em> revive the console industry,
               while the 16-bit Amiga, Atari ST and Sega Mega Drive raise the bar for
               graphics and sound. The 8-bit machines begin to bow out.</p>
          </li>
          <li data-reveal>
            <h3><span class="timeline__era">The 1990s</span>End of an era</h3>
            <p>The SNES, <em>Doom</em> on the PC and finally the PlayStation close the
               chapter on the 8-bit age. But its games never die — emulators and remakes
               keep the classics one click away, which is exactly why this site exists.</p>
          </li>
        </ol>
      </div>
    </section>

    <!-- ================= Feedback ================= -->
    <section id="feedback" class="section">
      <div class="container">
        <header class="section__head" data-reveal>
          <p class="eyebrow eyebrow--green">03 — Get in touch</p>
          <h2>Suggest a game</h2>
          <p>Know a great browser remake that is missing from the list? Found a bug,
             or just want to say hello? Drop us a line.</p>
        </header>

        <form class="feedback-form" action="sendFeedback.php" method="post" data-reveal>
          <div class="feedback-form__row">
            <label>
              Your name
              <input type="text" name="name" required maxlength="200" autocomplete="name">
            </label>
            <label>
              Your e-mail
              <input type="email" name="email" required autocomplete="email">
            </label>
          </div>
          <label>
            Message
            <textarea name="message" required rows="6" maxlength="5000"
                      placeholder="For example: a link to a game that belongs on this list…"></textarea>
          </label>
          <!-- honeypot: humans never see or fill this field -->
          <label class="feedback-form__hp" aria-hidden="true">
            Website
            <input type="text" name="website" tabindex="-1" autocomplete="off">
          </label>
          <!-- time-trap: signed timestamp of when the form was rendered -->
          <input type="hidden" name="ts" value="<?= htmlspecialchars($tsToken) ?>">
          <div class="feedback-form__actions">
            <button class="btn btn--primary" type="submit">Send message</button>
            <p class="feedback-form__status" role="status" aria-live="polite"></p>
          </div>
        </form>
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

  <script src="js/main.js" defer></script>
</body>
</html>
