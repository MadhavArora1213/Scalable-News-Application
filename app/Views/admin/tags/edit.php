<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>Edit Tag: <?= htmlspecialchars($tag['name']) ?></h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/tags" class="btn btn-secondary">Cancel</a>
            </div>
        </header>

        <div style="max-width: 600px;">
            <div class="admin-card">
                <form action="<?= SITE_URL ?>/admin/tags/<?= $tag['id'] ?>/update" method="POST">
                    <div class="form-group">
                        <label>Tag Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($tag['name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($tag['slug']) ?>" readonly>
                        <small style="color: #64748b; font-size: 0.75rem;">URL slugs are locked after creation.</small>
                    </div>

                    <div class="form-group">
                        <label>Language</label>
                        <select name="lang" class="form-control">
                            <option value="pa" <?= $tag['lang'] === 'pa' ? 'selected' : '' ?>>Punjabi (à¨ªà©°à¨œà¨¾à¨¬à©€)</option>
                            <option value="hi" <?= $tag['lang'] === 'hi' ? 'selected' : '' ?>>Hindi (à¤¹à¤¿à¤¨à¥ à¤¦à¥€)</option>
                            <option value="en" <?= $tag['lang'] === 'en' ? 'selected' : '' ?>>English</option>
                        </select>
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary">Update Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
