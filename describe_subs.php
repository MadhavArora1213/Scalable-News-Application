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
    echo "SUBSCRIBERS:\n";
    $stmt = $db->query("DESCRIBE subscribers");
    print_r($stmt->fetchAll());
    
    echo "\nPUSH_SUBSCRIBERS:\n";
    $stmt = $db->query("DESCRIBE push_subscribers");
    print_r($stmt->fetchAll());
} catch (Exception $e) {
    echo $e->getMessage();
}
