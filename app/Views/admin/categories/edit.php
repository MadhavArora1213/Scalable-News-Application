<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>Edit Category: <?= htmlspecialchars($category['name_en']) ?></h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/categories" class="btn btn-secondary">Cancel</a>
            </div>
        </header>

        <div style="max-width: 600px;">
            <div class="admin-card">
                <form action="<?= SITE_URL ?>/admin/categories/<?= $category['id'] ?>/update" method="POST">
                    <div class="form-group">
                        <label>Category Name (English)</label>
                        <input type="text" name="name_en" class="form-control" value="<?= htmlspecialchars($category['name_en']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($category['slug']) ?>" readonly>
                        <small style="color: #64748b; font-size: 0.75rem;">URL slugs are locked after creation.</small>
                    </div>

                    <div class="form-group">
                        <label>Category Name (ਪੰਜਾਬੀ)</label>
                        <input type="text" name="name_pa" class="form-control" value="<?= htmlspecialchars($category['name_pa']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Category Name (हिन्दी)</label>
                        <input type="text" name="name_hi" class="form-control" value="<?= htmlspecialchars($category['name_hi']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="<?= $category['sort_order'] ?>">
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
