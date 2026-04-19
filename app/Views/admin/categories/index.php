<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-tags"></i> Manage Navigation Menu</h1>
        </header>

        <div style="display: grid; grid-template-columns: 350px 1fr; gap: 40px; align-items: start;">
            <!-- Add New Category -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Add New Menu Category</h3>
                </div>
                <form action="<?= SITE_URL ?>/admin/categories/store" method="POST">
                    <div class="form-group">
                        <label>Name (English)</label>
                        <input type="text" name="name_en" class="form-control" placeholder="e.g. Politics" required>
                    </div>
                    <div class="form-group">
                        <label>Name (ਪੰਜਾਬੀ)</label>
                        <input type="text" name="name_pa" class="form-control" placeholder="ਜਿਵੇਂ ਕਿ ਰਾਜਨੀਤੀ" required>
                    </div>
                    <div class="form-group">
                        <label>Name (हिन्दी)</label>
                        <input type="text" name="name_hi" class="form-control" placeholder="जैसे कि राजनीति" required>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add to Navbar</button>
                </form>
            </div>

            <!-- Categories List -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Current Navigation Menu</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Sort</th>
                                <th>English</th>
                                <th>Punjabi</th>
                                <th>Hindi</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($categories)): ?>
                                <tr><td colspan="6" style="text-align:center; padding: 20px;">No categories found.</td></tr>
                            <?php else: foreach($categories as $cat): ?>
                            <tr>
                                <td style="width: 60px;"><strong><?= $cat['sort_order'] ?></strong></td>
                                <td style="font-weight: 700; color: var(--admin-primary);"><?= htmlspecialchars($cat['name_en']) ?></td>
                                <td><?= htmlspecialchars($cat['name_pa']) ?></td>
                                <td><?= htmlspecialchars($cat['name_hi']) ?></td>
                                <td><span style="background: #f0f4f8; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-family: monospace;">/<?= htmlspecialchars($cat['slug']) ?></span></td>
                                <td>
                                    <div class="action-group">
                                        <button class="btn-icon" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button class="btn-icon delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
