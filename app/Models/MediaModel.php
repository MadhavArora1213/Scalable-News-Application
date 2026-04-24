<?php

namespace App\Models;

use Core\Database;
use PDO;

class MediaModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($type = 'image') {
        $stmt = $this->db->prepare("SELECT * FROM media WHERE type = :type ORDER BY created_at DESC");
        $stmt->execute([':type' => $type]);
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM media WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function save($data) {
        $stmt = $this->db->prepare("
            INSERT INTO media (filename, path, alt_text, credit, type, size) 
            VALUES (:filename, :path, :alt_text, :credit, :type, :size)
        ");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE media SET 
                alt_text = :alt_text, 
                credit = :credit 
            WHERE id = :id
        ");
        return $stmt->execute([
            ':id' => $id,
            ':alt_text' => $data['alt_text'],
            ':credit' => $data['credit']
        ]);
    }

    public function delete($id) {
        $media = $this->find($id);
        if ($media) {
            $fullPath = dirname(dirname(__DIR__)) . '/public' . $media['path'];
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            $stmt = $this->db->prepare("DELETE FROM media WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        }
        return false;
    }
}
