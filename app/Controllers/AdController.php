<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class AdController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $this->render('admin/ads/index', [
            'title' => 'Monetization & Ad Management',
            'ads' => [
                'header_ad' => '<!-- Google AdSense Header -->',
                'sidebar_ad' => '<!-- Sidebar Banner -->',
                'bottom_ad' => '<!-- Footer Ad -->'
            ]
        ]);
    }
}
