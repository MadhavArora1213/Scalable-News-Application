<?php

namespace App\Models;

use Core\Database;
use PDO;

class RedirectModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function find($old_url) {
        $stmt = $this->db->prepare("SELECT new_url FROM redirects WHERE old_url = :old_url LIMIT 1");
        $stmt->execute([':old_url' => $old_url]);
        return $stmt->fetchColumn();
    }

    public function create($old_url, $new_url) {
        // Prevent infinite loops or redundant redirects
        if ($old_url === $new_url) return false;
        
        $stmt = $this->db->prepare("INSERT INTO redirects (old_url, new_url) VALUES (:old_url, :new_url) ON DUPLICATE KEY UPDATE new_url = :new_url");
        return $stmt->execute([':old_url' => $old_url, ':new_url' => $new_url]);
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM redirects ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM redirects WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
