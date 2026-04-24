<?php

namespace App\Models;

use Core\Database;
use PDO;

class AdModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM ad_zones ORDER BY position ASC");
        return $stmt->fetchAll();
    }

    public function getActive() {
        $stmt = $this->db->query("SELECT position, code FROM ad_zones WHERE is_active = 1");
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function update($id, $code, $is_active) {
        $stmt = $this->db->prepare("UPDATE ad_zones SET code = :code, is_active = :is_active WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':code' => $code,
            ':is_active' => $is_active
        ]);
    }

    public function toggle($id) {
        $stmt = $this->db->prepare("UPDATE ad_zones SET is_active = NOT is_active WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function create($name, $position, $code) {
        $stmt = $this->db->prepare("INSERT INTO ad_zones (name, position, code) VALUES (:name, :position, :code)");
        return $stmt->execute([
            ':name' => $name,
            ':position' => $position,
            ':code' => $code
        ]);
    }
}
