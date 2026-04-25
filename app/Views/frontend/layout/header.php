<?php
$tr = Core\LanguageHelper::getTranslations($lang);
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Khabran News') ?> - Leading Independent News</title>
    
    <!-- SEO Meta Tags -->
    <?php if(isset($article)): ?>
        <meta name="description" content="<?= htmlspecialchars($article['meta_desc'] ?: $article['excerpt']) ?>">
        <meta property="og:title" content="<?= htmlspecialchars($article['title']) ?>">
        <meta property="og:image" content="<?= (strpos($article['image_path'], 'http') === 0) ? $article['image_path'] : SITE_URL . '/' . $article['image_path'] ?>">
        <link rel="canonical" href="<?= SITE_URL ?>/<?= $lang ?>/<?= $article['category_slug'] ?? 'news' ?>/<?= $article['slug'] ?>">
        
        <!-- NewsArticle JSON-LD Schema -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "headline": "<?= htmlspecialchars($article['title']) ?>",
          "image": [
            "<?= (strpos($article['image_path'], 'http') === 0) ? $article['image_path'] : SITE_URL . '/' . $article['image_path'] ?>"
          ],
          "datePublished": "<?= date('c', strtotime($article['published_at'])) ?>",
          "dateModified": "<?= date('c', strtotime($article['updated_at'] ?? $article['published_at'])) ?>",
          "author": [{
              "@type": "Person",
              "name": "<?= htmlspecialchars($article['author_name'] ?? 'Editor') ?>"
          }],
          "publisher": {
            "@type": "Organization",
            "name": "Khabran News",
            "logo": {
              "@type": "ImageObject",
              "url": "<?= SITE_URL ?>/assets/images/logo.png"
            }
          }
        }
        </script>
    <?php else: ?>
        <meta name="description" content="Khabran: Leading 3-language news portal covering Punjab, India, and the World.">
    <?php endif; ?>

    <!-- Styles -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body lang="<?= $lang ?>">

    <!-- Top Utility Bar -->
    <div class="top-utility">
        <div class="section-container container">
            <div class="utility-left">
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
            <div class="utility-right">
                <div class="lang-switcher" style="display: flex; gap: 15px; font-weight: 700; border-right: 1px solid var(--border); padding-right: 20px;">
                    <a href="<?= SITE_URL ?>/pa" style="<?= $lang == 'pa' ? 'color: var(--accent);' : '' ?>">ਪੰਜਾਬੀ</a>
                    <a href="<?= SITE_URL ?>/hi" style="<?= $lang == 'hi' ? 'color: var(--accent);' : '' ?>">हिन्दी</a>
                    <a href="<?= SITE_URL ?>/en" style="<?= $lang == 'en' ? 'color: var(--accent);' : '' ?>">English</a>
                </div>
                <a href="<?= SITE_URL ?>/<?= $lang ?>/subscribe" class="btn-subscribe">Subscribe</a>
                <a href="#" id="search-toggle"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </div>

    <!-- Masthead -->
    <header class="masthead">
        <div class="section-container">
            <a href="<?= SITE_URL ?>/<?= $lang ?>">
                <h1><?= $lang == 'pa' ? 'ਖ਼ਬਰਾਂ' : ($lang == 'hi' ? 'ख़बरें' : 'Khabran') ?></h1>
            </a>
            <p style="margin-top: 8px; font-size: 0.9rem; letter-spacing: 2px; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">
                <?= date('F d, Y') ?> &nbsp; | &nbsp; <?= $lang == 'pa' ? 'ਪੰਜਾਬ ਦੀ ਆਵਾਜ਼' : ($lang == 'hi' ? 'पंजाब की आवाज़' : 'Voice of Punjab') ?>
            </p>
        </div>
    </header>

    <!-- Navigation -->
    <?php
        $navDb = \Core\Database::getInstance();
        $navStmt = $navDb->query("SELECT * FROM categories ORDER BY sort_order ASC, id ASC LIMIT 10");
        $navCategories = $navStmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <nav class="main-nav">
        <div class="section-container nav-container">
            <a href="<?= SITE_URL ?>/<?= $lang ?>" class="nav-link <?= $_SERVER['REQUEST_URI'] == SITE_URL.'/'.$lang ? 'active' : '' ?>"><?= $tr['home'] ?? 'Home' ?></a>
            <?php foreach($navCategories as $cat): ?>
                <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $cat['slug'] ?>" class="nav-link">
                    <?= htmlspecialchars($cat['name_'.$lang] ?? $cat['name_en']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </nav>

    <!-- Breaking News Ticker -->
    <div class="ticker-bar">
        <div class="section-container ticker-wrap">
            <span class="ticker-label">Breaking</span>
            <marquee behavior="scroll" direction="left" scrollamount="6">
                Latest: New industrial policy for Ludhiana announced &nbsp;&nbsp;&bull;&nbsp;&nbsp; Alert: Schools in Amritsar to remain closed tomorrow &nbsp;&nbsp;&bull;&nbsp;&nbsp; Sports: Punjab Kings secure victory.
            </marquee>
        </div>
    </div>
