<?php require 'layout/header.php'; ?>

    <div class="breadcrumb-nav">
        <div class="nav-container">
            <a href="<?= SITE_URL ?>/<?= $lang ?>">Home</a> > 
            <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $article['category_slug'] ?? 'news' ?>"><?= htmlspecialchars($article['category_name']) ?></a> >
            <span><?= htmlspecialchars($article['title']) ?></span>
        </div>
    </div>

    <div class="article-layout nav-container">
        <main class="article-main">
            <header class="article-header">
                <span class="category-badge"><?= htmlspecialchars($article['category_name']) ?></span>
                <h1><?= htmlspecialchars($article['title']) ?></h1>
                
                <div class="meta-bar">
                    <div class="author-info">
                        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt="Author">
                        <div>
                            <strong><?= htmlspecialchars($article['author_name']) ?></strong>
                            <span>Published: <?= date('M d, Y', strtotime($article['published_at'])) ?></span>
                        </div>
                    </div>
                    <div class="share-tools">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fas fa-link"></i></a>
                    </div>
                </div>

                <div class="lang-tabs">
                    <a href="<?= SITE_URL ?>/pa/<?= $article['category_slug'] ?>/<?= $article['slug'] ?>" class="<?= $lang == 'pa' ? 'active' : '' ?>">ਪੰਜਾਬੀ</a>
                    <a href="<?= SITE_URL ?>/hi/<?= $article['category_slug'] ?>/<?= $article['slug'] ?>" class="<?= $lang == 'hi' ? 'active' : '' ?>">हिंदी</a>
                    <a href="<?= SITE_URL ?>/en/<?= $article['category_slug'] ?>/<?= $article['slug'] ?>" class="<?= $lang == 'en' ? 'active' : '' ?>">English</a>
                </div>
            </header>

            <?php if ($article['image_path']): ?>
            <figure class="featured-figure">
                <img src="<?= SITE_URL ?>/<?= htmlspecialchars($article['image_path']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="featured-image">
                <figcaption>Photo Credit: The Khabran / PTI</figcaption>
            </figure>
            <?php endif; ?>

            <div class="article-body">
                <?= $article['body'] ?>
            </div>

            <div class="tags-cloud">
                <span>Tags:</span>
                <a href="#">#PunjabPolitics</a>
                <a href="#">#Farming</a>
                <a href="#">#BreakingNews</a>
            </div>

            <?php if (!empty($related)): ?>
            <section class="related-section" style="margin-top: 60px;">
                <h2 class="section-title"><?= $tr['related_news'] ?></h2>
                <div class="block-grid">
                    <?php foreach($related as $r): ?>
                    <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $r['category_slug'] ?>/<?= $r['slug'] ?>" class="article-card">
                        <div class="card-thumb" style="background: #eee;"></div>
                        <h3><?= htmlspecialchars($r['title']) ?></h3>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
        </main>

        <aside class="article-sidebar">
            <div class="sidebar-widget">
                <h3 class="widget-title">Top 5 Today</h3>
                <div class="sidebar-list">
                    <?php foreach($related as $i => $r): ?>
                    <div class="side-item">
                        <span class="rank"><?= $i+1 ?></span>
                        <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $r['category_slug'] ?>/<?= $r['slug'] ?>"><?= htmlspecialchars($r['title']) ?></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="sidebar-widget ad-placeholder">
                <p>Advertisement</p>
            </div>
            
            <div class="sidebar-widget">
                <h3 class="widget-title">Follow Us</h3>
                <div class="social-grid">
                    <a href="#" class="soc-fb"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="soc-tw"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="soc-wa"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </aside>
    </div>

<?php require 'layout/footer.php'; ?>
