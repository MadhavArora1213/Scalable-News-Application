<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Database.php';

use Core\Database;

$db = Database::getInstance();
$categories = $db->query("SELECT id, slug, name_en, name_hi, name_pa FROM categories")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($categories);
?>
