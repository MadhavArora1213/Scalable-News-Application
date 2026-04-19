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
        <div class="sidebar-logo">ਖ਼ਬਰਾਂ NEWS</div>
        
        <nav class="sidebar-nav">
            <a href="<?= SITE_URL ?>/admin/dashboard" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-group-label">Core Editorial</div>
            <a href="<?= SITE_URL ?>/admin/articles" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'articles') && !strpos($_SERVER['REQUEST_URI'], 'new') ? 'active' : '' ?>">
                <i class="fas fa-file-invoice"></i> All Articles
            </a>
            <a href="<?= SITE_URL ?>/admin/articles/new" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'articles/new') ? 'active' : '' ?>">
                <i class="fas fa-plus-circle"></i> New Draft
            </a>
            <a href="<?= SITE_URL ?>/admin/categories" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'categories') ? 'active' : '' ?>">
                <i class="fas fa-folder-tree"></i> Categories
            </a>
            <a href="<?= SITE_URL ?>/admin/media" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'media') ? 'active' : '' ?>">
                <i class="fas fa-images"></i> Media Assets
            </a>

            <div class="nav-group-label">Audience Growth</div>
            <a href="<?= SITE_URL ?>/admin/breaking" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'breaking') ? 'active' : '' ?>">
                <i class="fas fa-bolt"></i> Live Ticker
            </a>
            <a href="<?= SITE_URL ?>/admin/subscribers" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'subscribers') ? 'active' : '' ?>">
                <i class="fas fa-mail-bulk"></i> Newsletter
            </a>
            <a href="<?= SITE_URL ?>/admin/seo" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'seo') ? 'active' : '' ?>">
                <i class="fas fa-search-dollar"></i> Global SEO
            </a>
            <a href="<?= SITE_URL ?>/admin/analytics" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'analytics') ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Performance
            </a>

            <div class="nav-group-label">System Admin</div>
            <a href="<?= SITE_URL ?>/admin/users" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'users') ? 'active' : '' ?>">
                <i class="fas fa-user-shield"></i> Staff Team
            </a>
            <a href="<?= SITE_URL ?>/admin/settings" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'settings') ? 'active' : '' ?>">
                <i class="fas fa-sliders-h"></i> Site Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= SITE_URL ?>/admin/logout" class="logout-btn">
                <i class="fas fa-power-off"></i> Logout
            </a>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="admin-top-nav">
            <div class="user-profile">
                <div style="text-align: right; margin-right: 12px;">
                    <span style="display:block; font-weight: 700; font-size: 0.9rem;">Admin User</span>
                    <span style="display:block; font-size: 0.75rem; color: #a0aec0;">Super Authority</span>
                </div>
                <div class="user-avatar" style="background: var(--admin-primary); color: white; display:flex; align-items:center; justify-content:center; font-weight:900;">A</div>
            </div>
        </header>
        <main>
    <?php endif; ?>
