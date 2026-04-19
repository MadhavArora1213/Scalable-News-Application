<?php

namespace App\Controllers;

use Core\BaseController;

class AuthController extends BaseController {
    public function loginForm() {
        $this->render('admin/auth/login', [
            'title' => 'Admin Login - Khabran News'
        ]);
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Placeholder for real auth logic
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            // Simple hardcoded auth for now (should use DB)
            if ($email === 'admin@khabran.com' && $password === 'admin123') {
                $_SESSION['admin_user'] = [
                    'id' => 1,
                    'name' => 'Super Admin',
                    'email' => $email,
                    'role' => 'super_admin'
                ];
                header('Location: /news/Scalable-News-Application/admin/dashboard');
                exit;
            } else {
                $this->render('admin/auth/login', [
                    'title' => 'Admin Login - Khabran News',
                    'error' => 'Invalid credentials'
                ]);
            }
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: /news/Scalable-News-Application/admin/login');
        exit;
    }
}
