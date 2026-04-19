<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - Khabran</title>
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

    <?php if(empty($hide_sidebar)): ?>
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-logo">ਖ਼ਬਰਾਂ News</div>
        
        <nav class="sidebar-nav">
            <a href="<?= SITE_URL ?>/admin/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="<?= SITE_URL ?>/admin/articles" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'articles') && !strpos($_SERVER['REQUEST_URI'], 'new') ? 'active' : '' ?>">
                <i class="fas fa-newspaper"></i> All Articles
            </a>
            <a href="<?= SITE_URL ?>/admin/articles/new" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'articles/new') ? 'active' : '' ?>">
                <i class="fas fa-pen-nib"></i> New Article
            </a>
            <a href="<?= SITE_URL ?>/admin/categories" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'categories') ? 'active' : '' ?>">
                <i class="fas fa-tags"></i> Categories
            </a>
            <a href="<?= SITE_URL ?>/admin/media" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'media') ? 'active' : '' ?>">
                <i class="fas fa-photo-video"></i> Media Library
            </a>
            <div style="padding: 15px 30px; font-size: 0.7rem; color: #4a5568; font-weight: 800; text-transform: uppercase;">Engagement</div>
            <a href="<?= SITE_URL ?>/admin/breaking" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'breaking') ? 'active' : '' ?>">
                <i class="fas fa-bolt"></i> Breaking Ticker
            </a>
            <a href="<?= SITE_URL ?>/admin/subscribers" class="nav-link">
                <i class="fas fa-envelope-open-text"></i> Newsletters
            </a>
            <div style="padding: 15px 30px; font-size: 0.7rem; color: #4a5568; font-weight: 800; text-transform: uppercase;">Growth & Ops</div>
            <a href="<?= SITE_URL ?>/admin/seo" class="nav-link">
                <i class="fas fa-search-dollar"></i> SEO Manager
            </a>
            <a href="<?= SITE_URL ?>/admin/analytics" class="nav-link">
                <i class="fas fa-microchip"></i> Analytics
            </a>
            <a href="<?= SITE_URL ?>/admin/settings" class="nav-link">
                <i class="fas fa-cog"></i> System Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= SITE_URL ?>/admin/logout" class="nav-link" style="padding: 10px 0; color: #f56565;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="admin-top-nav">
            <div class="user-profile">
                <span>Admin User</span>
                <div class="user-avatar"></div>
            </div>
        </header>
        <main>
    <?php endif; ?>
