<?php 
require __DIR__ . '/../layout/header.php'; 
?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <h1><i class="fas fa-users-cog"></i> System Users & Permissions</h1>
            <div class="header-actions">
                <button class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW USER</button>
            </div>
        </header>

        <div class="admin-panel-box">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>User Role</th>
                            <th>Account Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($users)): ?>
                            <tr><td colspan="6" style="text-align:center; padding: 20px;">No users found.</td></tr>
                        <?php else: foreach($users as $user): ?>
                        <tr>
                            <td style="width: 60px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--admin-primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 900;">
                                    <?= substr($user['name'], 0, 1) ?>
                                </div>
                            </td>
                            <td><strong><?= htmlspecialchars($user['name']) ?></strong></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><span class="badge"><?= ucfirst(str_replace('_', ' ', $user['role'])) ?></span></td>
                            <td><span class="status-pill published">Active</span></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-icon" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon delete" title="Suspend"><i class="fas fa-user-slash"></i></button>
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
