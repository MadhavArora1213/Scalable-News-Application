<?php

namespace App\Models;

use Core\Database;
use PDO;

class SubcategoryModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            "SELECT s.*, c.name_en AS parent_name 
             FROM subcategories s 
             JOIN categories c ON s.category_id = c.id 
             ORDER BY c.name_en, s.sort_order ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM subcategories WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function save(array $data): int {
        $stmt = $this->db->prepare(
            "INSERT INTO subcategories (category_id, name_en, name_pa, name_hi, slug, sort_order) 
             VALUES (:category_id, :name_en, :name_pa, :name_hi, :slug, :sort_order)"
        );
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE subcategories 
             SET category_id = :category_id, name_en = :name_en, name_pa = :name_pa, 
                 name_hi = :name_hi, slug = :slug, sort_order = :sort_order 
             WHERE id = :id"
        );
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM subcategories WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
