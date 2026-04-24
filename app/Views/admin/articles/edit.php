<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<form action="/News_Website/admin/articles/<?= $article['id'] ?>/update" method="POST" enctype="multipart/form-data">
    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 24px;">
        <div class="card">
            <div class="card-header">
                <h3 style="font-size: 18px;">Edit Article</h3>
            </div>
            <div style="padding: 24px;">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" style="font-size: 24px; font-weight: 700; padding: 16px;" value="<?= htmlspecialchars($article['title']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="slug">URL Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="<?= htmlspecialchars($article['slug']) ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="body">Body Content</label>
                    <textarea id="body" name="body" class="form-control" style="min-height: 500px;"><?= htmlspecialchars($article['body']) ?></textarea>
                </div>

                <div class="form-group" style="margin-top: 30px;">
                    <label for="excerpt">Short Excerpt (Optional)</label>
                    <textarea id="excerpt" name="excerpt" class="form-control" style="min-height: 100px;"><?= htmlspecialchars($article['excerpt']) ?></textarea>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 24px;">
            <!-- Publish Card -->
            <div class="card">
                <div class="card-header">
                    <h3 style="font-size: 16px;">Publish Status</h3>
                </div>
                <div style="padding: 20px;">
                    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; font-size: 14px;">
                            <span style="color: var(--text-muted);"><i class="fas fa-eye"></i> Current:</span>
                            <span class="badge <?= $article['status'] === 'published' ? 'badge-success' : 'badge-warning' ?>"><?= ucfirst($article['status']) ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;">
                            <span style="color: var(--text-muted);"><i class="fas fa-calendar-alt"></i> Created:</span>
                            <span style="font-weight: 600;"><?= date('M d, Y', strtotime($article['created_at'])) ?></span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <button type="submit" name="status" value="draft" class="btn" style="flex: 1; background: var(--border-color);">Convert to Draft</button>
                        <button type="submit" name="status" value="published" class="btn btn-primary" style="flex: 1;">Update & Publish</button>
                    </div>
                </div>
            </div>

            <!-- Meta Data Card -->
            <div class="card">
                <div class="card-header">
                    <h3 style="font-size: 16px;">Organization</h3>
                </div>
                <div style="padding: 20px;">
                    <div class="form-group">
                        <label for="lang">Language</label>
                        <select name="lang" id="lang" class="form-control">
                            <option value="pa" <?= $article['lang'] === 'pa' ? 'selected' : '' ?>>Punjabi (à¨ªà©°à¨œà¨¾à¨¬à©€)</option>
                            <option value="hi" <?= $article['lang'] === 'hi' ? 'selected' : '' ?>>Hindi (à¤¹à¤¿à¤¨à¥à¤¦à¥€)</option>
                            <option value="en" <?= $article['lang'] === 'en' ? 'selected' : '' ?>>English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $article['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name_en']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_id">Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                            <option value="">-- Select Subcategory --</option>
                            <?php foreach($subcategories as $sub): ?>
                                <option value="<?= $sub['id'] ?>" data-parent="<?= $sub['category_id'] ?>" <?= $article['subcategory_id'] == $sub['id'] ? 'selected' : '' ?> style="<?= $article['category_id'] == $sub['category_id'] ? 'display:block;' : 'display:none;' ?>"><?= htmlspecialchars($sub['name_en']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" class="form-control">
                            <option value="normal" <?= $article['priority'] === 'normal' ? 'selected' : '' ?>>Normal</option>
                            <option value="featured" <?= $article['priority'] === 'featured' ? 'selected' : '' ?>>Featured</option>
                            <option value="top" <?= $article['priority'] === 'top' ? 'selected' : '' ?>>Top Story</option>
                            <option value="breaking" <?= $article['priority'] === 'breaking' ? 'selected' : '' ?>>Breaking News</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="card">
                <div class="card-header">
                    <h3 style="font-size: 16px;">SEO Settings</h3>
                </div>
                <div style="padding: 20px;">
                    <div class="form-group">
                        <label for="seo_title">SEO Title</label>
                        <input type="text" id="seo_title" name="seo_title" class="form-control" value="<?= htmlspecialchars($article['seo_title']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="meta_desc">Meta Description</label>
                        <textarea id="meta_desc" name="meta_desc" class="form-control" style="min-height: 80px;"><?= htmlspecialchars($article['meta_desc']) ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Tags Card -->
            <div class="card">
                <div class="card-header">
                    <h3 style="font-size: 16px;">Article Tags</h3>
                </div>
                <div style="padding: 20px;">
                    <div class="tags-selector-box">
                        <?php foreach($tags as $tag): ?>
                        <label class="tag-checkbox-item">
                            <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" <?= in_array($tag['id'], $selectedTags) ? 'checked' : '' ?>>
                            <span><?= htmlspecialchars($tag['name']) ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label style="font-size: 0.75rem;">Add New Tags (comma separated)</label>
                        <input type="text" name="custom_tags" class="form-control" placeholder="e.g. Health, Sports, Punjab">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    tinymce.init({
        selector: '#body',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 600,
        menubar: false
    });

    // Auto-generate Slug from Title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with hyphens
            .replace(/(^-|-$)/g, '');    // Remove leading/trailing hyphens
        document.getElementById('slug').value = slug;
    });

    // Dynamic Subcategory Filtering
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subSelect = document.getElementById('subcategory_id');
        const options = subSelect.querySelectorAll('option');
        
        subSelect.value = ""; // Reset subcategory
        
        options.forEach(opt => {
            if (opt.value === "") return;
            if (opt.getAttribute('data-parent') === categoryId) {
                opt.style.display = "block";
            } else {
                opt.style.display = "none";
            }
        });
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
