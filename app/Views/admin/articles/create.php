<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<form action="<?= SITE_URL ?>/admin/articles/store" method="POST" enctype="multipart/form-data">
    <div class="admin-content">
        <div class="admin-container">
            <header class="content-header">
                <h1><i class="fas fa-edit"></i> Write New Article</h1>
            </header>

            <div style="display: grid; grid-template-columns: 1fr 380px; gap: 40px;">
                <div class="admin-panel-box">
                    <div class="form-group">
                        <label for="title">Article Headline</label>
                        <input type="text" id="title" name="title" class="form-control" style="font-size: 28px; font-weight: 800; padding: 20px; border: none; border-bottom: 2px solid #eee; border-radius: 0; background: transparent;" placeholder="Enter attention-grabbing headline..." required>
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Article Content</label>
                        <div id="editor"></div>
                        <textarea id="body" name="body" style="display:none;"></textarea>
                    </div>

                    <div class="form-group" style="margin-top: 40px;">
                        <label for="excerpt">Short Excerpt / Deck</label>
                        <textarea id="excerpt" name="excerpt" class="form-control" style="min-height: 120px; font-size: 1.1rem; border-style: dashed;" placeholder="Brief summary (1-2 sentences) used in social previews and search results..."></textarea>
                    </div>

                    <!-- SEO Section Moved Here -->
                    <div style="margin-top: 40px; padding: 30px; background: #fff; border-radius: 12px; border-top: 3px solid #4a5568;">
                        <h3 style="font-size: 1.1rem; color: #1a202c; margin-bottom: 25px;"><i class="fas fa-search-plus"></i> Search Engine Optimization (SEO)</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                            <div class="form-group">
                                <label>SEO Title (Primary Keyword)</label>
                                <input type="text" name="seo_title" class="form-control" placeholder="Max 70 chars">
                                <small style="color: #718096;">Keep it clean and relevant to the story.</small>
                            </div>
                            <div class="form-group">
                                <label>Focus Keyword</label>
                                <input type="text" name="seo_keyword" class="form-control" placeholder="e.g. Punjab Elections 2026">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label>Meta Description</label>
                            <textarea name="meta_desc" class="form-control" style="font-size: 0.95rem; height: 80px;" placeholder="What will Google show in search results?"></textarea>
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 30px;">
                    <!-- Actions -->
                    <div class="admin-panel-box featured-card" style="background: white; color: var(--admin-text); border-top: 5px solid var(--admin-primary);">
                        <h3 style="color: var(--admin-text); border: none; margin-bottom: 20px;">Publishing Options</h3>
                        <div style="display: flex; gap: 10px;">
                            <button type="submit" name="status" value="draft" class="btn btn-secondary" style="flex: 1;">SAVE DRAFT</button>
                            <button type="submit" name="status" value="published" class="btn btn-primary" style="flex: 1;">PUBLISH</button>
                        </div>
                    </div>

                    <!-- Meta -->
                    <div class="admin-panel-box">
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
                            <select name="category_id" class="form-control">
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name_en'] ?? $cat['name_pa']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="admin-panel-box">
                        <h3>Featured Image</h3>
                        <div id="image-preview" style="width: 100%; height: 200px; background: #f8fafc; border-radius: 12px; border: 2px dashed #e2e8f0; display: flex; align-items: center; justify-content: center; flex-direction: column; cursor: pointer;" onclick="document.getElementById('image-upload').click()">
                            <i class="fas fa-camera" style="font-size: 40px; color: #cbd5e0; margin-bottom: 15px;"></i>
                            <span style="color: #a0aec0; font-weight: 600;">Upload Cover Photo</span>
                            <img id="preview-img" style="display: none; width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                        </div>
                        <input type="file" id="image-upload" name="image" style="display: none;" onchange="previewImage(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
