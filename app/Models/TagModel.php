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
        $stmt = $this->db->prepare("SELECT * FROM tags ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM tags WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function save(array $data): int {
        $stmt = $this->db->prepare("INSERT INTO tags (name, slug, lang) VALUES (:name, :slug, :lang)");
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE tags SET name = :name, slug = :slug, lang = :lang WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM tags WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
