<?php

namespace App\Models;

use Core\Database;
use PDO;

class CategoryModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY sort_order ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }
    
    public function save(array $data): int {
        $stmt = $this->db->prepare("INSERT INTO categories (name_pa, name_hi, name_en, slug, parent_id, sort_order) VALUES (:name_pa, :name_hi, :name_en, :slug, :parent_id, :sort_order)");
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }
}
