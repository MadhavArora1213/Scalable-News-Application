<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-tachometer-alt"></i> Control Center Dashboard</h1>
            <div class="header-actions">
                <a href="<?= SITE_URL ?>/admin/articles/new" class="btn btn-primary"><i class="fas fa-plus"></i> NEW ARTICLE</a>
                <button class="btn btn-secondary" onclick="location.reload()"><i class="fas fa-sync"></i> REFRESH LIVE DATA</button>
            </div>
        </header>

        <!-- Dynamic Stats Grid -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px;">
            <div class="stat-card" style="border-bottom: 4px solid #3182ce;">
                <div class="stat-info">
                    <span class="stat-value"><?= $stats['articles'] ?></span>
                    <span class="stat-label">Published Articles</span>
                </div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #e53e3e;">
                <div class="stat-info">
                    <span class="stat-value"><?= $stats['pending'] ?></span>
                    <span class="stat-label">Drafts (Pending)</span>
                </div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #38a169;">
                <div class="stat-info">
                    <span class="stat-value"><?= $stats['subscribers'] ?></span>
                    <span class="stat-label">Newsletters / Subs</span>
                </div>
            </div>
            <div class="stat-card" style="border-bottom: 4px solid #805ad5;">
                <div class="stat-info">
                    <span class="stat-value"><?= $stats['categories'] ?></span>
                    <span class="stat-label">Categories Live</span>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Main Activity Table: "Working Table" -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3><i class="fas fa-history"></i> Recent Working Activity</h3>
                    <span style="font-size: 0.8rem; color: #718096;">Live actions performed in panel</span>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Action / Item</th>
                                <th>Performed By</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($latest_articles)): ?>
                                <tr><td colspan="4" style="text-align:center; padding: 40px; color: #a0aec0;">No recent actions found. Start by creating an article!</td></tr>
                            <?php else: foreach($latest_articles as $art): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="background: #ebf8ff; color: #3182ce; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <strong><?= htmlspecialchars($art['title']) ?></strong>
                                    </div>
                                </td>
                                <td><span style="color: #718096;"><?= $art['author'] ?? 'Admin User' ?></span></td>
                                <td><span class="status-pill <?= $art['status'] ?>"><?= ucfirst($art['status']) ?></span></td>
                                <td style="font-size: 0.85rem; color: #a0aec0;"><?= date('M d, H:i', strtotime($art['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Side Activity Feed -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="admin-panel-box">
                    <div class="box-header">
                        <h3><i class="fas fa-stream"></i> Event Stream</h3>
                    </div>
                    <div style="padding: 20px;">
                        <?php foreach($recent_activity as $act): ?>
                        <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                            <div style="color: <?= $act['color'] ?>; font-size: 1.2rem; padding-top: 3px;">
                                <i class="<?= $act['icon'] ?>"></i>
                            </div>
                            <div>
                                <div style="font-size: 0.9rem; font-weight: 600; color: #2d3748;"><?= $act['title'] ?></div>
                                <div style="font-size: 0.75rem; color: #a0aec0;"><?= date('h:i A', strtotime($act['time'])) ?> • By <?= $act['user'] ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="admin-panel-box featured-card" style="background: #fff; color: var(--admin-text); border-top: 5px solid var(--admin-primary);">
                    <h3>AdSense Potential</h3>
                    <div style="padding: 10px 0;">
                        <span style="display: block; font-size: 0.8rem; opacity: 0.8;">Est. Today's Revenue</span>
                        <span style="font-size: 2rem; font-weight: 900; color: var(--admin-primary);">₹0.00</span>
                    </div>
                    <p style="font-size: 0.85rem; margin-top: 10px;">Connect your Google SEO and AdSense accounts in the SEO Manager to start tracking.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
