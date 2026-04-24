<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>All Subcategories</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/subcategories/new" class="btn btn-primary"><i class="fas fa-plus"></i> NEW SUBCATEGORY</a>
            </div>
        </header>

        <div class="admin-panel-box">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Parent Category</th>
                            <th>English Name</th>
                            <th>Punjabi Name</th>
                            <th>Hindi Name</th>
                            <th>Slug</th>
                            <th>Sort</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($subcategories)): ?>
                            <tr><td colspan="7" style="text-align:center; padding: 40px;">No subcategories found. Start by creating one!</td></tr>
                        <?php else: foreach($subcategories as $sub): ?>
                        <tr>
                            <td><span class="badge"><?= htmlspecialchars($sub['parent_name']) ?></span></td>
                            <td style="font-weight: 700; color: var(--admin-primary);"><?= htmlspecialchars($sub['name_en']) ?></td>
                            <td><?= htmlspecialchars($sub['name_pa']) ?></td>
                            <td><?= htmlspecialchars($sub['name_hi']) ?></td>
                            <td><span class="badge">/<?= htmlspecialchars($sub['slug']) ?></span></td>
                            <td><strong><?= $sub['sort_order'] ?></strong></td>
                            <td>
                                <div class="action-group">
                                    <a href="<?= SITE_URL ?>/admin/subcategories/<?= $sub['id'] ?>/edit" class="btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="<?= SITE_URL ?>/admin/subcategories/<?= $sub['id'] ?>/delete" method="POST" onsubmit="return confirm('Truly delete this subcategory?');" style="display:inline;">
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
