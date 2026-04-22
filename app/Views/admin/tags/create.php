<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>Create Tag</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/tags" class="btn btn-secondary">Cancel</a>
            </div>
        </header>

        <div style="max-width: 600px;">
            <div class="admin-card">
                <form action="<?= SITE_URL ?>/admin/tags/store" method="POST">
                    <div class="form-group">
                        <label>Tag Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Breaking News" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Auto-generated from name" readonly>
                    </div>

                    <div class="form-group">
                        <label>Language</label>
                        <select name="lang" class="form-control">
                            <option value="pa">Punjabi (ਪੰਜਾਬੀ)</option>
                            <option value="hi">Hindi (हिन्दी)</option>
                            <option value="en">English</option>
                        </select>
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn btn-primary">Save Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-generate Slug from Name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with hyphens
            .replace(/(^-|-$)/g, '');    // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
