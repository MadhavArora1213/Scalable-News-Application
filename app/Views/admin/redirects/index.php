<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-random" style="color: var(--admin-primary); margin-right: 10px;"></i> URL Redirects (SEO)</h1>
        <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px;">Manage automatic 301 redirects to ensure old links never break.</p>
    </header>

    <div style="display: grid; grid-template-columns: 400px 1fr; gap: 30px; align-items: start;">
        
        <!-- Add Redirect -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3>Add Manual Redirect</h3>
            </div>
            <form action="<?= SITE_URL ?>/admin/redirects/store" method="POST" style="padding: 20px;">
                <div class="form-group">
                    <label style="color: var(--admin-primary); font-size: 0.75rem; text-transform: uppercase;">Old URL Path</label>
                    <input type="text" name="old_url" class="form-control" placeholder="e.g. en/old-category/old-slug" required>
                    <small style="color: var(--admin-text-muted); font-size: 0.65rem;">Do not include the domain name.</small>
                </div>
                <div class="form-group">
                    <label style="color: var(--admin-primary); font-size: 0.75rem; text-transform: uppercase;">New URL Path</label>
                    <input type="text" name="new_url" class="form-control" placeholder="e.g. en/new-category/new-slug" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
                    <i class="fas fa-plus-circle"></i> CREATE REDIRECT
                </button>
            </form>
        </div>

        <!-- Redirect List -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3>Active Redirection Rules</h3>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Old URL (Incoming)</th>
                            <th style="width: 30px;"><i class="fas fa-arrow-right"></i></th>
                            <th>New URL (Target)</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($redirects)): ?>
                            <tr><td colspan="4" style="text-align:center; padding: 40px; color: var(--admin-text-muted);">No redirects found. The system will create them automatically when you change article titles.</td></tr>
                        <?php else: foreach($redirects as $r): ?>
                        <tr>
                            <td><code style="font-size: 0.8rem; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 4px;"><?= htmlspecialchars($r['old_url']) ?></code></td>
                            <td><i class="fas fa-long-arrow-alt-right" style="color: var(--admin-primary);"></i></td>
                            <td><code style="font-size: 0.8rem; background: rgba(0,0,0,0.2); padding: 4px 8px; border-radius: 4px; border: 1px solid var(--admin-border);"><?= htmlspecialchars($r['new_url']) ?></code></td>
                            <td style="text-align: right;">
                                <form action="<?= SITE_URL ?>/admin/redirects/<?= $r['id'] ?>/delete" method="POST" onsubmit="return confirm('Delete this redirect rule?');">
                                    <button type="submit" class="btn-icon delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
