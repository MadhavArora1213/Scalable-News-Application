<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-search-dollar"></i> Global SEO Manager</h1>
            <div class="header-actions">
                <button class="btn btn-primary"><i class="fas fa-redo"></i> REGENERATE SITEMAPS</button>
            </div>
        </header>

        <?php if(isset($_GET['msg'])): ?>
            <div style="background: #c6f6d5; color: #22543d; padding: 15px; border-radius: 8px; margin-bottom: 30px; border-left: 5px solid #38a169;">
                <i class="fas fa-check-circle"></i> SEO settings updated successfully!
            </div>
        <?php endif; ?>

        <!-- SEO Health Overview -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px;">
            <div class="stat-card" style="border-top: 4px solid #4285F4;">
                <div class="stat-val"><?= $stats['indexed_pages'] ?></div>
                <div class="stat-label">INDEXED PAGES</div>
            </div>
            <div class="stat-card" style="border-top: 4px solid #34A853;">
                <div class="stat-val"><?= $stats['sitemap_status'] ?></div>
                <div class="stat-label">SITEMAP HEALTH</div>
            </div>
            <div class="stat-card" style="border-top: 4px solid #FBBC05;">
                <div class="stat-val"><?= $stats['google_rank'] ?></div>
                <div class="stat-label">AVERAGE POSITION</div>
            </div>
            <div class="stat-card" style="border-top: 4px solid #EA4335;">
                <div class="stat-val"><?= $stats['meta_errors'] ?></div>
                <div class="stat-label">META ERRORS</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 450px; gap: 40px; align-items: start;">
            <!-- Main SEO Settings -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Schema & Meta Configuration</h3>
                </div>
                <form action="<?= SITE_URL ?>/admin/seo/update" method="POST">
                    <div class="form-group">
                        <label>Homepage Title Pattern</label>
                        <input type="text" name="site_title" class="form-control" value="Khabran News - Punjabi · Hindi · English | News Portal">
                        <small style="color: #718096;">Use {title} to dynamically inject site name.</small>
                    </div>
                    <div class="form-group">
                        <label>Global Meta Description</label>
                        <textarea name="global_desc" class="form-control" style="height: 100px;">Khabran is the fastest growing news portal covering political, economic and social stories from Punjab in three languages.</textarea>
                    </div>
                    <div class="form-group">
                        <label>Social Image (Open Graph)</label>
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <div style="width: 150px; height: 85px; background: #f0f4f8; border-radius: 8px; border: 1px dashed #cbd5e0; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: #cbd5e0; font-size: 24px;"></i>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm">Change Image</button>
                        </div>
                    </div>
                    <hr style="margin: 30px 0; border: none; border-top: 1px solid #edf2f7;">
                    <button type="submit" class="btn btn-primary">SAVE GLOBAL SETTINGS</button>
                </form>
            </div>

            <!-- Technical SEO -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="admin-panel-box">
                    <h3>Search Console & Webmaster</h3>
                    <div class="form-group">
                        <label>Google Verification ID</label>
                        <input type="text" class="form-control" placeholder="google-site-verification=...">
                    </div>
                    <div class="form-group">
                        <label>Bing Webmaster ID</label>
                        <input type="text" class="form-control" placeholder="bing-verification=...">
                    </div>
                    <button class="btn btn-secondary btn-block">Verify Connectivity</button>
                </div>

                <div class="admin-panel-box" style="background: #fff; border-left: 5px solid var(--admin-primary);">
                    <h3 style="margin-bottom: 20px;">Robots.txt Editor</h3>
                    <form action="<?= SITE_URL ?>/admin/seo/update" method="POST">
                        <textarea name="robots_content" class="form-control" style="font-family: 'Courier New', Courier, monospace; font-size: 0.9rem; height: 180px; background: #fafafa; border: 1px solid #eee; margin-bottom: 20px; line-height: 1.6; padding: 15px;">User-agent: *
Allow: /
Disallow: /admin/
Sitemap: <?= SITE_URL ?>/sitemap.xml</textarea>
                        <button type="submit" class="btn btn-primary btn-block" style="padding: 15px;">
                            <i class="fas fa-save"></i> UPDATE ROBOTS.TXT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
