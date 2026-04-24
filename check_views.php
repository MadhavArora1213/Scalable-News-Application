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
    $stmt = $db->query("SHOW TABLES LIKE 'page_views'");
    if ($stmt->fetch()) {
        $stmt = $db->query("DESCRIBE page_views");
        print_r($stmt->fetchAll());
    } else {
        echo "missing";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
