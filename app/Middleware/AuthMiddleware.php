<?php

namespace App\Middleware;

class AuthMiddleware {
    /**
     * Applied to ALL Admin Routes
     */
    public static function check(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_user'])) {
            // Check remember-me cookie logic would go here
            header('Location: /news/Scalable-News-Application/admin/login');
            exit;
        }

        // Check role permission for this route
        $user = $_SESSION['admin_user'];
        if (!\App\Helpers\PermissionHelper::canAccess($user['role'], $_SERVER['REQUEST_URI'])) {
            http_response_code(403);
            die("403 - Forbidden: Insufficient Permissions");
        }
    }
}
