<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-bolt"></i> Breaking News Ticker Manager</h1>
        </header>

        <div style="display: grid; grid-template-columns: 380px 1fr; gap: 40px; align-items: start;">
            <!-- Add Ticker Item -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Add New Alert</h3>
                </div>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label>Alert Headline (Keep it short)</label>
                        <textarea class="form-control" style="min-height: 120px; font-size: 1.1rem; font-weight: 600;" placeholder="Enter high-priority news alert..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Display Language</label>
                        <select class="form-control">
                            <option value="pa">ਪੰਜਾਬੀ (Punjabi)</option>
                            <option value="hi">हिन्दी (Hindi)</option>
                            <option value="en">English (Global)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target URL (Optional)</label>
                        <input type="text" class="form-control" placeholder="https://khabran.com/pa/politics/..." value="#">
                    </div>
                    <button type="button" class="btn btn-primary btn-block" onclick="alert('Alert added to live ticker!')">
                        <i class="fas fa-bullhorn"></i> PUSH TO TICKER
                    </button>
                </form>
            </div>

            <!-- Ticker List -->
            <div class="admin-panel-box">
                <div class="box-header">
                    <h3>Currently Scrolling on Homepage</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Active Alert Headline</th>
                                <th>Language</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($items)): ?>
                                <tr><td colspan="4" style="text-align:center; padding: 20px;">No alerts active.</td></tr>
                            <?php else: foreach($items as $item): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div style="width: 10px; height: 10px; background: #2ecc71; border-radius: 50%; box-shadow: 0 0 10px rgba(46, 204, 113, 0.5);"></div>
                                        <strong style="color: #2d3748;"><?= htmlspecialchars($item['text']) ?></strong>
                                    </div>
                                </td>
                                <td><span class="badge"><?= $item['lang'] === 'pa' ? 'Punjabi' : ($item['lang'] === 'hi' ? 'Hindi' : 'English') ?></span></td>
                                <td><span class="status-pill published">Scrolling</span></td>
                                <td>
                                    <div class="action-group">
                                        <button class="btn-icon delete" title="Remove from ticker"><i class="fas fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 25px; padding: 15px; background: #fff8f1; border-radius: 8px; border-left: 4px solid #f39c12; font-size: 0.9rem; color: #7e561e;">
                    <i class="fas fa-info-circle"></i> <strong>Note:</strong> High-priority alerts appear on the ticker immediately. Max 5 items recommended for readability.
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
