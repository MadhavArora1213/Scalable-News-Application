<?php 
$hide_sidebar = true;
require __DIR__ . '/../layout/header.php'; 
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="font-size: 40px; color: var(--admin-primary); margin-bottom: 10px;">
                <i class="fas fa-newspaper"></i>
            </div>
            <h1>Welcome Back</h1>
            <p>Admin Control Panel</p>
        </div>

        <?php if (isset($error)): ?>
            <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center;">
                <i class="fas fa-exclamation-circle"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="<?= SITE_URL ?>/admin/login" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="admin@khabran.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" required>
            </div>
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-top: -10px;">
                <label style="display: flex; align-items: center; gap: 8px; font-weight: 400; cursor: pointer;">
                    <input type="checkbox"> Remember me
                </label>
                <a href="#" style="font-size: 14px; color: var(--admin-primary); text-decoration: none;">Forgot?</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 20px;">
                <span>Sign In</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
