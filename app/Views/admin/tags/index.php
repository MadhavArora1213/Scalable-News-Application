<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1>All Tags</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/tags/new" class="btn btn-primary"><i class="fas fa-plus"></i> NEW TAG</a>
            </div>
        </header>

        <div class="admin-panel-box">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tag Name</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Language</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($tags)): ?>
                            <tr><td colspan="7" style="text-align:center; padding: 40px;">No tags found. Start by creating one!</td></tr>
                        <?php else: foreach($tags as $tag): ?>
                        <tr>
                            <td><?= $tag['id'] ?></td>
                            <td style="font-weight: 700; color: var(--admin-primary);"><?= htmlspecialchars($tag['name']) ?></td>
                            <td><span class="badge">/<?= htmlspecialchars($tag['slug']) ?></span></td>
                            <td><span class="badge" style="background: rgba(255,255,255,0.05); color: var(--admin-text-muted);"><?= $tag['category_name'] ?? 'N/A' ?></span></td>
                            <td><span class="badge" style="background: rgba(255,255,255,0.03); color: var(--admin-text-muted);"><?= $tag['subcategory_name'] ?? 'N/A' ?></span></td>
                            <td><span class="badge" style="text-transform: uppercase; background: rgba(204, 34, 34, 0.1); color: var(--admin-primary);"><?= $tag['lang'] ?></span></td>
                            <td>
                                <div class="action-group">
                                    <a href="<?= SITE_URL ?>/admin/tags/<?= $tag['id'] ?>/edit" class="btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="<?= SITE_URL ?>/admin/tags/<?= $tag['id'] ?>/delete" method="POST" onsubmit="return confirm('Truly delete this tag?');" style="display:inline;">
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
