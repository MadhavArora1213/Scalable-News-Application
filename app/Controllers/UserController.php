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
        $this->render('admin/users/index', [
            'title' => 'User Management',
            'users' => [
                ['id' => 1, 'name' => 'Super Admin', 'email' => 'admin@khabran.com', 'role' => 'super_admin']
            ]
        ]);
    }
}
