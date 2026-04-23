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
        $stmt = $this->db->prepare("INSERT INTO categories (name_pa, name_hi, name_en, slug, sort_order) VALUES (:name_pa, :name_hi, :name_en, :slug, :sort_order)");
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE categories SET name_pa = :name_pa, name_hi = :name_hi, name_en = :name_en, slug = :slug, sort_order = :sort_order WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
