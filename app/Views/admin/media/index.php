<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-images" style="color: var(--admin-primary); margin-right: 10px;"></i> Central Media Library</h1>
        <div style="display: flex; gap: 15px;">
             <button onclick="document.getElementById('uploadModal').style.display='flex'" class="btn btn-primary">
                <i class="fas fa-upload"></i> UPLOAD ASSET
            </button>
        </div>
    </header>

    <div style="background: rgba(15, 23, 42, 0.5); padding: 25px; border-radius: 15px; border: 1px solid var(--admin-border); margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <p style="color: var(--admin-text-muted); font-size: 0.85rem;">Manage all your news photos in one place. Add alt text for Google SEO and legal credits for news agencies.</p>
            <div style="font-size: 0.8rem; color: #fff; background: rgba(255,255,255,0.05); padding: 5px 15px; border-radius: 20px;">
                Total Assets: <strong><?= count($media) ?></strong>
            </div>
        </div>
    </div>

    <!-- Media Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
        <?php if(empty($media)): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 100px; color: var(--admin-text-muted);">
                <i class="fas fa-photo-video" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.2;"></i>
                <p>Your media library is empty. Upload your first news image!</p>
            </div>
        <?php else: foreach($media as $item): ?>
        <div class="admin-panel-box" style="overflow: hidden; display: flex; flex-direction: column;">
            <div style="height: 180px; background: #000; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                <img src="<?= SITE_URL . $item['path'] ?>" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 5px;">
                    <form action="<?= SITE_URL ?>/admin/media/<?= $item['id'] ?>/delete" method="POST" onsubmit="return confirm('Delete this asset? This cannot be undone.');">
                        <button type="submit" class="btn-icon delete" style="background: rgba(239, 68, 68, 0.9); border: none; color: #fff;"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
            
            <div style="padding: 20px; flex: 1; display: flex; flex-direction: column; gap: 15px;">
                <form action="<?= SITE_URL ?>/admin/media/<?= $item['id'] ?>/update" method="POST">
                    <div class="form-group" style="margin-bottom: 12px;">
                        <label style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Alt Text (For Google SEO)</label>
                        <input type="text" name="alt_text" class="form-control" style="font-size: 0.8rem; padding: 8px 12px;" value="<?= htmlspecialchars($item['alt_text'] ?? '') ?>" placeholder="Describe image...">
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Photo Credit</label>
                        <input type="text" name="credit" class="form-control" style="font-size: 0.8rem; padding: 8px 12px;" value="<?= htmlspecialchars($item['credit'] ?? '') ?>" placeholder="e.g. Photo by Reuters">
                    </div>
                    <button type="submit" class="btn btn-secondary" style="width: 100%; font-size: 0.7rem; padding: 8px;">
                        <i class="fas fa-save"></i> SAVE INFO
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; endif; ?>
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
    <div class="admin-card" style="width: 100%; max-width: 500px; margin: 0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3><i class="fas fa-cloud-upload-alt" style="color: var(--admin-primary);"></i> Upload to Library</h3>
            <button onclick="document.getElementById('uploadModal').style.display='none'" style="background: none; border: none; color: #fff; cursor: pointer; font-size: 1.5rem;">&times;</button>
        </div>
        
        <form action="<?= SITE_URL ?>/admin/media/upload" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Choose File</label>
                <div style="border: 2px dashed var(--admin-border); padding: 30px; border-radius: 15px; text-align: center; background: rgba(255,255,255,0.02);">
                    <input type="file" name="file" required style="font-size: 0.85rem;">
                </div>
            </div>
            <div class="form-group">
                <label>SEO Alt Text</label>
                <input type="text" name="alt_text" class="form-control" placeholder="e.g. Farmers protest in Amritsar">
            </div>
            <div class="form-group">
                <label>Agency/Photo Credit</label>
                <input type="text" name="credit" class="form-control" placeholder="e.g. PTI / Getty Images">
            </div>
            <div style="display: flex; gap: 15px; margin-top: 30px;">
                <button type="button" onclick="document.getElementById('uploadModal').style.display='none'" class="btn btn-secondary" style="flex: 1;">CANCEL</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">UPLOAD NOW</button>
            </div>
        </form>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
