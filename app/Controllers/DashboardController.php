<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class DashboardController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $db = \Core\Database::getInstance();
        
        // Fetch Stats
        $article_count = $db->query("SELECT COUNT(*) FROM articles")->fetchColumn();
        $cat_count = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
        $user_count = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $pending = $db->query("SELECT COUNT(*) FROM articles WHERE status = 'draft'")->fetchColumn();
        
        // Latest Articles
        $latest_articles = $db->query("
            SELECT a.title, a.status, a.published_at, u.name as author 
            FROM articles a 
            LEFT JOIN users u ON a.author_id = u.id 
            ORDER BY a.created_at DESC LIMIT 5
        ")->fetchAll();

        $this->render('admin/dashboard/index', [
            'title' => 'Dashboard - Khabran News',
            'stats' => [
                'articles' => $article_count,
                'categories' => $cat_count,
                'users' => $user_count,
                'pending' => $pending
            ],
            'latest_articles' => $latest_articles
        ]);
    }
}
