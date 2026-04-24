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
    $stmt = $db->prepare("INSERT INTO users (id, name, email, password_hash, role) VALUES (1, 'Super Admin', 'admin@khabran.com', :pass, 'super_admin') ON DUPLICATE KEY UPDATE name=name");
    $stmt->execute([':pass' => password_hash('admin123', PASSWORD_DEFAULT)]);
    echo "User created/verified successfully.";
} catch (Exception $e) {
    echo $e->getMessage();
}
