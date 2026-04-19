<?php
require_once __DIR__ . '/../config/app.php';
$config = require_once __DIR__ . '/../config/database.php';
$dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";

try {
    $pdo = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
    
    // Get existing IDs
    $adminId = $pdo->query("SELECT id FROM users LIMIT 1")->fetchColumn();
    $punjabCat = $pdo->query("SELECT id FROM categories WHERE slug='punjab'")->fetchColumn();
    $bizCat = $pdo->query("SELECT id FROM categories WHERE slug='business'")->fetchColumn();
    $imgId = $pdo->query("SELECT id FROM media LIMIT 1")->fetchColumn();

    $stmt = $pdo->prepare("INSERT INTO articles (title, slug, body, author_id, category_id, lang, priority, featured_image, status, published_at) VALUES (?, ?, ?, ?, ?, ?, 'normal', ?, 'published', NOW())");

    $langs = ['pa', 'hi', 'en'];
    $newsList = [
        ['t' => 'Sensex crosses 75,000 mark for the first time in history', 's' => 'sensex-record-high'],
        ['t' => 'Punjab Police crack major smuggling ring in Tarn Taran', 's' => 'punjab-police-tarn-taran-bust'],
        ['t' => 'New textile park to generate 50,000 jobs in Ludhiana', 's' => 'ludhiana-textile-jobs'],
        ['t' => 'Gold prices skyrocket amid global uncertainty', 's' => 'gold-prices-record'],
        ['t' => 'Digital Rupee usage expands to 10 more cities in India', 's' => 'digital-rupee-expansion'],
        ['t' => 'Water levels in Bhakra Dam reach optimal levels for summer', 's' => 'bhakra-dam-levels-2026'],
        ['t' => 'Startup ecosystem in Chandigarh sees 40% growth in investments', 's' => 'chandigarh-startup-growth'],
        ['t' => 'Traditional Punjabi craft "Phulkari" gains international GI tag', 's' => 'phulkari-international-recognition']
    ];

    foreach($langs as $l) {
        foreach($newsList as $idx => $news) {
            $title = $news['t'] . " ($l)";
            $slug = $news['s'] . "-$l-" . uniqid();
            $stmt->execute([$title, $slug, 'Automatic news digest from Times of India sources...', $adminId, ($idx % 2 == 0 ? $bizCat : $punjabCat), $l, $imgId]);
        }
    }

    echo "DATABASE SEEDED WITH 24+ ARTICLES FOR INFINITE SCROLL.";
} catch (Exception $e) { die($e->getMessage()); }
?>
