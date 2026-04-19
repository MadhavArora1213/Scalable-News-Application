<?php

namespace Core;

use PDO;
use Exception;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (!self::$instance) {
            try {
                $cfg = require __DIR__ . '/../config/database.php';
                $dsn = "mysql:host={$cfg['host']};dbname={$cfg['db']};charset=utf8mb4";
                
                self::$instance = new PDO(
                    $dsn,
                    $cfg['user'],
                    $cfg['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (Exception $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    // Prevent cloning and instantiation
    private function __construct() {}
    private function __clone() {}
}
