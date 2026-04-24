<?php
require_once __DIR__ . '/../core/Database.php';

$db = \Core\Database::getInstance();
$stmt = $db->query("SELECT a.id, a.title, m.path as image_path FROM articles a LEFT JOIN media m ON a.featured_image = m.id LIMIT 5");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Articles:\n";
print_r($articles);

$stmt = $db->query("SELECT * FROM media LIMIT 5");
$media = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "\nMedia:\n";
print_r($media);
