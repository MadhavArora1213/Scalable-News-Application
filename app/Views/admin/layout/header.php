<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - Khabran</title>
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+Gurmukhi:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php if(empty($hide_sidebar)): ?>
    <?php require __DIR__ . '/sidebar.php'; ?>

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
