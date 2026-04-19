<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class BreakingController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $db = \Core\Database::getInstance();

        // Auto-fix for missing table / columns
        $db->query("CREATE TABLE IF NOT EXISTS breaking_news (
            id INT AUTO_INCREMENT PRIMARY KEY,
            text TEXT NOT NULL,
            lang VARCHAR(10) DEFAULT 'pa',
            url VARCHAR(255) DEFAULT '#',
            active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        // Check for missing columns (Safety for existing legacy tables)
        $columns = [
            'active' => "ALTER TABLE breaking_news ADD COLUMN active TINYINT(1) DEFAULT 1 AFTER url",
            'created_at' => "ALTER TABLE breaking_news ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
        ];

        foreach ($columns as $col => $sql) {
            try {
                $db->query("SELECT $col FROM breaking_news LIMIT 1");
            } catch (\Exception $e) {
                $db->query($sql);
            }
        }

        // Fetch items
        $items = $db->query("SELECT * FROM breaking_news WHERE active = 1 ORDER BY created_at DESC")->fetchAll();

        $this->render('admin/breaking/index', [
            'title' => 'Breaking News Ticker',
            'items' => $items
        ]);
    }
}
