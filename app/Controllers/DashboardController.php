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
        
        // Fetch Real-time Stats
        $article_count = $db->query("SELECT COUNT(*) FROM articles")->fetchColumn();
        $cat_count = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
        $sub_count = $db->query("SELECT COUNT(*) FROM subscribers")->fetchColumn();
        $pending = $db->query("SELECT COUNT(*) FROM articles WHERE status = 'draft'")->fetchColumn();
        
        // 1. Fetch Latest Content (Real activity)
        $latest_articles = $db->query("
            SELECT a.title, a.status, a.created_at, u.name as author 
            FROM articles a 
            LEFT JOIN users u ON a.author_id = u.id 
            ORDER BY a.created_at DESC LIMIT 5
        ")->fetchAll();

        // 2. Fetch Latest Subscribers (Real activity)
        $latest_subs = $db->query("SELECT email, created_at FROM subscribers ORDER BY created_at DESC LIMIT 3")->fetchAll();

        // 3. Unified Activity Stream (Combined for UI)
        $activities = [];
        foreach($latest_articles as $art) {
            $activities[] = [
                'type' => 'content',
                'title' => $art['title'],
                'user' => $art['author'] ?? 'Admin',
                'time' => $art['created_at'],
                'icon' => 'fas fa-edit',
                'color' => '#3182ce'
            ];
        }
        foreach($latest_subs as $sub) {
            $activities[] = [
                'type' => 'subscriber',
                'title' => 'New subscriber: ' . $sub['email'],
                'user' => 'System',
                'time' => $sub['created_at'],
                'icon' => 'fas fa-user-plus',
                'color' => '#38a169'
            ];
        }
        
        // Sort activity by time
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        $this->render('admin/dashboard/index', [
            'title' => 'Admin Dashboard | Khabran News',
            'stats' => [
                'articles' => $article_count,
                'categories' => $cat_count,
                'subscribers' => $sub_count,
                'pending' => $pending
            ],
            'latest_articles' => $latest_articles,
            'recent_activity' => array_slice($activities, 0, 8)
        ]);
    }
}
