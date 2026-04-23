<?php

namespace App\Models;

use Core\Database;
use PDO;

class TagModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->prepare("
            SELECT t.*, c.name_en as category_name, s.name_en as subcategory_name 
            FROM tags t
            LEFT JOIN categories c ON t.category_id = c.id
            LEFT JOIN subcategories s ON t.subcategory_id = s.id
            ORDER BY t.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM tags WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function save(array $data): int {
        $stmt = $this->db->prepare("INSERT INTO tags (name, slug, lang, category_id, subcategory_id) VALUES (:name, :slug, :lang, :category_id, :subcategory_id)");
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE tags SET name = :name, slug = :slug, lang = :lang, category_id = :category_id, subcategory_id = :subcategory_id WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM tags WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
