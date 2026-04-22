<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>Create Subcategory</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/subcategories" class="btn btn-secondary">Cancel</a>
            </div>
        </header>

        <div style="max-width: 600px;">
            <div class="admin-card">
                <form action="<?= SITE_URL ?>/admin/subcategories/store" method="POST">
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name_en']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subcategory Name (English)</label>
                        <input type="text" id="name_en" name="name_en" class="form-control" placeholder="e.g. Local News" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Auto-generated from English name" readonly>
                    </div>

                    <div class="form-group">
                        <label>Subcategory Name (ਪੰਜਾਬੀ)</label>
                        <input type="text" name="name_pa" class="form-control" placeholder="ਜਿਵੇਂ ਕਿ ਸਥਾਨਕ ਖ਼ਬਰਾਂ" required>
                    </div>

                    <div class="form-group">
                        <label>Subcategory Name (हिन्दी)</label>
                        <input type="text" name="name_hi" class="form-control" placeholder="जैसे कि स्थानीय समाचार" required>
                    </div>

                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary">Save Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-generate Slug from English Name
    document.getElementById('name_en').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with hyphens
            .replace(/(^-|-$)/g, '');    // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
