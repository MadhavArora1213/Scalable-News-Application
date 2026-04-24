<?php

namespace App\Models;

use Core\Database;
use PDO;

class AnalyticsModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function recordView($articleId) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        $stmt = $this->db->prepare("INSERT INTO page_views (article_id, ip_address, user_agent) VALUES (:article_id, :ip, :ua)");
        return $stmt->execute([
            ':article_id' => $articleId,
            ':ip' => $ip,
            ':ua' => $ua
        ]);
    }

    public function getTrending($limit = 5, $days = 7) {
        $stmt = $this->db->prepare("
            SELECT a.id, a.title, a.slug, a.lang, c.slug as cat_slug, COUNT(v.id) as view_count
            FROM articles a
            JOIN page_views v ON a.id = v.article_id
            LEFT JOIN categories c ON a.category_id = c.id
            WHERE v.viewed_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
            GROUP BY a.id
            ORDER BY view_count DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':days', (int)$days, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalViews() {
        return $this->db->query("SELECT COUNT(*) FROM page_views")->fetchColumn();
    }
}
