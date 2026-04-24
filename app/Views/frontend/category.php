<?php 
require 'layout/header.php'; 
$hero = !empty($articles) ? array_shift($articles) : null;
?>

    <!-- Category Header (Premium News Style) -->
    <div style="background: var(--text-primary); color: white; padding: 80px 0 60px 0; margin-bottom: 50px; border-bottom: 5px solid var(--brand-red);">
        <div class="section-container">
            <div style="font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; font-weight: 500; font-family: var(--font-nav);">
                <a href="<?= SITE_URL ?>/<?= $lang ?>" style="color: rgba(255,255,255,0.6); text-decoration: none;">Home</a> 
                <span style="color: var(--brand-red); font-weight: 900;">/</span>
                <span style="color: white;"><?= htmlspecialchars($category_name) ?></span>
            </div>
            <h1 style="font-size: 64px; text-transform: capitalize; margin: 0; line-height: 1; font-weight: 700; font-family: var(--font-heading); color: #FFFFFF;"><?= htmlspecialchars($category_name) ?></h1>
            <p style="max-width: 750px; margin: 30px 0 0 0; font-size: 18px; opacity: 0.9; line-height: 1.6; font-family: var(--font-body); border-left: 4px solid var(--brand-red); padding-left: 20px; color: #FFFFFF;">
                <?= isset($description) ? htmlspecialchars($description) : "Comprehensive coverage, in-depth analysis, and expert reporting on " . htmlspecialchars($category_name) . " from the ground across Punjab." ?>
            </p>
        </div>
    </div>

    <!-- Category Content -->
    <section class="section-container">
        
        <?php if($hero): ?>
        <div style="margin-bottom: 60px;">
            <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $category_slug ?>/<?= $hero['slug'] ?>" class="article-card" style="display: block; background: var(--card-bg); border-radius: var(--radius-card); overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <div class="card-thumb" style="aspect-ratio: 21/9; border-radius: 0; background-image: <?= !empty($hero['image_path']) ? ((strpos($hero['image_path'], 'http') === 0) ? 'url(\''.$hero['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$hero['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
                <div style="padding: 40px;">
                    <span class="card-label">LEAD STORY</span>
                    <h2 class="card-title" style="font-size: 42px; margin: 15px 0 20px 0;"><?= htmlspecialchars($hero['title']) ?></h2>
                    <div class="card-meta" style="margin-bottom: 20px;">By Editorial Team | <?= date('M d, Y', strtotime($hero['published_at'])) ?></div>
                    <p style="font-size: 18px; line-height: 1.8; color: var(--text-secondary);"><?= htmlspecialchars($hero['excerpt']) ?></p>
                </div>
            </a>
        </div>
        <?php endif; ?>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color);">
            <div>
                <h2 style="font-size: 28px; margin: 0; font-weight: 700; font-family: var(--font-heading);">Latest Reporting</h2>
            </div>
            <div style="background: var(--background); color: var(--text-primary); padding: 6px 18px; border-radius: 50px; font-weight: 600; font-size: 14px; border: 1px solid var(--border-color); font-family: var(--font-nav);">
                <?= count($articles) + ($hero ? 1 : 0) ?> Stories
            </div>
        </div>

        <div class="block-grid">
            <?php if(empty($articles) && !$hero): ?>
                <div style="grid-column: 1/-1; padding: 100px 0; text-align: center; background: var(--card-bg); border-radius: var(--radius-card); border: 1px dashed var(--border-color);">
                    <p style="font-size: 18px; color: var(--text-secondary); margin: 0;">No articles found in this section right now.</p>
                </div>
            <?php else: ?>
                <?php foreach($articles as $item): ?>
                <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $item['category_slug'] ?? $category_slug ?>/<?= $item['slug'] ?>" class="article-card">
                    <div class="card-thumb" style="background-image: <?= !empty($item['image_path']) ? ((strpos($item['image_path'], 'http') === 0) ? 'url(\''.$item['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$item['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
                    <div style="padding: 20px;">
                        <span class="card-label"><?= htmlspecialchars($item['category_name']) ?></span>
                        <h3 class="card-title"><?= htmlspecialchars($item['title']) ?></h3>
                        <div class="card-meta"><?= date('M d, Y', strtotime($item['published_at'])) ?></div>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

<?php require 'layout/footer.php'; ?>
