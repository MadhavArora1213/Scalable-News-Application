<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>Create Category</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/categories" class="btn btn-secondary">Cancel</a>
            </div>
        </header>

        <div style="max-width: 600px;">
            <div class="admin-card">
                <form action="<?= SITE_URL ?>/admin/categories/store" method="POST">
                    <div class="form-group">
                        <label>Category Name (English)</label>
                        <input type="text" id="name_en" name="name_en" class="form-control" placeholder="e.g. Politics" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Auto-generated from English name" readonly>
                    </div>

                    <div class="form-group">
                        <label>Category Name (ਪੰਜਾਬੀ)</label>
                        <input type="text" name="name_pa" class="form-control" placeholder="ਜਿਵੇਂ ਕਿ ਰਾਜਨੀਤੀ" style="font-family: 'Noto Sans Gurmukhi', sans-serif; font-size: 1.1rem;" required>
                    </div>

                    <div class="form-group">
                        <label>Category Name (हिन्दी)</label>
                        <input type="text" name="name_hi" class="form-control" placeholder="जैसे कि राजनीति" required>
                    </div>

                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary">Save Category</button>
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
