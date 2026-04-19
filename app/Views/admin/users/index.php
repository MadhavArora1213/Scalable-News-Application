<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-user-shield"></i> Administrative Staff Management</h1>
            <div class="header-actions">
                <button class="btn btn-primary"><i class="fas fa-user-plus"></i> ADD NEW STAFF MEMBER</button>
            </div>
        </header>

        <!-- Stats Brief -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 30px;">
            <div class="stat-card" style="padding: 15px; border-left: 4px solid var(--admin-primary);">
                <span style="display:block; font-size: 0.75rem; color: #718096; font-weight: 700;">TOTAL TEAM</span>
                <span style="font-size: 1.5rem; font-weight: 900;"><?= count($users) ?></span>
            </div>
            <div class="stat-card" style="padding: 15px; border-left: 4px solid #48bb78;">
                <span style="display:block; font-size: 0.75rem; color: #718096; font-weight: 700;">ONLINE NOW</span>
                <span style="font-size: 1.5rem; font-weight: 900;">1</span>
            </div>
        </div>

        <!-- Staff Table -->
        <div class="admin-panel-box">
            <div class="box-header">
                <h3>Authorized Personnel</h3>
                <div style="display: flex; gap: 10px;">
                    <div style="position: relative;">
                        <input type="text" placeholder="Search staff..." class="form-control" style="padding-left: 35px; width: 250px; font-size: 0.85rem;">
                        <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 0.8rem; color: #a0aec0;"></i>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name / Profile</th>
                            <th>Contact Email</th>
                            <th>Access Role</th>
                            <th>Last Activity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 35px; height: 35px; background: #edf2f7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #4a5568;">
                                        <?= substr($user['name'], 0, 1) ?>
                                    </div>
                                    <div>
                                        <strong style="display:block;"><?= htmlspecialchars($user['name']) ?></strong>
                                        <span style="font-size: 0.75rem; color: #a0aec0;">ID: #00<?= $user['id'] ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><span style="color: #4a5568;"><?= htmlspecialchars($user['email']) ?></span></td>
                            <td><span class="badge" style="background: <?= $user['role'] == 'Super Admin' ? '#ebf8ff' : '#fef3c7' ?>; color: <?= $user['role'] == 'Super Admin' ? '#2b6cb0' : '#92400e' ?>; padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;"><?= $user['role'] ?></span></td>
                            <td style="font-size: 0.85rem; color: #718096;"><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-icon" title="Edit Permissions"><i class="fas fa-user-edit"></i></button>
                                    <button class="btn-icon delete" title="Suspend User"><i class="fas fa-user-slash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
