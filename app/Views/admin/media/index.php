<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-photo-video"></i> Media Library & Assets</h1>
        </header>

        <!-- Upload Zone -->
        <div class="admin-panel-box" style="margin-bottom: 40px; background: #fff; border: 2px dashed #e2e8f0; padding: 40px; text-align: center;">
            <form action="<?= SITE_URL ?>/admin/media/upload" method="POST" enctype="multipart/form-data">
                <div style="margin-bottom: 20px;">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 50px; color: var(--admin-primary); opacity: 0.3;"></i>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Drag and drop files here to upload</h3>
                <p style="color: #718096; margin-bottom: 20px;">Supported formats: JPG, PNG, WebP, MP4 (Max 10MB)</p>
                
                <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                    <input type="file" name="file" class="form-control" style="max-width: 300px;" required>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> UPLOAD ASSET
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter Bar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div style="display: flex; gap: 15px;">
                <button class="btn btn-secondary active">All Media</button>
                <button class="btn btn-secondary">Images</button>
                <button class="btn btn-secondary">Videos</button>
            </div>
            <div style="position: relative;">
                <input type="text" placeholder="Search files..." class="form-control" style="padding-left: 40px; width: 300px;">
                <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #a0aec0;"></i>
            </div>
        </div>

        <!-- Media Grid -->
        <div class="admin-panel-box" style="padding: 30px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 30px;">
                <!-- Placeholder Images -->
                <?php for($i=1; $i<=8; $i++): ?>
                <div class="media-card">
                    <div style="aspect-ratio: 4/3; background: #f8fafc; border-radius: 12px; position: relative; overflow: hidden; border: 1px solid #edf2f7; transition: 0.3s;">
                        <img src="https://picsum.photos/400/300?random=<?= $i ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="media-overlay">
                            <button class="btn-icon" title="View"><i class="fas fa-expand"></i></button>
                            <button class="btn-icon" title="Copy URL"><i class="fas fa-link"></i></button>
                            <button class="btn-icon delete" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div style="padding: 12px 0;">
                        <span style="font-size: 0.85rem; font-weight: 700; color: #2d3748; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">news_story_cover_<?= $i ?>.jpg</span>
                        <span style="font-size: 0.75rem; color: #718096;">1200 x 900 • 240 KB</span>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<style>
.media-card:hover img { transform: scale(1.05); }
.media-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: 0.3s;
}
.media-card:hover .media-overlay { opacity: 1; }
.btn-secondary.active { background: #edf2f7; color: var(--admin-primary); border-color: var(--admin-primary); }
</style>

<?php require __DIR__ . '/../layout/footer.php'; ?>
