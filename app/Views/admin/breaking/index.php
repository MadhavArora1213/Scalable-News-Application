<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-bolt" style="color: #facc15;"></i> Breaking News Ticker Manager</h1>
    </header>

    <div style="display: grid; grid-template-columns: 400px 1fr; gap: 30px; align-items: start;">
        <div style="display: flex; flex-direction: column; gap: 25px;">
            <!-- Option A: Promote Existing Article -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3><i class="fas fa-file-alt"></i> Option A: Promote Article</h3>
                </div>
                <div style="padding: 20px;">
                    <p style="font-size: 0.75rem; color: var(--admin-text-muted); margin-bottom: 15px;">Select a recently published article to add to the live ticker.</p>
                    <form action="<?= SITE_URL ?>/admin/breaking/promote" method="POST">
                        <div class="form-group">
                            <label style="color: var(--admin-primary); font-size: 0.75rem; text-transform: uppercase;">Recent Articles</label>
                            <select name="article_id" class="form-control" required>
                                <option value="">-- Choose Article --</option>
                                <?php foreach($recentArticles as $art): ?>
                                    <option value="<?= $art['id'] ?>"><?= htmlspecialchars($art['title']) ?> (<?= strtoupper($art['lang']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-plus"></i> ADD TO TICKER
                        </button>
                    </form>
                </div>
            </div>

            <!-- Option B: Manual Ticker Item -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3><i class="fas fa-edit"></i> Option B: Custom Headline</h3>
                </div>
                <form action="<?= SITE_URL ?>/admin/breaking/store" method="POST" style="padding: 20px;">
                    <div class="form-group">
                        <label style="color: var(--admin-primary); font-size: 0.75rem; text-transform: uppercase;">Headline Text</label>
                        <textarea name="headline" class="form-control" style="min-height: 80px; font-weight: 600;" placeholder="e.g. Traffic alert in Amritsar..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label style="color: var(--admin-primary); font-size: 0.75rem; text-transform: uppercase;">Language</label>
                        <select name="lang" class="form-control">
                            <option value="pa">ਪੰਜਾਬੀ</option>
                            <option value="hi">हिन्दी</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center;">
                        <i class="fas fa-bullhorn"></i> PUSH CUSTOM ALERT
                    </button>
                </form>
            </div>
        </div>

        <!-- Ticker List -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3>Currently Scrolling Items</h3>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Headline</th>
                            <th>Language</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($items)): ?>
                            <tr><td colspan="4" style="text-align:center; padding: 40px; color: var(--admin-text-muted);">No alerts active in the ticker.</td></tr>
                        <?php else: foreach($items as $item): ?>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 8px; height: 8px; background: <?= $item['is_active'] ? '#22c55e' : '#64748b' ?>; border-radius: 50%; box-shadow: <?= $item['is_active'] ? '0 0 10px rgba(34, 197, 94, 0.4)' : 'none' ?>;"></div>
                                    <strong style="font-size: 0.9rem;"><?= htmlspecialchars($item['headline']) ?></strong>
                                </div>
                            </td>
                            <td><span class="badge" style="text-transform: uppercase;"><?= $item['lang'] ?></span></td>
                            <td>
                                <span class="status-pill <?= $item['is_active'] ? 'published' : 'draft' ?>">
                                    <?= $item['is_active'] ? 'Active' : 'Paused' ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="<?= SITE_URL ?>/admin/breaking/<?= $item['id'] ?>/toggle" class="btn-icon" title="<?= $item['is_active'] ? 'Pause' : 'Activate' ?>">
                                        <i class="fas <?= $item['is_active'] ? 'fa-pause' : 'fa-play' ?>"></i>
                                    </a>
                                    <form action="<?= SITE_URL ?>/admin/breaking/<?= $item['id'] ?>/delete" method="POST" style="display:inline;" onsubmit="return confirm('Remove this from ticker?');">
                                        <button type="submit" class="btn-icon delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 25px; padding: 15px; background: rgba(245, 158, 11, 0.05); border-radius: 8px; border-left: 4px solid #f59e0b; font-size: 0.85rem; color: #d97706;">
                <i class="fas fa-info-circle"></i> <strong>Pro-tip:</strong> Keep headlines under 100 characters for best scrolling performance.
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
