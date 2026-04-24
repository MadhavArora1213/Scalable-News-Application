<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-chart-line" style="color: var(--admin-primary); margin-right: 10px;"></i> Analytics & Trending</h1>
        <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px;">Track your website's traffic and identify your most popular news stories.</p>
    </header>

    <!-- Overview Card -->
    <div class="admin-panel-box" style="padding: 40px; margin-bottom: 40px; background: linear-gradient(135deg, #0f172a 0%, #020617 100%);">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="color: var(--admin-text-muted); text-transform: uppercase; letter-spacing: 2px; font-size: 0.75rem; font-weight: 800; margin-bottom: 15px;">Global Lifetime Traffic</p>
                <h2 style="font-size: 3.5rem; font-weight: 900; color: #fff; line-height: 1;"><?= number_format($totalViews) ?> <span style="font-size: 1rem; color: #10b981; vertical-align: middle; margin-left: 10px;"><i class="fas fa-arrow-up"></i> LIVE</span></h2>
            </div>
            <div style="width: 100px; height: 100px; background: rgba(204, 34, 34, 0.1); border-radius: 24px; display: flex; align-items: center; justify-content: center; color: var(--admin-primary); font-size: 2.5rem;">
                <i class="fas fa-eye"></i>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        
        <!-- Trending Today -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3><i class="fas fa-fire" style="color: #ff4500;"></i> Trending Stories (Last 24h)</h3>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Story Title</th>
                            <th style="text-align: right;">Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($trendingToday)): ?>
                            <tr><td colspan="2" style="text-align:center; padding: 40px; color: var(--admin-text-muted);">No traffic recorded in the last 24 hours.</td></tr>
                        <?php else: foreach($trendingToday as $art): ?>
                        <tr>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <strong style="font-size: 0.85rem; color: #fff;"><?= htmlspecialchars($art['title']) ?></strong>
                                    <span style="font-size: 0.65rem; color: var(--admin-text-muted); text-transform: uppercase;"><?= $art['lang'] ?> / <?= $art['cat_slug'] ?></span>
                                </div>
                            </td>
                            <td style="text-align: right; font-weight: 800; color: #10b981;"><?= number_format($art['view_count']) ?></td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Trending Week -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3><i class="fas fa-calendar-alt" style="color: #3b82f6;"></i> Most Popular (This Week)</h3>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Story Title</th>
                            <th style="text-align: right;">Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($trendingWeek)): ?>
                            <tr><td colspan="2" style="text-align:center; padding: 40px; color: var(--admin-text-muted);">No traffic recorded this week.</td></tr>
                        <?php else: foreach($trendingWeek as $art): ?>
                        <tr>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <strong style="font-size: 0.85rem; color: #fff;"><?= htmlspecialchars($art['title']) ?></strong>
                                    <span style="font-size: 0.65rem; color: var(--admin-text-muted); text-transform: uppercase;"><?= $art['lang'] ?> / <?= $art['cat_slug'] ?></span>
                                </div>
                            </td>
                            <td style="text-align: right; font-weight: 800; color: #fff;"><?= number_format($art['view_count']) ?></td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
