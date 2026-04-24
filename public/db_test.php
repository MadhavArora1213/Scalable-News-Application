<?php
require_once __DIR__ . '/../core/Database.php';

try {
    $db = \Core\Database::getInstance();
    $stmt = $db->query("DESCRIBE categories");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "COLUMNS:\n";
    print_r($columns);

    $stmt = $db->query("SELECT * FROM categories");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\nDATA:\n";
    print_r($data);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
