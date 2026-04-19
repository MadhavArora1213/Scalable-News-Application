<?php require 'layout/header.php'; ?>

    <div class="hero-grid">
        <!-- Hero Section (60%) -->
        <main class="hero-main">
            <?php if($hero): ?>
            <article class="featured">
                <a href="<?= SITE_URL ?>/<?=$lang?>/<?=$hero['category_id']?>/<?=$hero['slug']?>" style="text-decoration:none; color:inherit;">
                    <div class="card-thumb hero-thumb" style="background: url('<?= SITE_URL ?>/<?= $hero['image_path'] ?>') center/cover;"></div>
                    <span class="card-label"><?= htmlspecialchars($hero['category_name']) ?></span>
                    <h1 class="card-title"><?= htmlspecialchars($hero['title']) ?></h1>
                    <p class="card-excerpt"><?= htmlspecialchars($hero['excerpt']) ?></p>
                </a>
            </article>
            <?php endif; ?>
        </main>

        <!-- Sidebar Section (40%) -->
        <aside class="hero-sidebar">
            <h2 class="section-title"><?= $tr['latest_news'] ?? 'Latest News' ?></h2>
            <div class="sidebar-list">
                <?php foreach($latest as $item): ?>
                <a href="<?= SITE_URL ?>/<?=$lang?>/<?=$item['category_id']?>/<?=$item['slug']?>" class="article-card mini">
                    <div class="card-thumb" style="width: 100px; height: 60px; <?= $item['image_path'] ? 'background: url('.SITE_URL.'/'.$item['image_path'].') center/cover;' : '' ?>"></div>
                    <div>
                        <span class="card-label"><?= htmlspecialchars($item['category_name']) ?></span>
                        <h3 class="card-title" style="font-size: 1rem;"><?= htmlspecialchars($item['title']) ?></h3>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </aside>
    </div>

    <!-- Breaking News Ticker -->
    <div class="ticker-wrap">
        <div class="ticker-label"><?= $tr['breaking_news'] ?? 'Breaking News' ?></div>
        <div class="ticker-content">
            <?php if(!empty($breaking)): foreach($breaking as $b): ?>
                <a href="<?= $b['url'] ?>" class="ticker-item"><?= htmlspecialchars($b['headline']) ?></a>
            <?php endforeach; endif; ?>
        </div>
    </div>

    <div class="section-container">
        <!-- Main News Grid (Top Stories) -->
        <section class="category-block">
            <div class="block-header">
                <h2 class="section-main-title"><?= $tr['top_stories'] ?? 'Top Stories' ?></h2>
            </div>
            <div class="block-grid">
                <?php foreach($grid as $item): ?>
                <a href="<?= SITE_URL ?>/<?=$lang?>/<?=$item['category_id']?>/<?=$item['slug']?>" class="article-card">
                    <div class="card-thumb" style="<?= $item['image_path'] ? 'background: url('.SITE_URL.'/'.$item['image_path'].') center/cover;' : '' ?>"></div>
                    <span class="card-label"><?= htmlspecialchars($item['category_name']) ?></span>
                    <h3 class="card-title"><?= htmlspecialchars($item['title']) ?></h3>
                    <div class="card-meta"><?= date('M d, Y', strtotime($item['published_at'])) ?></div>
                </a>
                <?php endforeach; ?>
                
                <?php if(empty($grid)): ?>
                   <p style="grid-column: 1/-1; padding: 40px; text-align: center; color: #777;">Discover more stories in our specific sections below.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <!-- Opinion Section -->
    <section class="opinion-section">
        <div class="section-container">
            <h2 class="section-main-title"><?= $tr['opinions'] ?? 'Opinions' ?></h2>
            <div class="opinion-grid">
                <?php foreach($opinions as $op): ?>
                <a href="<?= SITE_URL ?>/<?=$lang?>/opinion/<?=$op['slug']?>" class="opinion-card">
                    <div class="opinion-author">
                        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt="Author" class="author-img">
                        <div>
                            <span class="author-name"><?= htmlspecialchars($op['author_name'] ?? 'Guest Columnist') ?></span>
                            <span class="author-beat">Journalist</span>
                        </div>
                    </div>
                    <h3 class="opinion-title"><?= htmlspecialchars($op['title']) ?></h3>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Ground Reports -->
    <?php if($groundReports): ?>
    <section class="ground-reports-banner">
        <div class="section-container banner-flex">
            <div class="banner-content">
                <span class="card-label" style="color: var(--warm-gold);"><?= $tr['ground_reports'] ?? 'Ground Reports' ?></span>
                <h2><?= htmlspecialchars($groundReports['title']) ?></h2>
                <p><?= htmlspecialchars($groundReports['excerpt']) ?></p>
                <a href="<?= SITE_URL ?>/<?=$lang?>/ground-reports/<?=$groundReports['slug']?>" class="btn-banner">READ SPECIAL REPORT</a>
            </div>
            <div class="banner-visual">
                <img src="<?= SITE_URL ?>/assets/img/punjab-map.png" alt="Punjab Map" style="max-width: 400px; opacity: 0.8;">
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Politics & Economy Split -->
    <div class="section-container split-section" style="margin-bottom: 80px;">
        <div class="split-grid">
            <section class="split-col">
                <div class="block-header">
                    <h2 class="section-title"><?= $tr['politics'] ?? 'Politics' ?></h2>
                    <a href="<?= SITE_URL ?>/<?=$lang?>/politics" class="see-all">VIEW ALL</a>
                </div>
                <div class="split-list">
                    <?php foreach($politics as $p): ?>
                    <a href="<?= SITE_URL ?>/<?=$lang?>/politics/<?=$p['slug']?>" class="article-card mini">
                        <?php if(!empty($p['image_path'])): ?>
                            <div class="card-thumb" style="width: 120px; height: 80px; background: url('<?= SITE_URL ?>/<?= $p['image_path'] ?>') center/cover;"></div>
                        <?php endif; ?>
                        <div>
                            <h3 class="card-title" style="font-size: 1.1rem;"><?= htmlspecialchars($p['title']) ?></h3>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            
            <div class="split-divider"></div>

            <section class="split-col">
                <div class="block-header">
                    <h2 class="section-title"><?= $tr['economy'] ?? 'Economy' ?></h2>
                    <a href="<?= SITE_URL ?>/<?=$lang?>/economy" class="see-all">VIEW ALL</a>
                </div>
                <div class="split-list">
                    <?php foreach($economy as $e): ?>
                    <a href="<?= SITE_URL ?>/<?=$lang?>/economy/<?=$e['slug']?>" class="article-card mini">
                        <?php if(!empty($e['image_path'])): ?>
                            <div class="card-thumb" style="width: 120px; height: 80px; background: url('<?= SITE_URL ?>/<?= $e['image_path'] ?>') center/cover;"></div>
                        <?php endif; ?>
                        <div>
                            <h3 class="card-title" style="font-size: 1.1rem;"><?= htmlspecialchars($e['title']) ?></h3>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>

    <!-- Video Section -->
    <section class="video-section">
        <div class="section-container">
            <h2 class="section-main-title" style="color: white; border-color: white;">Khabran TV</h2>
            <div class="video-grid">
                <div class="video-wrapper">
                    <div style="background: #333; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-youtube" style="font-size: 5rem; color: red;"></i>
                    </div>
                </div>
                <div class="video-list">
                    <div class="video-item"><div class="v-thumb"></div><span>Impact of New Farm Laws...</span></div>
                    <div class="video-item"><div class="v-thumb"></div><span>Ludhiana Industrial Hub...</span></div>
                    <div class="video-item"><div class="v-thumb"></div><span>Exclusive: CM Interview...</span></div>
                </div>
            </div>
        </div>
    </section>

<?php require 'layout/footer.php'; ?>
