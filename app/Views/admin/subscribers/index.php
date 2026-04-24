<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-users" style="color: var(--admin-primary); margin-right: 10px;"></i> Audience Engagement</h1>
        <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px;">Manage your email newsletter subscribers and browser notification base.</p>
    </header>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
        <div class="admin-panel-box" style="padding: 30px; display: flex; align-items: center; gap: 25px;">
            <div style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 1.8rem;">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div>
                <h2 style="font-size: 2.2rem; color: #fff; line-height: 1;"><?= $emailCount ?></h2>
                <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px;">Email Subscribers</p>
            </div>
        </div>

        <div class="admin-panel-box" style="padding: 30px; display: flex; align-items: center; gap: 25px;">
            <div style="width: 70px; height: 70px; background: rgba(59, 130, 246, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #3b82f6; font-size: 1.8rem;">
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <h2 style="font-size: 2.2rem; color: #fff; line-height: 1;"><?= $pushCount ?></h2>
                <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px;">Push Subscribers</p>
            </div>
        </div>
    </div>

    <!-- Subscriber Table -->
    <div class="admin-panel-box">
        <div class="box-header">
            <h3><i class="fas fa-list"></i> Newsletter Directory</h3>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Reader Name</th>
                        <th>Email Address</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Joined On</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($subscribers)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 60px; color: var(--admin-text-muted); font-size: 0.85rem;">No active subscribers yet. Start growing your audience!</td></tr>
                    <?php else: foreach($subscribers as $s): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($s['name'] ?: 'Guest Reader') ?></strong></td>
                        <td><code style="font-size: 0.85rem;"><?= htmlspecialchars($s['email']) ?></code></td>
                        <td><span style="font-size: 0.7rem; font-weight: 800; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 4px; color: var(--admin-text-muted);"><?= strtoupper($s['lang_pref']) ?></span></td>
                        <td>
                            <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; background: <?= $s['status'] === 'verified' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' ?>; color: <?= $s['status'] === 'verified' ? '#10b981' : '#f59e0b' ?>;">
                                <i class="fas <?= $s['status'] === 'verified' ? 'fa-check-circle' : 'fa-clock' ?>"></i>
                                <?= ucfirst($s['status']) ?>
                            </span>
                        </td>
                        <td style="color: var(--admin-text-muted); font-size: 0.8rem;"><?= date('M d, Y', strtotime($s['subscribed_at'])) ?></td>
                        <td style="text-align: right;">
                            <form action="<?= SITE_URL ?>/admin/subscribers/<?= $s['id'] ?>/delete" method="POST" onsubmit="return confirm('Remove this subscriber from the list?');">
                                <button type="submit" class="btn-icon delete"><i class="fas fa-user-minus"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
