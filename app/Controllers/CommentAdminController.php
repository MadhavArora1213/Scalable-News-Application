<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class CommentAdminController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $this->render('admin/comments/index', [
            'title' => 'Comments Management',
            'comments' => [] // Placeholder
        ]);
    }
}
