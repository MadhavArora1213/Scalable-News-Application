<?php
$config = require __DIR__ . '/../config/database.php';

try {
    $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
    
    $sql = "ALTER TABLE tags ADD COLUMN category_id INT DEFAULT NULL AFTER lang,
                            ADD COLUMN subcategory_id INT DEFAULT NULL AFTER category_id";
    $pdo->exec($sql);
    echo "Table tags updated successfully with category_id and subcategory_id.";
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
