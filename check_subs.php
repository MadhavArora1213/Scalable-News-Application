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
    $stmt = $db->query("SHOW TABLES LIKE 'subscribers'");
    echo $stmt->fetch() ? "subscribers exists\n" : "subscribers missing\n";
    
    $stmt = $db->query("SHOW TABLES LIKE 'push_subscribers'");
    echo $stmt->fetch() ? "push_subscribers exists\n" : "push_subscribers missing\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
