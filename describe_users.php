<?php
require_once __DIR__ . '/config/app.php';
spl_autoload_register(function ($class) {
    $root = __DIR__;
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
});

use Core\Database;

try {
    $db = Database::getInstance();
    $stmt = $db->query("DESCRIBE users");
    $columns = $stmt->fetchAll();
    echo json_encode($columns);
} catch (Exception $e) {
    echo $e->getMessage();
}
