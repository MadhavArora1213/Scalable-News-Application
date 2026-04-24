<?php require 'layout/header.php'; ?>

    <div class="hero-grid">
        <!-- Hero Section (60%) -->
        <main class="hero-main">
            <?php if($hero): ?>
            <article class="featured">
                <a href="<?= SITE_URL ?>/<?=$lang?>/<?=$hero['category_id']?>/<?=$hero['slug']?>" style="text-decoration:none; color:inherit;">
                    <div class="card-thumb hero-thumb" style="background-image: url('<?= (strpos($hero['image_path'], 'http') === 0) ? $hero['image_path'] : SITE_URL . '/' . $hero['image_path'] ?>'); background-position: center; background-size: cover;"></div>
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
                    <div class="card-thumb" style="width: 100px; height: 60px; background-image: <?= !empty($item['image_path']) ? ((strpos($item['image_path'], 'http') === 0) ? 'url(\''.$item['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$item['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
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
                    <div class="card-thumb" style="background-image: <?= !empty($item['image_path']) ? ((strpos($item['image_path'], 'http') === 0) ? 'url(\''.$item['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$item['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
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
                        <img src="<?= SITE_URL ?>/assets/images/avatar.png" alt="Author" class="author-img">
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
                <img src="<?= SITE_URL ?>/assets/images/punjab-map.png" alt="Punjab Map" style="max-width: 400px; opacity: 0.8;">
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
                        <div class="card-thumb" style="width: 120px; height: 80px; background-image: <?= !empty($p['image_path']) ? ((strpos($p['image_path'], 'http') === 0) ? 'url(\''.$p['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$p['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
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
                        <div class="card-thumb" style="width: 120px; height: 80px; background-image: <?= !empty($e['image_path']) ? ((strpos($e['image_path'], 'http') === 0) ? 'url(\''.$e['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$e['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
                        <div>
                            <h3 class="card-title" style="font-size: 1.1rem;"><?= htmlspecialchars($e['title']) ?></h3>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>

    <section class="video-section">
        <div class="section-container">
            <h2 class="section-main-title">Khabran TV <span style="font-size: 0.8rem; background: var(--crimson); padding: 4px 10px; border-radius: 4px; vertical-align: middle; margin-left: 15px; letter-spacing: 2px;">LIVE</span></h2>
            
            <div class="video-grid">
                <!-- Featured Video -->
                <div class="video-main">
                    <div class="featured-video">
                        <div class="play-overlay">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <img src="<?= SITE_URL ?>/assets/images/video-cover.png" alt="Video Cover" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
                    </div>
                    <div class="video-info-box">
                        <h3>Impact of New Farm Policies on Rural Punjab Districts</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-eye"></i> 4.5K Views</span>
                            <span><i class="fas fa-calendar-alt"></i> 2 Hours Ago</span>
                            <span style="color: var(--crimson);"><i class="fas fa-broadcast-tower"></i> High Definition</span>
                        </div>
                    </div>
                </div>

                <!-- Video Playlist -->
                <div class="video-playlist">
                    <h4 style="margin: 0 0 20px 0; color: #888; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px;">Up Next</h4>
                    
                    <a href="#" class="video-card-mini">
                        <div class="mini-thumb" style="background-image: url('<?= SITE_URL ?>/assets/images/video-thumb1.png'); background-position: center; background-size: cover;"></div>
                        <div class="mini-content">
                            <span class="v-title">Ludhiana Industrial Hub: Special Ground Report</span>
                            <span class="v-meta">12:45 • News Tech</span>
                        </div>
                    </a>

                    <a href="#" class="video-card-mini">
                        <div class="mini-thumb" style="background-image: url('<?= SITE_URL ?>/assets/images/video-thumb2.png'); background-position: center; background-size: cover;"></div>
                        <div class="mini-content">
                            <span class="v-title">Exclusive: Interview with Punjab Agriculture Minister</span>
                            <span class="v-meta">24:10 • Politics</span>
                        </div>
                    </a>

                    <a href="#" class="video-card-mini">
                        <div class="mini-thumb" style="background-image: url('<?= SITE_URL ?>/assets/images/video-thumb3.png'); background-position: center; background-size: cover;"></div>
                        <div class="mini-content">
                            <span class="v-title">Culture & Heritage: The Lost Arts of Amritsar</span>
                            <span class="v-meta">08:12 • Culture</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php require 'layout/footer.php'; ?>
