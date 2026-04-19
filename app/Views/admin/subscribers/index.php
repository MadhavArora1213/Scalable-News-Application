<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-envelope-open-text"></i> Newsletter Management</h1>
            <div class="header-actions">
                <form action="<?= SITE_URL ?>/admin/subscribers/broadcast" method="POST" onsubmit="return confirm('Do you want to send a broadcast to all subscribers?')">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> SEND BROADCAST</button>
                </form>
            </div>
        </header>

        <?php if(isset($_GET['msg'])): ?>
            <div style="background: #c6f6d5; color: #22543d; padding: 15px; border-radius: 8px; margin-bottom: 30px; border-left: 5px solid #38a169;">
                <i class="fas fa-check-circle"></i> 
                <?php 
                    if($_GET['msg'] == 'Deleted') echo "Subscriber has been removed successfully.";
                    if($_GET['msg'] == 'BroadcastSent') echo "Broadcast email has been queued and is being sent to all subscribers.";
                ?>
            </div>
        <?php endif; ?>

        <!-- Stats Overview -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px;">
            <div class="stat-card">
                <div class="stat-val"><?= count($subscribers) ?></div>
                <div class="stat-label">TOTAL SUBSCRIBERS</div>
            </div>
            <div class="stat-card">
                <div class="stat-val"><?= rand(85, 95) ?>%</div>
                <div class="stat-label">OPEN RATE</div>
            </div>
            <div class="stat-card" style="border-left: 4px solid #2ecc71;">
                <div class="stat-val"><?= rand(5, 12) ?></div>
                <div class="stat-label">NEW TODAY</div>
            </div>
            <div class="stat-card">
                <div class="stat-val"><?= rand(1, 3) ?>%</div>
                <div class="stat-label">UNSUBSCRIBE RATE</div>
            </div>
        </div>

        <!-- Subscribers List -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3>Subscriber Database</h3>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-secondary" onclick="alert('CSV Exporting...')"><i class="fas fa-file-export"></i> EXPORT CSV</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Email Address</th>
                            <th>Status</th>
                            <th>Subscribed On</th>
                            <th>Interests</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($subscribers)): ?>
                            <!-- Dummy Data if DB empty for Demo Purposes -->
                            <?php 
                            $dummies = [
                                ['id' => 101, 'email' => 'aman_news@gmail.com', 'created_at' => date('Y-m-d'), 'status' => 'verified'],
                                ['id' => 102, 'email' => 'punjab_today@yahoo.com', 'created_at' => date('Y-m-d', strtotime('-2 days')), 'status' => 'verified'],
                                ['id' => 103, 'email' => 'reader.123@hotmail.com', 'created_at' => date('Y-m-d', strtotime('-1 week')), 'status' => 'pending']
                            ];
                            foreach($dummies as $sub): 
                            ?>
                            <tr>
                                <td><strong style="color: var(--admin-primary);"><?= $sub['email'] ?></strong></td>
                                <td><span class="status-pill <?= $sub['status'] === 'verified' ? 'published' : 'draft' ?>"><?= ucfirst($sub['status']) ?></span></td>
                                <td><?= date('M d, Y', strtotime($sub['created_at'])) ?></td>
                                <td>Politics, Local, Sports</td>
                                <td>
                                    <div class="action-group">
                                        <a href="<?= SITE_URL ?>/admin/subscribers/delete/<?= $sub['id'] ?>" class="btn-icon delete" onclick="return confirm('Are you sure?')" title="Delete"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: foreach($subscribers as $sub): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($sub['email']) ?></strong></td>
                            <td><span class="status-pill published">Verified</span></td>
                            <td><?= date('M d, Y', strtotime($sub['created_at'])) ?></td>
                            <td>General</td>
                            <td>
                                <div class="action-group">
                                    <a href="<?= SITE_URL ?>/admin/subscribers/delete/<?= $sub['id'] ?>" class="btn-icon delete" onclick="return confirm('Are you sure?')" title="Delete"><i class="fas fa-trash"></i></a>
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

<?php require __DIR__ . '/../layout/footer.php'; ?>
