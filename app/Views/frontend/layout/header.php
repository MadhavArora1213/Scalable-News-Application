<?php
$tr = Core\LanguageHelper::getTranslations($lang);
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Khabran News') ?></title>
    
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
        
        <!-- Local SEO Schema for Homepage -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsMediaOrganization",
          "name": "Khabran News",
          "url": "<?= SITE_URL ?>",
          "logo": "<?= SITE_URL ?>/assets/images/logo.png",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Ludhiana",
            "addressRegion": "Punjab",
            "addressCountry": "IN"
          },
          "areaServed": ["Punjab", "India"]
        }
        </script>
    <?php endif; ?>

    <!-- Styles -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body lang="<?= $lang ?>">

    <!-- Breaking News Banner -->
    <div style="background-color: var(--brand-red); color: white; display: flex; align-items: center; padding: 6px 20px; font-size: 0.85rem; border-bottom: 1px solid rgba(0,0,0,0.1); font-family: var(--font-nav);">
        <div style="background-color: var(--accent-orange); color: white; padding: 2px 12px; font-weight: 700; border-radius: var(--radius-badge); margin-right: 15px; white-space: nowrap; letter-spacing: 1px; font-size: 0.75rem;">
            <?= $lang == 'pa' ? 'ਤਾਜ਼ਾ ਖ਼ਬਰਾਂ:' : ($lang == 'hi' ? 'ब्रेकिंग न्यूज़:' : 'BREAKING:') ?>
        </div>
        <div style="overflow: hidden; white-space: nowrap; width: 100%;">
            <marquee behavior="scroll" direction="left" scrollamount="6" style="padding-top: 3px; font-weight: 500;">
                Latest Update: New industrial policy for Ludhiana announced to boost MSME sector &nbsp;&nbsp;&bull;&nbsp;&nbsp; Alert: Schools in Amritsar and Gurdaspur to remain closed tomorrow &nbsp;&nbsp;&bull;&nbsp;&nbsp; Sports: Punjab Kings secure thrilling victory in final over.
            </marquee>
        </div>
    </div>

    <!-- Top Utility Bar -->
    <div class="utility-bar">
        <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; padding: 0 20px; width: 100%;">
            <div class="utility-social">
                <a href="#" class="yt"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="tw"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="ig"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="fb"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="wa"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <div style="display: flex; align-items: center; letter-spacing: 1px; color: #666; font-size: 0.75rem;">
                <span id="live-date"><?= Core\LanguageHelper::getFormattedDate($lang) ?></span>
                <div class="utility-divider"></div>
                <span id="live-clock" style="font-weight: 800; color: var(--ink-black);">00:00:00</span>
            </div>
            <div>
                <a href="<?= SITE_URL ?>/<?= $lang ?>/support" class="btn-support"><?= $tr['support_us'] ?></a>
            </div>
        </div>
    </div>

    <!-- Masthead -->
    <header class="masthead">
        <div class="lang-switcher">
            <a href="<?= SITE_URL ?>/pa" class="lang-pill <?= $lang == 'pa' ? 'active' : '' ?>">ਪੰਜਾਬੀ</a>
            <a href="<?= SITE_URL ?>/hi" class="lang-pill <?= $lang == 'hi' ? 'active' : '' ?>">हिन्दी</a>
            <a href="<?= SITE_URL ?>/en" class="lang-pill <?= $lang == 'en' ? 'active' : '' ?>">English</a>
        </div>
        <a href="<?= SITE_URL ?>/<?= $lang ?>" style="text-decoration: none;"><h1 class="masthead-logo">ਖ਼ਬਰਾਂ</h1></a>
    </header>

    <!-- Navigation -->
    <?php
        $navDb = \Core\Database::getInstance();
        
        // Fetch main categories
        $navStmt = $navDb->query("SELECT * FROM categories ORDER BY sort_order ASC, id ASC LIMIT 8");
        $navCategories = $navStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Fetch all subcategories from the separate subcategories table
        $subStmt = $navDb->query("SELECT * FROM subcategories ORDER BY sort_order ASC, id ASC");
        $subCategories = $subStmt->fetchAll(PDO::FETCH_ASSOC);
        $subCatGrouped = [];
        foreach($subCategories as $sub) {
            $subCatGrouped[$sub['category_id']][] = $sub;
        }
    ?>
    <nav class="main-nav">
        <div class="nav-container">
            <div class="nav-item <?= $_SERVER['REQUEST_URI'] == SITE_URL.'/'.$lang || $_SERVER['REQUEST_URI'] == '/news/Scalable-News-Application/public/' ? 'active' : '' ?>">
                <a href="<?= SITE_URL ?>/<?= $lang ?>" class="nav-link"><?= $tr['home'] ?? 'Home' ?></a>
            </div>
            <?php foreach($navCategories as $cat): ?>
            <?php $hasSub = isset($subCatGrouped[$cat['id']]); ?>
            <div class="nav-item <?= $hasSub ? 'has-dropdown' : '' ?> <?= strpos($_SERVER['REQUEST_URI'], '/'.$cat['slug']) !== false ? 'active' : '' ?>">
                <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $cat['slug'] ?>" class="nav-link">
                    <?= htmlspecialchars($cat['name_'.$lang] ?? $cat['name_en']) ?>
                </a>
                <?php if($hasSub): ?>
                <div class="dropdown-menu">
                    <?php foreach($subCatGrouped[$cat['id']] as $sub): ?>
                        <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $sub['slug'] ?>" class="dropdown-link">
                            <?= htmlspecialchars($sub['name_'.$lang] ?? $sub['name_en']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            
            <div style="margin-left: auto; display: flex; align-items: center; padding-left: 20px;">
                <form action="<?= SITE_URL ?>/<?= $lang ?>/search" method="GET" style="display: flex; position: relative;">
                    <input type="text" name="q" placeholder="<?= $lang == 'pa' ? 'ਖੋਜ...' : ($lang == 'hi' ? 'खोजें...' : 'Search...') ?>" style="padding: 6px 30px 6px 12px; border: 1px solid #ddd; border-radius: 20px; font-size: 0.85rem; outline: none; width: 160px; font-family: inherit;">
                    <button type="submit" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #666;"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
