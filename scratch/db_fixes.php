<?php

require_once __DIR__ . '/../core/Database.php';

// Mocking some config constants just in case they aren't loaded in standalone
if(!defined('DB_HOST')) define('DB_HOST', 'localhost');
if(!defined('DB_NAME')) define('DB_NAME', 'news');
if(!defined('DB_USER')) define('DB_USER', 'root');
if(!defined('DB_PASS')) define('DB_PASS', '');

try {
    $db = \Core\Database::getInstance();
    
    echo "Starting database fixes...\n";

    // 1. Create Subscribers Table
    $db->query("CREATE TABLE IF NOT EXISTS subscribers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        status ENUM('pending', 'verified', 'unsubscribed') DEFAULT 'verified',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    echo "- Table 'subscribers' created/verified.\n";

    // 2. Create Breaking News Table (Ticker)
    $db->query("CREATE TABLE IF NOT EXISTS breaking_news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        text TEXT NOT NULL,
        lang VARCHAR(10) DEFAULT 'pa',
        url VARCHAR(255) DEFAULT '#',
        active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    echo "- Table 'breaking_news' created/verified.\n";

    echo "Database fixes completed successfully!\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
