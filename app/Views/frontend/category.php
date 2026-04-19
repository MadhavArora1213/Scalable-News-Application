<?php 
require 'layout/header.php'; 
$hero = !empty($articles) ? array_shift($articles) : null;
?>

    <!-- Category Header -->
    <div style="background: var(--ink-black); color: white; padding: 60px 0; text-align: center; margin-bottom: 40px;">
        <div class="nav-container">
            <h1 style="font-size: 5rem; text-transform: uppercase; letter-spacing: 5px; margin: 0; line-height: 1;"><?= htmlspecialchars($category_name) ?></h1>
            <?php if(isset($description)): ?>
                <p style="max-width: 800px; margin: 30px auto 0 auto; font-size: 1.2rem; opacity: 0.8; line-height: 1.6;"><?= htmlspecialchars($description) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Category Content -->
    <section class="nav-container">
        
        <?php if($hero): ?>
        <div class="hero-grid" style="grid-template-columns: 1fr; margin-bottom: 60px;">
            <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $category_name ?>/<?= $hero['slug'] ?>" class="article-card">
                <div class="card-thumb" style="aspect-ratio: 21/9; <?= $hero['image_path'] ? 'background: url('.SITE_URL.'/'.$hero['image_path'].') center/cover;' : '' ?>"></div>
                <span class="card-label">LEAD STORY</span>
                <h2 class="card-title" style="font-size: 3.5rem; margin-top: 15px;"><?= htmlspecialchars($hero['title']) ?></h2>
                <div class="card-meta">By Editor | <?= date('M d, Y', strtotime($hero['published_at'])) ?></div>
                <p style="font-size: 1.25rem; line-height: 1.6; margin-top: 20px; color: #444;"><?= htmlspecialchars($hero['excerpt']) ?></p>
            </a>
        </div>
        <?php endif; ?>

        <h2 class="section-title"><?= $tr['latest_updates'] ?></h2>
        <div class="block-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 80px;">
            <?php if(empty($articles) && !$hero): ?>
                <p style="grid-column: 1/-1; padding: 100px 0; text-align: center; font-size: 1.2rem; color: #777;">
                    No articles found in this category right now.
                </p>
            <?php else: ?>
                <?php foreach($articles as $item): ?>
                <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $item['category_slug'] ?? $item['category_name'] ?>/<?= $item['slug'] ?>" class="article-card">
                    <div class="card-thumb" style="<?= $item['image_path'] ? 'background: url('.SITE_URL.'/'.$item['image_path'].') center/cover;' : '' ?>"></div>
                    <span class="card-label"><?= htmlspecialchars($item['category_name']) ?></span>
                    <h3 class="card-title"><?= htmlspecialchars($item['title']) ?></h3>
                    <div class="card-meta"><?= date('M d, Y', strtotime($item['published_at'])) ?></div>
                </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

<?php require 'layout/footer.php'; ?>
