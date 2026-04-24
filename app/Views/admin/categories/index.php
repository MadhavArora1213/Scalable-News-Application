<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>All Categories</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/categories/new" class="btn btn-primary"><i class="fas fa-plus"></i> NEW CATEGORY</a>
            </div>
        </header>

        <div class="admin-panel-box">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Sort</th>
                            <th>English Name</th>
                            <th>Punjabi Name</th>
                            <th>Hindi Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($categories)): ?>
                            <tr><td colspan="6" style="text-align:center; padding: 40px;">No categories found. Start by creating one!</td></tr>
                        <?php else: foreach($categories as $cat): ?>
                        <tr>
                            <td style="width: 60px;"><strong><?= $cat['sort_order'] ?></strong></td>
                            <td style="font-weight: 700; color: var(--admin-primary);"><?= htmlspecialchars($cat['name_en']) ?></td>
                            <td><?= htmlspecialchars($cat['name_pa']) ?></td>
                            <td><?= htmlspecialchars($cat['name_hi']) ?></td>
                            <td><span class="badge">/<?= htmlspecialchars($cat['slug']) ?></span></td>
                            <td>
                                <div class="action-group">
                                    <a href="<?= SITE_URL ?>/admin/categories/<?= $cat['id'] ?>/edit" class="btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="<?= SITE_URL ?>/admin/categories/<?= $cat['id'] ?>/delete" method="POST" onsubmit="return confirm('Truly delete this category? All articles in this category will lose their link!');" style="display:inline;">
                                        <button type="submit" class="btn-icon delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
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

<?php require __DIR__ . '/../layout/footer.php'; ?>
