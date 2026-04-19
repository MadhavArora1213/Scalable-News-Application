<?php 
$hide_sidebar = true;
$title = '403 Forbidden';
require __DIR__ . '/../admin/layout/header.php'; 
?>

<div class="auth-wrapper">
    <div class="auth-card" style="text-align: center;">
        <div style="font-size: 80px; color: #ef4444; margin-bottom: 20px; opacity: 0.2;">
            <i class="fas fa-lock"></i>
        </div>
        <h1 style="font-size: 32px; margin-bottom: 10px;">Access Denied</h1>
        <p style="margin-bottom: 30px;">You don't have permission to access this page. Please contact your administrator if you think this is a mistake.</p>
        <a href="/news/Scalable-News-Application/admin/dashboard" class="btn btn-primary">
            <i class="fas fa-home"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>
</div>

<?php require __DIR__ . '/../admin/layout/footer.php'; ?>
