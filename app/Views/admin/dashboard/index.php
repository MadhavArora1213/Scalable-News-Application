<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <div class="admin-container">
        
        <!-- Welcome Banner -->
        <div class="dashboard-welcome">
            <div style="z-index: 2; position: relative;">
                <h2>Welcome Back, Chief Editor!</h2>
                <p>Here's what's happening on Khabran News Portal today.</p>
            </div>
            <!-- Decorative circle -->
            <div style="position: absolute; right: -50px; top: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
        </div>

        <header class="content-header" style="margin-bottom: 25px;">
            <h3 style="font-weight: 800; color: #fff;">Live Statistics</h3>
            <div class="header-actions">
                <button class="btn btn-secondary" onclick="location.reload()"><i class="fas fa-sync"></i> Sync Now</button>
            </div>
        </header>

        <!-- Refined Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: rgba(49, 130, 206, 0.1); color: #3182ce;"><i class="fas fa-newspaper"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #fff;"><?= $stats['articles'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: var(--admin-text-muted); text-transform: uppercase;">Total Articles</div>
            </div>
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: rgba(229, 62, 62, 0.1); color: #e53e3e;"><i class="fas fa-file-signature"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #fff;"><?= $stats['pending'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: var(--admin-text-muted); text-transform: uppercase;">Drafts / Pending</div>
            </div>
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: rgba(56, 161, 105, 0.1); color: #38a169;"><i class="fas fa-user-friends"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #fff;"><?= $stats['subscribers'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: var(--admin-text-muted); text-transform: uppercase;">Subscribers</div>
            </div>
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: rgba(128, 90, 213, 0.1); color: #805ad5;"><i class="fas fa-layer-group"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #fff;"><?= $stats['categories'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: var(--admin-text-muted); text-transform: uppercase;">Active Sections</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Content Activity Table -->
            <div class="admin-panel-box" style="padding: 0; overflow: hidden; border: 1px solid var(--admin-border);">
                <div class="box-header" style="padding: 25px 30px; border-bottom: 1px solid var(--admin-border); margin-bottom: 0;">
                    <h3 style="margin:0; color: #fff;"><i class="fas fa-history" style="color:var(--admin-primary);"></i> Working History</h3>
                    <a href="<?= SITE_URL ?>/admin/articles" style="font-size: 0.85rem; font-weight: 700; color: #3182ce; text-decoration:none;">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead style="background: rgba(255,255,255,0.02);">
                            <tr>
                                <th style="padding: 15px 30px;">Content Item</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th style="padding: 15px 30px;">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($latest_articles)): ?>
                                <tr><td colspan="4" style="text-align:center; padding: 60px; color: var(--admin-text-muted);">No recent activity yet.</td></tr>
                            <?php else: foreach($latest_articles as $art): ?>
                            <tr>
                                <td style="padding: 20px 30px;">
                                    <div style="display: flex; flex-direction: column;">
                                        <span style="font-weight: 700; color: #fff;"><?= htmlspecialchars($art['title']) ?></span>
                                        <span style="font-size: 0.75rem; color: var(--admin-text-muted);">Article ID: #<?= rand(1000, 9999) ?></span>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600; color: var(--admin-text-muted);"><?= $art['author'] ?? 'System' ?></span></td>
                                <td><span class="status-pill <?= $art['status'] ?>"><?= ucfirst($art['status'] == 'published' ? 'Live' : 'Draft') ?></span></td>
                                <td style="padding: 20px 30px; font-size: 0.85rem; color: var(--admin-text-muted);"><?= date('M d, H:i', strtotime($art['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Event Stream Sidebar -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="admin-panel-box" style="padding: 30px; border: 1px solid var(--admin-border);">
                    <h3 style="margin-bottom: 25px; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; color: #fff;">
                        <i class="fas fa-satellite-dish" style="color: #48bb78;"></i> Intelligence Stream
                    </h3>
                    <div style="position: relative;">
                        <!-- Timeline line -->
                        <div style="position: absolute; left: 3px; top: 0; bottom: 0; width: 2px; background: var(--admin-border);"></div>

                        <?php foreach($recent_activity as $act): ?>
                        <div style="position: relative; padding-left: 25px; margin-bottom: 25px;">
                            <div class="activity-dot" style="position: absolute; left: 0; background: <?= $act['color'] ?>; box-shadow: 0 0 0 4px var(--admin-card-bg);"></div>
                            <div style="font-size: 0.9rem; font-weight: 700; color: #fff;"><?= $act['title'] ?></div>
                            <div style="font-size: 0.75rem; color: var(--admin-text-muted);"><?= date('h:i A', strtotime($act['time'])) ?> • <?= $act['user'] ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- AdSense Card -->
                <div class="adsense-card" style="border: 1px solid var(--admin-border);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="font-size: 1rem; color: var(--admin-text-muted);">Daily Revenue</h3>
                        <div style="width: 35px; height: 35px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #f59e0b;">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                    <div class="rev-value-big" style="color: #fff;">₹0.00</div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 15px; color: #48bb78; font-weight: 700; font-size: 0.85rem;">
                        <i class="fas fa-sync-alt fa-spin"></i> Waiting for Live Feed
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
