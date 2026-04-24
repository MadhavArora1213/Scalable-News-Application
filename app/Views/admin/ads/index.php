<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-ad" style="color: var(--admin-primary); margin-right: 10px;"></i> Advertisement Manager</h1>
        <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px;">Manage your revenue by placing AdSense codes or sponsor banners in specific zones.</p>
    </header>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(450px, 1fr)); gap: 30px;">
        <?php foreach($ads as $ad): ?>
        <div class="admin-panel-box" style="border: 1px solid rgba(255,255,255,0.05);">
            <div class="box-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.05); padding: 15px 20px;">
                <h3 style="font-size: 0.9rem; color: #fff; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-layer-group" style="color: var(--admin-primary);"></i>
                    <?= htmlspecialchars($ad['name']) ?>
                    <span style="font-size: 0.65rem; background: rgba(255,255,255,0.05); padding: 2px 8px; border-radius: 4px; color: var(--admin-text-muted); font-weight: 400;"><?= strtoupper($ad['position']) ?></span>
                </h3>
                <a href="<?= SITE_URL ?>/admin/ads/<?= $ad['id'] ?>/toggle" class="status-pill <?= $ad['is_active'] ? 'published' : 'draft' ?>" style="text-decoration: none; cursor: pointer;">
                    <?= $ad['is_active'] ? 'ACTIVE' : 'PAUSED' ?>
                </a>
            </div>
            
            <form action="<?= SITE_URL ?>/admin/ads/<?= $ad['id'] ?>/update" method="POST" style="padding: 25px;">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.75rem; color: var(--admin-primary); margin-bottom: 10px; font-weight: 700;">Ad Script / HTML Code</label>
                    <textarea name="code" class="form-control" style="min-height: 150px; font-family: 'Courier New', Courier, monospace; font-size: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid var(--admin-border); line-height: 1.5;" placeholder="Paste your AdSense code or <img src='...'> here..."><?= htmlspecialchars($ad['code']) ?></textarea>
                </div>
                
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="is_active" id="active_<?= $ad['id'] ?>" <?= $ad['is_active'] ? 'checked' : '' ?> style="width: 16px; height: 16px; cursor: pointer;">
                        <label for="active_<?= $ad['id'] ?>" style="font-size: 0.8rem; color: #eee; cursor: pointer;">Show on Website</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="font-size: 0.75rem; padding: 8px 20px;">
                        <i class="fas fa-save"></i> UPDATE ZONE
                    </button>
                </div>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <div style="margin-top: 40px; padding: 25px; background: rgba(16, 185, 129, 0.05); border-radius: 12px; border: 1px solid rgba(16, 185, 129, 0.1);">
        <h4 style="color: #10b981; font-size: 0.9rem; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-coins"></i> Monetization Tips
        </h4>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div style="color: var(--admin-text-muted); font-size: 0.75rem; line-height: 1.6;">
                <strong style="color: #eee; display: block; margin-bottom: 5px;">Header Zone</strong>
                Best for high-visibility banners (728x90). Shows on every page at the top.
            </div>
            <div style="color: var(--admin-text-muted); font-size: 0.75rem; line-height: 1.6;">
                <strong style="color: #eee; display: block; margin-bottom: 5px;">Sidebar Zone</strong>
                Great for square ads (300x250). Perfect for local business sponsors.
            </div>
            <div style="color: var(--admin-text-muted); font-size: 0.75rem; line-height: 1.6;">
                <strong style="color: #eee; display: block; margin-bottom: 5px;">In-Article Zone</strong>
                Highest click-through rate. Place ads in the middle of long stories.
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
