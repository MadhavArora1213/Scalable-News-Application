<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class SubscriberController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    private function initDB() {
        $db = \Core\Database::getInstance();
        $db->query("CREATE TABLE IF NOT EXISTS subscribers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            status ENUM('pending', 'verified', 'unsubscribed') DEFAULT 'verified',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        return $db;
    }

    public function index() {
        $db = $this->initDB();
        $subscribers = $db->query("SELECT * FROM subscribers ORDER BY created_at DESC")->fetchAll();

        $this->render('admin/subscribers/index', [
            'title' => 'Newsletter Subscribers',
            'subscribers' => $subscribers
        ]);
    }

    public function delete($id) {
        $db = $this->initDB();
        $db->prepare("DELETE FROM subscribers WHERE id = :id")->execute(['id' => $id]);
        
        header('Location: ' . SITE_URL . '/admin/subscribers?msg=Deleted');
        exit;
    }

    public function broadcast() {
        // Mock broadcasting
        header('Location: ' . SITE_URL . '/admin/subscribers?msg=BroadcastSent');
        exit;
    }
}
