<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1>Dashboard Overview</h1>
        <div class="header-actions">
            <a href="<?= SITE_URL ?>/admin/articles/new" class="btn btn-primary"><i class="fas fa-plus"></i> NEW ARTICLE</a>
            <button class="btn btn-secondary" onclick="location.reload()"><i class="fas fa-sync"></i> Refresh stats</button>
        </div>
    </header>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-newspaper"></i></div>
            <div class="stat-info">
                <span class="stat-label">Total Articles</span>
                <span class="stat-value"><?= $stats['articles'] ?></span>
            </div>
            <div class="stat-trend positive">+4% this week</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fff3e0; color: #ef6c00;"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <span class="stat-label">Pending Review</span>
                <span class="stat-value"><?= $stats['pending'] ?></span>
            </div>
            <div class="stat-trend warning">Action required</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #e8f5e9; color: #2e7d32;"><i class="fas fa-tags"></i></div>
            <div class="stat-info">
                <span class="stat-label">Categories</span>
                <span class="stat-value"><?= $stats['categories'] ?></span>
            </div>
            <div class="stat-trend">Live on site</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #f3e5f5; color: #7b1fa2;"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <span class="stat-label">Active Users</span>
                <span class="stat-value"><?= $stats['users'] ?></span>
            </div>
            <div class="stat-trend positive">3 new today</div>
        </div>
    </div>

    <div class="dashboard-secondary-grid">
        <!-- Latest Articles List -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3>Latest Content Activity</h3>
                <a href="<?= SITE_URL ?>/admin/articles" class="btn-text">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Article Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($latest_articles as $art): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($art['title']) ?></strong></td>
                            <td><?= htmlspecialchars($art['author']) ?></td>
                            <td><span class="status-pill <?= $art['status'] ?>"><?= ucfirst($art['status']) ?></span></td>
                            <td><?= date('M d, H:i', strtotime($art['published_at'] ?? 'now')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Controls -->
        <div class="side-controls">
            <div class="admin-panel-box">
                <h3>Breaking News Toggle</h3>
                <p class="text-muted">Instantly activate or deactivate the homepage ticker.</p>
                <div class="toggle-control">
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                    <span>Ticker is <strong>ACTIVE</strong></span>
                </div>
                <hr>
                <a href="<?= SITE_URL ?>/admin/breaking" class="btn btn-outline full-width">EDIT TICKER CONTENT</a>
            </div>

            <div class="admin-panel-box featured-card">
                <h3>AdSense Status</h3>
                <div class="revenue-display">
                    <span class="rev-label">Earnings (Today)</span>
                    <span class="rev-value">₹4.20</span>
                </div>
                <div class="rev-chart-placeholder">
                    <!-- Simple visualization -->
                    <div style="height: 10px; background: #eee; border-radius: 5px; margin-top: 10px;">
                        <div style="width: 70%; height: 100%; background: var(--crimson); border-radius: 5px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
