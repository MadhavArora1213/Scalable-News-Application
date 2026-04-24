<?php

namespace App\Models;

use Core\Database;
use PDO;

class ArticleModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Get latest published articles by language
     */
    public function getLatest(string $lang, int $limit = 10, int $offset = 0): array {
        $stmt = $this->db->prepare(
            "SELECT a.*, u.name AS author_name, c.name_{$lang} AS category_name,
                    m.path AS image_path
             FROM articles a
             LEFT JOIN users u ON a.author_id = u.id
             LEFT JOIN categories c ON a.category_id = c.id
             LEFT JOIN media m ON a.featured_image = m.id
             WHERE a.status = 'published' AND a.lang = :lang
             ORDER BY a.published_at DESC LIMIT :limit OFFSET :offset"
        );

        // PDO requires integers for LIMIT/OFFSET if we don't use string interpolation carefully
        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get latest published articles by category and language
     */
    public function getLatestByCategory(string $categorySlug, string $lang, int $limit = 10, int $offset = 0): array {
        $stmt = $this->db->prepare(
            "SELECT a.*, u.name AS author_name, c.name_{$lang} AS category_name,
                    m.path AS image_path
             FROM articles a
             LEFT JOIN users u ON a.author_id = u.id
             LEFT JOIN categories c ON a.category_id = c.id
             LEFT JOIN media m ON a.featured_image = m.id
             WHERE a.status = 'published' AND a.lang = :lang AND c.slug = :category
             ORDER BY a.published_at DESC LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':category', $categorySlug, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Find article by slug and language
     */
    public function findBySlug(string $slug, string $lang): ?array {
        $stmt = $this->db->prepare(
            "SELECT a.*, u.name AS author_name, c.name_{$lang} AS category_name, c.slug AS category_slug, m.path AS image_path
             FROM articles a 
             LEFT JOIN users u ON a.author_id = u.id
             LEFT JOIN categories c ON a.category_id = c.id
             LEFT JOIN media m ON a.featured_image = m.id
             WHERE a.slug = :slug AND a.lang = :lang AND a.status = 'published'"
        );
        $stmt->execute([':slug' => $slug, ':lang' => $lang]);
        return $stmt->fetch() ?: null;
    }
    /**
     * Increment view count asynchronously
     */
    public function incrementViews(int $id): void {
        $stmt = $this->db->prepare("UPDATE articles SET view_count = view_count + 1 WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    /**
     * Get related articles by category
     */
    public function getRelated(int $articleId, int $categoryId, int $limit = 3): array {
        $stmt = $this->db->prepare(
            "SELECT a.id, a.title, a.slug, c.slug AS category_slug, m.path AS image_path
             FROM articles a
             JOIN categories c ON a.category_id = c.id
             LEFT JOIN media m ON a.featured_image = m.id
             WHERE a.category_id = :category_id AND a.id != :id AND a.status = 'published'
             ORDER BY a.published_at DESC LIMIT :limit"
        );
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':id', $articleId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Search articles by title/body with full card data
     */
    public function search(string $query, string $lang, int $limit = 12): array {
        $stmt = $this->db->prepare(
            "SELECT a.*, c.name_{$lang} AS category_name, c.slug AS category_slug, m.path AS image_path
             FROM articles a
             LEFT JOIN categories c ON a.category_id = c.id
             LEFT JOIN media m ON a.featured_image = m.id
             WHERE (a.title LIKE :q1 OR a.body LIKE :q2) AND a.lang = :lang AND a.status = 'published'
             ORDER BY a.published_at DESC LIMIT :limit"
        );
        $val = "%$query%";
        $stmt->bindValue(':q1', $val, PDO::PARAM_STR);
        $stmt->bindValue(':q2', $val, PDO::PARAM_STR);
        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    /**
     * Get recent articles for Google News Sitemap (Last X hours)
     */
    public function getRecentForSitemap(int $hours = 48): array {
        $stmt = $this->db->prepare(
            "SELECT a.title, a.slug, a.published_at, a.lang, c.slug AS category_slug 
             FROM articles a
             LEFT JOIN categories c ON a.category_id = c.id
             WHERE a.status = 'published' AND a.published_at >= DATE_SUB(NOW(), INTERVAL :hours HOUR)
             ORDER BY a.published_at DESC"
        );
        $stmt->bindValue(':hours', $hours, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    /**
     * Get featured articles (prioritized by status and type)
     */
    public function getFeatured(string $lang, int $limit = 1): array {
        $stmt = $this->db->prepare(
            "SELECT a.*, u.name AS author_name, c.name_{$lang} AS category_name, m.path AS image_path
             FROM articles a
             LEFT JOIN users u ON a.author_id = u.id
             LEFT JOIN categories c ON a.category_id = c.id
             LEFT JOIN media m ON a.featured_image = m.id
             WHERE a.status = 'published' AND a.lang = :lang AND a.priority IN ('featured', 'top')
             ORDER BY a.published_at DESC LIMIT :limit"
        );
        $stmt->execute([':lang' => $lang, ':limit' => $limit]);
        return $stmt->fetchAll();
    }
    /**
     * Save a new article
     */
    public function save(array $data): int {
        $stmt = $this->db->prepare(
            "INSERT INTO articles (title, slug, body, excerpt, author_id, category_id, lang, status, priority, featured_image, seo_title, meta_desc, published_at) 
             VALUES (:title, :slug, :body, :excerpt, :author_id, :category_id, :lang, :status, :priority, :featured_image, :seo_title, :meta_desc, :published_at)"
        );
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }

    /**
     * Update an existing article
     */
    public function update(int $id, array $data): bool {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");

        $stmt = $this->db->prepare("UPDATE articles SET $fields WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /**
     * Delete an article
     */
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
