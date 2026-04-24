<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <form action="<?= SITE_URL ?>/admin/settings/update" method="POST" enctype="multipart/form-data">
        <header class="content-header">
            <h1><i class="fas fa-sliders-h" style="color: var(--admin-primary); margin-right: 10px;"></i> Site Configuration</h1>
            <div class="header-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> APPLY CHANGES
                </button>
            </div>
        </header>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
            
            <!-- General & Branding -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-home"></i> Basic Website Info</h3>
                    </div>
                    <div style="padding: 25px;">
                        <div class="form-group">
                            <label>Website Name</label>
                            <input type="text" name="settings[site_name]" class="form-control" value="<?= htmlspecialchars($settings['general']['site_name'] ?? '') ?>" placeholder="e.g. Khabran News">
                        </div>
                        <div class="form-group">
                            <label>Short Description (Tagline)</label>
                            <input type="text" name="settings[site_tagline]" class="form-control" value="<?= htmlspecialchars($settings['general']['site_tagline'] ?? '') ?>" placeholder="e.g. Punjab's No.1 News Site">
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label>Main Logo</label>
                            <div style="display: flex; gap: 20px; align-items: center; background: rgba(0,0,0,0.2); padding: 15px; border-radius: 12px; border: 1px dashed var(--admin-border);">
                                <div style="width: 100px; height: 50px; background: rgba(255,255,255,0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <?php if(!empty($settings['general']['site_logo'])): ?>
                                        <img src="<?= SITE_URL . $settings['general']['site_logo'] ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    <?php else: ?>
                                        <i class="fas fa-image" style="color: var(--admin-text-muted);"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <input type="file" name="site_logo" style="font-size: 0.75rem; color: var(--admin-text-muted);">
                                    <p style="font-size: 0.65rem; color: var(--admin-text-muted); margin-top: 5px;">Upload your logo here. PNG works best.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-search"></i> Google & Search Info (SEO)</h3>
                    </div>
                    <div style="padding: 25px;">
                        <div class="form-group">
                            <label>About the Website (for Search Engines)</label>
                            <textarea name="settings[meta_description]" class="form-control" style="min-height: 80px; font-size: 0.85rem;"><?= htmlspecialchars($settings['seo']['meta_description'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Keywords (comma separated)</label>
                            <input type="text" name="settings[meta_keywords]" class="form-control" value="<?= htmlspecialchars($settings['seo']['meta_keywords'] ?? '') ?>" placeholder="e.g. punjab, news, politics">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social & Contact -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-heart"></i> Social Media Pages</h3>
                    </div>
                    <div style="padding: 25px;">
                        <div class="form-group" style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; color: #ff0000; font-size: 1.2rem; text-align: center;"><i class="fab fa-youtube"></i></div>
                            <input type="text" name="settings[youtube_url]" class="form-control" value="<?= htmlspecialchars($settings['social']['youtube_url'] ?? '') ?>" placeholder="Enter YouTube Link">
                        </div>
                        <div class="form-group" style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; color: #1877F2; font-size: 1.2rem; text-align: center;"><i class="fab fa-facebook"></i></div>
                            <input type="text" name="settings[facebook_url]" class="form-control" value="<?= htmlspecialchars($settings['social']['facebook_url'] ?? '') ?>" placeholder="Enter Facebook Link">
                        </div>
                        <div class="form-group" style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; color: #E1306C; font-size: 1.2rem; text-align: center;"><i class="fab fa-instagram"></i></div>
                            <input type="text" name="settings[instagram_url]" class="form-control" value="<?= htmlspecialchars($settings['social']['instagram_url'] ?? '') ?>" placeholder="Enter Instagram Link">
                        </div>
                        <div class="form-group" style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; color: #1DA1F2; font-size: 1.2rem; text-align: center;"><i class="fab fa-twitter"></i></div>
                            <input type="text" name="settings[twitter_url]" class="form-control" value="<?= htmlspecialchars($settings['social']['twitter_url'] ?? '') ?>" placeholder="Enter X (Twitter) Link">
                        </div>
                    </div>
                </div>

                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-envelope"></i> Contact Details</h3>
                    </div>
                    <div style="padding: 25px;">
                        <div class="form-group">
                            <label>Official Email</label>
                            <input type="email" name="settings[support_email]" class="form-control" value="<?= htmlspecialchars($settings['contact']['support_email'] ?? '') ?>" placeholder="e.g. info@khabran.com">
                        </div>
                        <div class="form-group">
                            <label>Office Address</label>
                            <textarea name="settings[office_address]" class="form-control" style="min-height: 60px; font-size: 0.85rem;"><?= htmlspecialchars($settings['contact']['office_address'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Bottom Copyright Text</label>
                            <input type="text" name="settings[copyright_text]" class="form-control" value="<?= htmlspecialchars($settings['general']['copyright_text'] ?? '') ?>" placeholder="e.g. © 2026 Khabran News. All rights reserved.">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
