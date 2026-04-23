<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>Edit Subcategory: <?= htmlspecialchars($subcategory['name_en']) ?></h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/subcategories" class="btn btn-secondary">Cancel</a>
            </div>
        </header>

        <div style="max-width: 600px;">
            <div class="admin-card">
                <form action="<?= SITE_URL ?>/admin/subcategories/<?= $subcategory['id'] ?>/update" method="POST">
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select name="category_id" class="form-control" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $subcategory['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name_en']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subcategory Name (English)</label>
                        <input type="text" id="name_en" name="name_en" class="form-control" value="<?= htmlspecialchars($subcategory['name_en']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="<?= htmlspecialchars($subcategory['slug']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Subcategory Name (ਪੰਜਾਬੀ)</label>
                        <input type="text" name="name_pa" class="form-control" value="<?= htmlspecialchars($subcategory['name_pa']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Subcategory Name (हिन्दी)</label>
                        <input type="text" name="name_hi" class="form-control" value="<?= htmlspecialchars($subcategory['name_hi']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="<?= $subcategory['sort_order'] ?>">
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary">Update Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-generate Slug from English Name even during edit
    document.getElementById('name_en').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with hyphens
            .replace(/(^-|-$)/g, '');    // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
