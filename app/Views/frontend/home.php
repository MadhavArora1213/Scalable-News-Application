<?php require 'layout/header.php'; ?>

<div class="hero-section">
    <div class="section-container">
        <div class="hero-grid">
            <!-- Main Story -->
            <main class="hero-main">
                <?php if($hero): ?>
                <a href="<?= SITE_URL ?>/<?=$lang?>/<?= $hero['category_slug'] ?? 'news' ?>/<?=$hero['slug']?>" class="featured-card">
                    <div class="featured-image" style="background-image: url('<?= !empty($hero['image_path']) ? ((strpos($hero['image_path'], 'http') === 0) ? $hero['image_path'] : SITE_URL . '/' . $hero['image_path']) : SITE_URL . '/assets/images/default-news.png' ?>');"></div>
                    <h1 class="featured-title"><?= htmlspecialchars($hero['title']) ?></h1>
                    <p class="featured-excerpt"><?= htmlspecialchars($hero['excerpt']) ?></p>
                    <div style="font-weight: 800; font-size: 0.8rem; text-transform: uppercase; color: var(--accent);">
                        <?= htmlspecialchars($hero['category_name'] ?? 'News') ?> &nbsp; | &nbsp; <?= date('M d, Y', strtotime($hero['published_at'] ?? 'now')) ?>
                    </div>
                </a>
                <?php endif; ?>
            </main>

            <!-- Sidebar Stories -->
            <aside class="hero-sidebar">
                <h2 class="sidebar-title">Top Stories</h2>
                <?php foreach(array_slice($latest, 0, 4) as $item): ?>
                <a href="<?= SITE_URL ?>/<?=$lang?>/<?= $item['category_slug'] ?? 'news' ?>/<?=$item['slug']?>" class="mini-card">
                    <div class="thumb" style="background-image: url('<?= !empty($item['image_path']) ? ((strpos($item['image_path'], 'http') === 0) ? $item['image_path'] : SITE_URL . '/' . $item['image_path']) : SITE_URL . '/assets/images/default-news.png' ?>');"></div>
                    <div>
                        <h3 class="title"><?= htmlspecialchars($item['title']) ?></h3>
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 5px;"><?= date('M d, Y', strtotime($item['published_at'] ?? 'now')) ?></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </aside>
        </div>
    </div>
</div>

<!-- Grid Section -->
<section class="section-block">
    <div class="section-container">
        <div class="block-header">
            <h2>Recent News</h2>
            <a href="#" class="see-all">View All</a>
        </div>
        <div class="grid-3">
            <?php foreach($grid as $item): ?>
            <a href="<?= SITE_URL ?>/<?=$lang?>/<?= $item['category_slug'] ?? 'news' ?>/<?=$item['slug']?>" class="standard-card">
                <div class="card-thumb" style="background-image: url('<?= !empty($item['image_path']) ? ((strpos($item['image_path'], 'http') === 0) ? $item['image_path'] : SITE_URL . '/' . $item['image_path']) : SITE_URL . '/assets/images/default-news.png' ?>');"></div>
                <span class="author-name"><?= htmlspecialchars($item['category_name']) ?></span>
                <h3 class="card-title"><?= htmlspecialchars($item['title']) ?></h3>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Opinion Section -->
<section class="opinion-section">
    <div class="section-container">
        <div class="block-header">
            <h2>Opinion</h2>
            <a href="#" class="see-all">View All</a>
        </div>
        <div class="opinion-grid">
            <?php foreach($opinions as $op): ?>
            <a href="<?= SITE_URL ?>/<?=$lang?>/opinion/<?=$op['slug']?>" class="opinion-card">
                <div class="author-avatar">
                    <img src="<?= SITE_URL ?>/assets/images/avatar.png" alt="Author">
                </div>
                <span class="author-name"><?= htmlspecialchars($op['author_name'] ?? 'Guest Columnist') ?></span>
                <h3 class="opinion-title">"<?= htmlspecialchars($op['title']) ?>"</h3>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Politics Section -->
<section class="section-block">
    <div class="section-container">
        <div class="block-header">
            <h2>Politics</h2>
            <a href="#" class="see-all">View All</a>
        </div>
        <div class="grid-3">
            <?php foreach(array_slice($politics, 0, 3) as $p): ?>
            <a href="<?= SITE_URL ?>/<?=$lang?>/<?= $p['category_slug'] ?? 'politics' ?>/<?=$p['slug']?>" class="standard-card">
                <div class="card-thumb" style="background-image: url('<?= !empty($p['image_path']) ? ((strpos($p['image_path'], 'http') === 0) ? $p['image_path'] : SITE_URL . '/' . $p['image_path']) : SITE_URL . '/assets/images/default-news.png' ?>');"></div>
                <h3 class="card-title"><?= htmlspecialchars($p['title']) ?></h3>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require 'layout/footer.php'; ?>
