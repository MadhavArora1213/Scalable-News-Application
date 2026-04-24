<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<div class="admin-content">
    <div class="admin-container">
        <form action="<?= SITE_URL ?>/admin/articles/store" method="POST" enctype="multipart/form-data">
            <header class="content-header">
                <h1>Create Article</h1>
                <div style="display: flex; gap: 10px;">
                    <a href="<?= SITE_URL ?>/admin/articles" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="status" value="published" class="btn btn-primary">Publish Now</button>
                </div>
            </header>

            <div class="form-grid">
                <!-- Left Column: Content -->
                <div class="main-content">
                    <div class="admin-card">
                        <div class="form-group">
                            <label for="title" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--admin-primary);">Article Headline</label>
                            <input type="text" id="title" name="title" class="form-control form-control-lg" style="font-size: 32px; font-weight: 900; background: transparent; border: none; border-bottom: 2px solid var(--admin-border); border-radius: 0; padding-left: 0; padding-right: 0;" placeholder="Enter attention-grabbing headline..." minlength="20" title="Headline must be at least 20 characters long" required>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px;">
                                <small style="color: var(--admin-text-muted); font-size: 0.75rem; letter-spacing: 0.5px;">Minimum 20 characters for a quality headline</small>
                                <small id="title-counter" style="color: var(--admin-text-muted); font-size: 0.75rem; font-weight: 600;">0 characters</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="slug">URL Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control" placeholder="Auto-generated from headline" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="body" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; display: block;">Story Content</label>
                            <div id="editor" style="min-height: 400px; border-radius: 12px; overflow: hidden;"></div>
                            <textarea id="body" name="body" style="display:none;"></textarea>
                        </div>

                        <div class="form-group" style="margin-top: 24px;">
                            <label for="excerpt">Short Excerpt / Deck</label>
                            <textarea id="excerpt" name="excerpt" class="form-control" style="min-height: 100px;" placeholder="Brief summary (1-2 sentences)..."></textarea>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h3><i class="fas fa-search-plus"></i> Search Engine Optimization (SEO)</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label>SEO Title</label>
                                <input type="text" name="seo_title" class="form-control" placeholder="Max 70 chars">
                            </div>
                            <div class="form-group">
                                <label>Focus Keyword</label>
                                <input type="text" name="seo_keyword" class="form-control" placeholder="e.g. Punjab News">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea name="meta_desc" class="form-control" style="height: 60px;" placeholder="Search engine snippet..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Settings -->
                <div class="side-content">

                    <div class="admin-card">
                        <h3>Article Settings</h3>
                        <div class="form-group">
                            <label>Language</label>
                            <select name="lang" class="form-control">
                                <option value="pa">Punjabi (ਪੰਜਾਬੀ)</option>
                                <option value="hi">Hindi (हिन्दी)</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name_en'] ?? $cat['name_pa']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subcategory</label>
                            <select id="subcategory_id" name="subcategory_id" class="form-control">
                                <option value="">-- Select Subcategory --</option>
                                <?php foreach($subcategories as $sub): ?>
                                    <option value="<?= $sub['id'] ?>" data-parent="<?= $sub['category_id'] ?>" style="display:none;"><?= htmlspecialchars($sub['name_en']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select name="priority" class="form-control">
                                <option value="normal">Normal</option>
                                <option value="featured">Featured</option>
                                <option value="top">Top Story</option>
                                <option value="breaking">Breaking News</option>
                            </select>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h3>Article Tags</h3>
                        <div class="tags-selector-box">
                            <?php foreach($tags as $tag): ?>
                            <label class="tag-checkbox-item">
                                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>">
                                <span><?= htmlspecialchars($tag['name']) ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group" style="margin-top: 15px;">
                            <label style="font-size: 0.75rem;">Add New Tags (comma separated)</label>
                            <input type="text" name="custom_tags" class="form-control" placeholder="e.g. Health, Sports, Punjab">
                        </div>
                    </div>

                    <div class="admin-card">
                        <h3>Featured Image</h3>
                        <div id="image-preview" style="width: 100%; aspect-ratio: 16/9; background: rgba(255,255,255,0.02); border-radius: 12px; border: 2px dashed var(--admin-border); display: flex; align-items: center; justify-content: center; flex-direction: column; cursor: pointer; overflow: hidden;" onclick="document.getElementById('image-upload').click()">
                            <i class="fas fa-camera" style="font-size: 24px; color: var(--admin-text-muted); margin-bottom: 8px;"></i>
                            <span style="color: var(--admin-text-muted); font-size: 0.8rem; font-weight: 600;">Upload Cover Photo</span>
                            <img id="preview-img" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="margin-top: 12px;">
                            <button type="button" class="btn btn-secondary" style="width: 100%; font-size: 0.8rem; padding: 8px;" onclick="document.getElementById('image-upload').click()">
                                <i class="fas fa-cloud-upload-alt"></i> SELECT IMAGE
                            </button>
                        </div>
                        <input type="file" id="image-upload" name="image" style="display: none;" onchange="previewImage(this)">
                        <small style="display: block; margin-top: 8px; color: var(--admin-text-muted); font-size: 0.7rem; text-align: center;">Recommended: 1200 x 675 (16:9)</small>
                    </div>

                    <div class="admin-card">
                        <h3>Publishing Options</h3>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <button type="submit" name="status" value="draft" class="btn btn-secondary" style="width: 100%; justify-content: center;">
                                <i class="fas fa-save"></i> SAVE DRAFT
                            </button>
                            <button type="submit" name="status" value="published" class="btn btn-primary" style="width: 100%; justify-content: center;">
                                <i class="fas fa-paper-plane"></i> PUBLISH
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo']
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                document.querySelector('#body').value = editor.getData();
            });
        })
        .catch(error => { console.error(error); });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('preview-img').style.display = 'block';
                document.querySelector('#image-preview i').style.display = 'none';
                document.querySelector('#image-preview span').style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto-generate Slug from Title and update Char Counter
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const charCount = title.length;
        
        // Update Counter UI
        const counter = document.getElementById('title-counter');
        if (counter) {
            counter.textContent = `${charCount} characters`;
            counter.style.color = charCount < 20 ? 'var(--admin-primary)' : 'var(--admin-text-muted)';
        }

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
