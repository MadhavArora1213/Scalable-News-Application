<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class AnalyticsController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $this->render('admin/analytics/index', [
            'title' => 'Traffic & Audience Analytics'
        ]);
    }
}
