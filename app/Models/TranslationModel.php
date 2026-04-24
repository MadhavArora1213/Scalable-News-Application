<?php

namespace App\Models;

use Core\Database;
use PDO;

class TranslationModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getLinks($articleId) {
        $stmt = $this->db->prepare("
            SELECT * FROM article_translations 
            WHERE pa_id = :id OR hi_id = :id OR en_id = :id 
            LIMIT 1
        ");
        $stmt->execute([':id' => $articleId]);
        return $stmt->fetch();
    }

    public function linkArticles($paId, $hiId, $enId) {
        // Find if any of these are already in a translation group
        $groupId = null;
        $ids = array_filter([$paId, $hiId, $enId]);
        
        if (empty($ids)) return false;

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT id FROM article_translations WHERE pa_id IN ($placeholders) OR hi_id IN ($placeholders) OR en_id IN ($placeholders) LIMIT 1");
        $stmt->execute(array_merge($ids, $ids));
        $existing = $stmt->fetch();

        if ($existing) {
            $stmt = $this->db->prepare("UPDATE article_translations SET pa_id = :pa, hi_id = :hi, en_id = :en WHERE id = :id");
            return $stmt->execute([':pa' => $paId, ':hi' => $hiId, ':en' => $en, ':id' => $existing['id']]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO article_translations (original_id, pa_id, hi_id, en_id) VALUES (:original, :pa, :hi, :en)");
            return $stmt->execute([':original' => $ids[0], ':pa' => $paId, ':hi' => $hiId, ':en' => $enId]);
        }
    }

    public function getTranslatedUrls($articleId) {
        $links = $this->getLinks($articleId);
        if (!$links) return [];

        $ids = [
            'pa' => $links['pa_id'],
            'hi' => $links['hi_id'],
            'en' => $links['en_id']
        ];

        $results = [];
        foreach ($ids as $lang => $id) {
            if ($id) {
                $stmt = $this->db->prepare("
                    SELECT a.slug, c.slug as cat_slug 
                    FROM articles a 
                    LEFT JOIN categories c ON a.category_id = c.id 
                    WHERE a.id = :id
                ");
                $stmt->execute([':id' => $id]);
                $article = $stmt->fetch();
                if ($article) {
                    $results[$lang] = "/{$lang}/{$article['cat_slug']}/{$article['slug']}";
                }
            }
        }
        return $results;
    }
}
