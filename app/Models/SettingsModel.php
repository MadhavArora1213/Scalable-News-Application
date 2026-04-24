<?php

namespace App\Models;

use Core\Database;
use PDO;

class SettingsModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM settings");
        $stmt->execute();
        $settings = $stmt->fetchAll();
        
        $organized = [];
        foreach ($settings as $s) {
            $organized[$s['group']][$s['key']] = $s['value'];
        }
        return $organized;
    }

    public function getByGroup($group) {
        $stmt = $this->db->prepare("SELECT * FROM settings WHERE `group` = :group");
        $stmt->execute([':group' => $group]);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function update($key, $value) {
        $stmt = $this->db->prepare("UPDATE settings SET value = :value WHERE `key` = :key");
        return $stmt->execute([':value' => $value, ':key' => $key]);
    }

    public function updateMultiple($data) {
        $stmt = $this->db->prepare("UPDATE settings SET value = :value WHERE `key` = :key");
        foreach ($data as $key => $value) {
            $stmt->execute([':value' => $value, ':key' => $key]);
        }
        return true;
    }
}
