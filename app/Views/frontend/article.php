<?php require 'layout/header.php'; ?>
    
    <!-- Reading Progress Bar -->
    <div id="reading-progress" style="position: fixed; top: 0; left: 0; height: 4px; background: var(--crimson); width: 0%; z-index: 9999; transition: width 0.1s ease-out;"></div>

    <style>
        .article-body > p:first-of-type::first-letter {
            float: left;
            font-size: 5rem;
            line-height: 1;
            font-weight: 900;
            padding-right: 12px;
            color: var(--crimson);
            font-family: var(--font-heading);
        }
    </style>

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
                        <img src="<?= SITE_URL ?>/assets/images/avatar.png" alt="Author">
                        <div>
                            <strong><?= htmlspecialchars($article['author_name']) ?></strong>
                            <span>Published: <?= date('M d, Y', strtotime($article['published_at'])) ?></span>
                        </div>
                    </div>
                    <div class="share-tools">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="whatsapp://send?text=<?= urlencode($article['title'] . ' - ' . SITE_URL . '/' . $lang . '/' . ($article['category_slug'] ?? 'news') . '/' . $article['slug']) ?>" data-action="share/whatsapp/share" target="_blank"><i class="fab fa-whatsapp"></i></a>
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
                <img src="<?= (strpos($article['image_path'], 'http') === 0) ? $article['image_path'] : SITE_URL . '/' . htmlspecialchars($article['image_path']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="featured-image">
                <figcaption>Photo Credit: The Khabran / PTI</figcaption>
            </figure>
            <?php endif; ?>

            <div class="article-body">
                <?php 
                $body_parts = explode('</p>', $article['body']);
                foreach($body_parts as $index => $part) {
                    echo $part . '</p>';
                    if($index == 1) { // Show ad after 2nd paragraph
                        echo '<div class="mid-article-ad">
                                <span>ADVERTISEMENT</span>
                                <div class="ad-slot">728 x 90</div>
                              </div>';
                    }
                }
                ?>
            </div>

            <div class="tags-cloud">
                <span>Tags:</span>
                <a href="#">#PunjabPolitics</a>
                <a href="#">#Farming</a>
                <a href="#">#BreakingNews</a>
            </div>

            <!-- Author Bio Box -->
            <div class="author-bio-box">
                <img src="<?= SITE_URL ?>/assets/images/avatar.png" alt="Author">
                <div class="bio-content">
                    <h3><?= htmlspecialchars($article['author_name'] ?? 'Editorial Team') ?></h3>
                    <p>Senior Correspondent covering Punjab Politics and Ground Reports. Committed to unbiased, independent journalism from the heart of the state.</p>
                    <div class="author-socials">
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <section class="comments-section" id="comments">
                <h3 class="comments-title">Leave a Comment</h3>
                <form action="<?= SITE_URL ?>/comments/submit" method="POST" class="comment-form">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <textarea name="comment" placeholder="Write your comment here..." rows="4" required></textarea>
                    <button type="submit" class="btn-banner">Post Comment</button>
                </form>
                
                <div class="comments-list">
                    <?php if(!empty($comments)): ?>
                        <?php foreach($comments as $c): ?>
                            <div class="comment">
                                <strong><?= htmlspecialchars($c['name']) ?></strong> <span><?= date('M d, Y', strtotime($c['created_at'])) ?></span>
                                <p><?= nl2br(htmlspecialchars($c['body'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-comments">Be the first to comment on this article.</p>
                    <?php endif; ?>
                </div>
            </section>

            <?php if (!empty($related)): ?>
            <section class="related-section" style="margin-top: 60px;">
                <h2 class="section-title"><?= $tr['related_news'] ?></h2>
                <div class="block-grid">
                    <?php foreach($related as $r): ?>
                    <a href="<?= SITE_URL ?>/<?= $lang ?>/<?= $r['category_slug'] ?>/<?= $r['slug'] ?>" class="article-card">
                        <div class="card-thumb" style="background-image: <?= !empty($r['image_path']) ? ((strpos($r['image_path'], 'http') === 0) ? 'url(\''.$r['image_path'].'\')' : 'url(\''.SITE_URL.'/'.$r['image_path'].'\')') : 'url(\''.SITE_URL.'/assets/images/default-news.png\')' ?>; background-position: center; background-size: cover;"></div>
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
                <span>ADVERTISEMENT</span>
                <div class="ad-slot">300 x 250</div>
            </div>

            <div class="sidebar-widget newsletter-widget">
                <h3 class="widget-title">Newsletter</h3>
                <p>Get the day's top news stories delivered to your inbox.</p>
                <form action="<?= SITE_URL ?>/subscribe" method="POST">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <button type="submit">SIGN UP</button>
                </form>
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

    <script>
        window.onscroll = function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("reading-progress").style.width = scrolled + "%";
        };
    </script>

<?php require 'layout/footer.php'; ?>
