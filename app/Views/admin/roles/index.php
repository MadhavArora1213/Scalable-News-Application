<?php require dirname(__DIR__) . '/layout/header.php'; ?>

<div class="admin-content">
    <div class="admin-container">
        <header class="content-header">
            <div class="header-title">
                <h1>Roles & Permissions</h1>
                <p>Manage system access levels and user roles.</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary"><i class="fas fa-plus"></i> Add New Role</button>
            </div>
        </header>

        <div class="admin-panel-box">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Description</th>
                            <th>Permissions Count</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Super Admin</strong></td>
                            <td>Full system access with all permissions.</td>
                            <td>All</td>
                            <td><span class="status-pill published">Active</span></td>
                            <td>
                                <button class="btn btn-icon"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Editor</strong></td>
                            <td>Can manage all articles and categories.</td>
                            <td>12</td>
                            <td><span class="status-pill published">Active</span></td>
                            <td>
                                <button class="btn btn-icon"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Author</strong></td>
                            <td>Can create and manage their own articles.</td>
                            <td>5</td>
                            <td><span class="status-pill published">Active</span></td>
                            <td>
                                <button class="btn btn-icon"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>
