<?php

namespace App\Models;

use Core\Database;
use PDO;

class BreakingModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM breaking_news ORDER BY sort_order ASC, created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getActive($lang = 'pa') {
        $stmt = $this->db->prepare("SELECT * FROM breaking_news WHERE is_active = 1 AND lang = :lang ORDER BY sort_order ASC, created_at DESC");
        $stmt->execute([':lang' => $lang]);
        return $stmt->fetchAll();
    }

    public function save($data) {
        $stmt = $this->db->prepare("INSERT INTO breaking_news (headline, url, lang, is_active, sort_order) VALUES (:headline, :url, :lang, :is_active, :sort_order)");
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $stmt = $this->db->prepare("UPDATE breaking_news SET $fields WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM breaking_news WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
