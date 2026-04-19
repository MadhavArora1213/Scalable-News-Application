<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class SeoAdminController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $this->render('admin/seo/index', [
            'title' => 'SEO Management',
            'stats' => [
                'indexed_pages' => rand(120, 150),
                'google_rank' => '4.2',
                'sitemap_status' => 'Healthy',
                'meta_errors' => 0
            ]
        ]);
    }

    public function update() {
        // Save robots.txt if provided
        if (isset($_POST['robots_content'])) {
            file_put_contents(PUBLIC_PATH . '/robots.txt', $_POST['robots_content']);
        }

        // Handle other SEO setting updates (e.g., to a DB or config file)
        header('Location: ' . SITE_URL . '/admin/seo?msg=Updated');
        exit;
    }
}
