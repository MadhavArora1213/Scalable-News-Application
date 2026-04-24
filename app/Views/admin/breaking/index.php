<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <header class="content-header">
        <h1><i class="fas fa-bolt" style="color: #facc15; margin-right: 10px;"></i> Breaking News Ticker</h1>
        <p style="color: var(--admin-text-muted); font-size: 0.85rem; margin-top: 5px;">Create and manage the scrolling news bar at the top of your website.</p>
    </header>

    <div style="display: grid; grid-template-columns: 450px 1fr; gap: 30px; align-items: start;">
        
        <!-- Action Panel -->
        <div style="display: flex; flex-direction: column; gap: 25px;">
            
            <div class="admin-panel-box" style="border: 1px solid rgba(255,255,255,0.05);">
                <div class="box-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding: 15px 20px;">
                    <h3 style="font-size: 0.9rem; letter-spacing: 0.5px; color: #fff;">ADD NEW ALERT</h3>
                </div>
                
                <div style="padding: 25px;">
                    <!-- Manual Entry -->
                    <form action="<?= SITE_URL ?>/admin/breaking/store" method="POST" style="margin-bottom: 30px;">
                        <label style="display: block; font-size: 0.75rem; color: var(--admin-primary); margin-bottom: 10px; font-weight: 700;">Type your news here:</label>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <textarea name="headline" class="form-control" style="min-height: 70px; background: rgba(0,0,0,0.2); border: 1px solid var(--admin-border); font-size: 0.9rem;" placeholder="Write a short headline here..." required></textarea>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px;">
                            <select name="lang" class="form-control" style="background: rgba(0,0,0,0.2); border: 1px solid var(--admin-border);">
                                <option value="pa">ਪੰਜਾਬੀ (Punjabi)</option>
                                <option value="hi">हिन्दी (Hindi)</option>
                                <option value="en">English</option>
                            </select>
                            <button type="submit" class="btn btn-primary" style="justify-content: center; font-size: 0.8rem;">
                                <i class="fas fa-plus"></i> ADD TO BAR
                            </button>
                        </div>
                    </form>

                    <div style="height: 1px; background: rgba(255,255,255,0.05); margin: 25px 0;"></div>

                    <!-- Promote Article -->
                    <form action="<?= SITE_URL ?>/admin/breaking/promote" method="POST">
                        <label style="display: block; font-size: 0.75rem; color: var(--admin-primary); margin-bottom: 10px; font-weight: 700;">Or pick from recent articles:</label>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <select name="article_id" class="form-control" style="background: rgba(0,0,0,0.2); border: 1px solid var(--admin-border); font-size: 0.85rem;" required>
                                <option value="">-- Select an Article --</option>
                                <?php foreach($recentArticles as $art): ?>
                                    <option value="<?= $art['id'] ?>"><?= htmlspecialchars($art['title']) ?> (<?= strtoupper($art['lang']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center; font-size: 0.8rem;">
                            <i class="fas fa-check"></i> USE THIS ARTICLE
                        </button>
                    </form>
                </div>
            </div>

            <div style="padding: 20px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                <h4 style="font-size: 0.75rem; color: #fff; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-lightbulb" style="color: #facc15;"></i> Helpful Tips
                </h4>
                <ul style="padding-left: 18px; color: var(--admin-text-muted); font-size: 0.75rem; line-height: 1.6;">
                    <li>Keep headlines short so they scroll faster.</li>
                    <li>The top items will show up first on the website.</li>
                    <li>You can pause any item without deleting it.</li>
                </ul>
            </div>
        </div>

        <!-- Monitoring Panel -->
        <div class="admin-panel-box" style="border: 1px solid rgba(255,255,255,0.05);">
            <div class="box-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding: 15px 20px;">
                <h3 style="font-size: 0.9rem; letter-spacing: 0.5px; color: #fff;">CURRENT BREAKING NEWS</h3>
            </div>
            
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="padding-left: 20px;">HEADLINE</th>
                            <th>LANGUAGE</th>
                            <th>STATUS</th>
                            <th style="text-align: right; padding-right: 20px;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($items)): ?>
                            <tr><td colspan="4" style="text-align:center; padding: 60px; color: var(--admin-text-muted); font-size: 0.85rem;">No breaking news right now.</td></tr>
                        <?php else: foreach($items as $item): ?>
                        <tr>
                            <td style="padding-left: 20px;">
                                <div style="max-width: 400px; line-height: 1.4;">
                                    <strong style="font-size: 0.85rem; color: #eee;"><?= htmlspecialchars($item['headline']) ?></strong>
                                    <?php if($item['url'] !== '#'): ?>
                                        <div style="font-size: 0.65rem; color: var(--admin-primary); margin-top: 4px;">Link: <?= $item['url'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><span style="font-size: 0.7rem; font-weight: 800; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 4px; color: var(--admin-text-muted);"><?= strtoupper($item['lang']) ?></span></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 6px; height: 6px; background: <?= $item['is_active'] ? '#10b981' : '#475569' ?>; border-radius: 50%; <?= $item['is_active'] ? 'box-shadow: 0 0 10px #10b981;' : '' ?>"></div>
                                    <span style="font-size: 0.75rem; color: <?= $item['is_active'] ? '#10b981' : 'var(--admin-text-muted)' ?>; font-weight: 600;">
                                        <?= $item['is_active'] ? 'SHOWING' : 'HIDDEN' ?>
                                    </span>
                                </div>
                            </td>
                            <td style="text-align: right; padding-right: 20px;">
                                <div class="action-group" style="justify-content: flex-end;">
                                    <a href="<?= SITE_URL ?>/admin/breaking/<?= $item['id'] ?>/toggle" class="btn-icon" title="<?= $item['is_active'] ? 'Hide from website' : 'Show on website' ?>">
                                        <i class="fas <?= $item['is_active'] ? 'fa-eye-slash' : 'fa-eye' ?>" style="font-size: 0.75rem;"></i>
                                    </a>
                                    <form action="<?= SITE_URL ?>/admin/breaking/<?= $item['id'] ?>/delete" method="POST" style="display:inline;" onsubmit="return confirm('Delete this news?');">
                                        <button type="submit" class="btn-icon delete"><i class="fas fa-trash-alt" style="font-size: 0.75rem;"></i></button>
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
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
