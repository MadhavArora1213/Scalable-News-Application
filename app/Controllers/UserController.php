<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class UserController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $db = \Core\Database::getInstance();
        
        // Fetch all staff users
        $users = $db->query("SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC")->fetchAll();

        // Fallback for demo
        if(empty($users)) {
            $users = [
                ['id' => 1, 'name' => 'Super Admin', 'email' => 'admin@khabran.com', 'role' => 'Super Admin', 'created_at' => date('Y-m-d H:i:s')],
                ['id' => 2, 'name' => 'Editor Aman', 'email' => 'aman@khabran.com', 'role' => 'Editor', 'created_at' => date('Y-m-d H:i:s')]
            ];
        }

        $this->render('admin/users/index', [
            'title' => 'Administrative Staff & Users',
            'users' => $users
        ]);
    }
}
