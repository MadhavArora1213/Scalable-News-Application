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
        <meta property="og:image" content="<?= SITE_URL ?>/<?= $article['image_path'] ?>">
    <?php else: ?>
        <meta name="description" content="Khabran: Leading 3-language news portal covering Punjab, India, and the World.">
    <?php endif; ?>

    <!-- Styles -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body lang="<?= $lang ?>">

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
    <nav class="main-nav">
        <div class="nav-container">
            <div class="nav-item <?= $_SERVER['REQUEST_URI'] == SITE_URL.'/'.$lang ? 'active' : '' ?>">
                <a href="<?= SITE_URL ?>/<?= $lang ?>" class="nav-link"><?= $tr['home'] ?></a>
            </div>
            <div class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/politics') !== false ? 'active' : '' ?>">
                <a href="<?= SITE_URL ?>/<?= $lang ?>/politics" class="nav-link"><?= $tr['politics'] ?></a>
            </div>
            <div class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/punjab') !== false ? 'active' : '' ?>">
                <a href="<?= SITE_URL ?>/<?= $lang ?>/punjab" class="nav-link"><?= $tr['ground_reports'] ?></a>
            </div>
            <div class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/economy') !== false ? 'active' : '' ?>">
                <a href="<?= SITE_URL ?>/<?= $lang ?>/economy" class="nav-link"><?= $tr['economy'] ?></a>
            </div>
            <div class="nav-item">
                <a href="<?= SITE_URL ?>/<?= $lang ?>/district/amritsar" class="nav-link">Amritsar</a>
            </div>
            <!-- More dynamic categories can be added here -->
        </div>
    </nav>
