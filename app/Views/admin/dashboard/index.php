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
            <h3 style="font-weight: 800; color: #1e293b;">Live Statistics</h3>
            <div class="header-actions">
                <button class="btn btn-secondary" onclick="location.reload()"><i class="fas fa-sync"></i> Sync Now</button>
            </div>
        </header>

        <!-- Refined Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: #ebf8ff; color: #3182ce;"><i class="fas fa-newspaper"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #1e293b;"><?= $stats['articles'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Articles</div>
            </div>
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: #fff5f5; color: #e53e3e;"><i class="fas fa-file-signature"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #1e293b;"><?= $stats['pending'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Drafts / Pending</div>
            </div>
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: #f0fff4; color: #38a169;"><i class="fas fa-user-friends"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #1e293b;"><?= $stats['subscribers'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Subscribers</div>
            </div>
            <div class="stat-card-premium">
                <div class="stat-icon-wrap" style="background: #faf5ff; color: #805ad5;"><i class="fas fa-layer-group"></i></div>
                <div style="font-size: 2rem; font-weight: 900; color: #1e293b;"><?= $stats['categories'] ?></div>
                <div style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Active Sections</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Content Activity Table -->
            <div class="admin-panel-box" style="padding: 0; overflow: hidden;">
                <div class="box-header" style="padding: 25px 30px; border-bottom: 1px solid #f1f5f9;">
                    <h3 style="margin:0;"><i class="fas fa-history" style="color:var(--admin-primary);"></i> Working History</h3>
                    <a href="<?= SITE_URL ?>/admin/articles" style="font-size: 0.85rem; font-weight: 700; color: #3182ce; text-decoration:none;">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="padding: 15px 30px;">Content Item</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th style="padding: 15px 30px;">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($latest_articles)): ?>
                                <tr><td colspan="4" style="text-align:center; padding: 60px;">No recent activity yet.</td></tr>
                            <?php else: foreach($latest_articles as $art): ?>
                            <tr>
                                <td style="padding: 20px 30px;">
                                    <div style="display: flex; flex-direction: column;">
                                        <span style="font-weight: 700; color: #1e293b;"><?= htmlspecialchars($art['title']) ?></span>
                                        <span style="font-size: 0.75rem; color: #94a3b8;">Article ID: #<?= rand(1000, 9999) ?></span>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600; color: #64748b;"><?= $art['author'] ?? 'System' ?></span></td>
                                <td><span class="status-pill <?= $art['status'] ?>"><?= ucfirst($art['status'] == 'published' ? 'Live' : 'Draft') ?></span></td>
                                <td style="padding: 20px 30px; font-size: 0.85rem; color: #94a3b8;"><?= date('M d, H:i', strtotime($art['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Event Stream Sidebar -->
            <div style="display: flex; flex-direction: column; gap: 30px;">
                <div class="admin-panel-box" style="padding: 30px;">
                    <h3 style="margin-bottom: 25px; font-size: 1.1rem; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-satellite-dish" style="color: #48bb78;"></i> Intelligence Stream
                    </h3>
                    <div style="position: relative;">
                        <!-- Timeline line -->
                        <div style="position: absolute; left: 3px; top: 0; bottom: 0; width: 2px; background: #f1f5f9;"></div>

                        <?php foreach($recent_activity as $act): ?>
                        <div style="position: relative; padding-left: 25px; margin-bottom: 25px;">
                            <div class="activity-dot" style="position: absolute; left: 0; background: <?= $act['color'] ?>; box-shadow: 0 0 0 4px #fff;"></div>
                            <div style="font-size: 0.9rem; font-weight: 700; color: #1e293b;"><?= $act['title'] ?></div>
                            <div style="font-size: 0.75rem; color: #94a3b8;"><?= date('h:i A', strtotime($act['time'])) ?> • <?= $act['user'] ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- AdSense Card -->
                <div class="adsense-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="font-size: 1rem; color: #64748b;">Daily Revenue</h3>
                        <div style="width: 35px; height: 35px; background: #fffbeb; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #f59e0b;">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                    <div class="rev-value-big">₹0.00</div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 15px; color: #48bb78; font-weight: 700; font-size: 0.85rem;">
                        <i class="fas fa-sync-alt fa-spin"></i> Waiting for Live Feed
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
