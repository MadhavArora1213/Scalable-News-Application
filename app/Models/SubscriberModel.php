<?php

namespace App\Models;

use Core\Database;
use PDO;

class SubscriberModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM subscribers ORDER BY subscribed_at DESC");
        return $stmt->fetchAll();
    }

    public function getPushCount() {
        return $this->db->query("SELECT COUNT(*) FROM push_subscribers")->fetchColumn();
    }

    public function getEmailCount() {
        return $this->db->query("SELECT COUNT(*) FROM subscribers WHERE status = 'verified'")->fetchColumn();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM subscribers WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function add($email, $name = '', $lang = 'en') {
        $stmt = $this->db->prepare("INSERT INTO subscribers (email, name, lang_pref) VALUES (:email, :name, :lang) ON DUPLICATE KEY UPDATE name = :name, lang_pref = :lang");
        return $stmt->execute([
            ':email' => $email,
            ':name' => $name,
            ':lang' => $lang
        ]);
    }
}
