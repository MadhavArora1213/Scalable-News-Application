<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1>All Articles</h1>
        <div class="header-actions">
            <a href="<?= SITE_URL ?>/admin/articles/new" class="btn btn-primary"><i class="fas fa-plus"></i> NEW ARTICLE</a>
        </div>
    </header>

    <div class="admin-panel-box">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Lang</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($articles)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 40px;">No articles found. Start creating!</td></tr>
                    <?php else: foreach($articles as $art): ?>
                    <tr>
                        <td>
                            <div class="table-thumb" style="background: url('<?= SITE_URL ?>/<?= $art['image_path'] ?? 'assets/img/placeholder.png' ?>') center/cover;"></div>
                        </td>
                        <td>
                            <div class="art-title-cell">
                                <strong><?= htmlspecialchars($art['title']) ?></strong>
                                <span class="art-slug">/<?= $art['slug'] ?></span>
                            </div>
                        </td>
                        <td><span class="badge"><?= htmlspecialchars($art['category_name']) ?></span></td>
                        <td>
                            <div style="max-width: 150px; font-size: 0.75rem; color: #64748b; line-height: 1.2;">
                                <?= $art['tag_list'] ? htmlspecialchars($art['tag_list']) : '<em style="color:#cbd5e1;">No tags</em>' ?>
                            </div>
                        </td>
                        <td><span class="badge" style="text-transform: uppercase;"><?= $art['lang'] ?></span></td>
                        <td><span class="status-pill <?= $art['priority'] ?>"><?= ucfirst($art['priority']) ?></span></td>
                        <td><span class="status-pill <?= $art['status'] ?>"><?= ucfirst($art['status']) ?></span></td>
                        <td><?= date('M d, Y', strtotime($art['created_at'])) ?></td>
                        <td>
                            <div class="action-group">
                                <a href="<?= SITE_URL ?>/admin/articles/<?= $art['id'] ?>/edit" class="btn-icon" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="<?= SITE_URL ?>/admin/articles/<?= $art['id'] ?>/delete" method="POST" onsubmit="return confirm('Truly delete this article?');" style="display:inline;">
                                    <button type="submit" class="btn-icon delete"><i class="fas fa-trash"></i></button>
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

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
