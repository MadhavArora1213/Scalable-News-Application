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
                        <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($tag['name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>URL Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="<?= htmlspecialchars($tag['slug']) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Category (Optional)</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $tag['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                    <?= $cat['name_en'] ?> (<?= $cat['name_pa'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subcategory (Optional)</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                            <option value="">-- Select Subcategory --</option>
                            <?php foreach($subcategories as $sub): ?>
                                <option value="<?= $sub['id'] ?>" data-category="<?= $sub['category_id'] ?>" <?= $tag['subcategory_id'] == $sub['id'] ? 'selected' : '' ?>>
                                    <?= $sub['name_en'] ?> (<?= $sub['name_pa'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Language</label>
                        <select name="lang" class="form-control">
                            <option value="pa" <?= $tag['lang'] === 'pa' ? 'selected' : '' ?>>Punjabi (ਪੰਜਾਬੀ)</option>
                            <option value="hi" <?= $tag['lang'] === 'hi' ? 'selected' : '' ?>>Hindi (हिन्दी)</option>
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

<script>
    // Auto-generate Slug from Name even during edit
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with hyphens
            .replace(/(^-|-$)/g, '');    // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });

    // Filter Subcategories based on Category
    const catSelect = document.getElementById('category_id');
    const subSelect = document.getElementById('subcategory_id');
    const allSubs = Array.from(subSelect.options);

    catSelect.addEventListener('change', function() {
        const catId = this.value;
        subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
        
        allSubs.forEach(option => {
            if (option.value === "" || option.getAttribute('data-category') === catId) {
                if (option.value !== "") subSelect.add(option);
            }
        });
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
