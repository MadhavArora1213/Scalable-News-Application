<?php
require_once __DIR__ . '/../config/database.php';
$config = require __DIR__ . '/../config/database.php';

try {
    $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
    
    $stmt = $pdo->query("DESCRIBE tags");
    $columns = $stmt->fetchAll();
    echo json_encode($columns, JSON_PRETTY_PRINT);
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
