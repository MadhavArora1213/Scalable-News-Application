<?php
require '../config/app.php';
require '../config/database.php';
require '../core/Database.php';

$db = Core\Database::getInstance();
$stmt = $db->query('SELECT path FROM media LIMIT 5');
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($res);
