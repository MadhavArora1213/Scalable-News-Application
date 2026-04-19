<?php
require_once __DIR__ . '/../config/app.php';
$config = require_once __DIR__ . '/../config/database.php';
$dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";

try {
    $pdo = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0; TRUNCATE articles; TRUNCATE categories; TRUNCATE users; TRUNCATE media; SET FOREIGN_KEY_CHECKS = 1;");

    // Media
    $media = [
        ['n' => 'politics', 'p' => SITE_URL.'/public/uploads/2026/04/politics.png'],
        ['n' => 'agri', 'p' => SITE_URL.'/public/uploads/2026/04/agri.png'],
        ['n' => 'culture', 'p' => SITE_URL.'/public/uploads/2026/04/culture.png'],
        ['n' => 'city', 'p' => SITE_URL.'/public/uploads/2026/04/city.png']
    ];
    $mediaIds = [];
    foreach($media as $m) {
        $stmt = $pdo->prepare("INSERT INTO media (filename, path) VALUES (?, ?)");
        $stmt->execute([$m['n'], $m['p']]);
        $mediaIds[$m['n']] = $pdo->lastInsertId();
    }

    // Categories
    $categories = [['slug' => 'punjab', 'pa' => 'ਪੰਜਾਬ', 'hi' => 'पंजाब', 'en' => 'Punjab'], ['slug' => 'politics', 'pa' => 'ਸਿਆਸਤ', 'hi' => 'राजनीति', 'en' => 'Politics']];
    $catIds = [];
    foreach($categories as $c) {
        $stmt = $pdo->prepare("INSERT INTO categories (name_pa, name_hi, name_en, slug) VALUES (?, ?, ?, ?)");
        $stmt->execute([$c['pa'], $c['hi'], $c['en'], $c['slug']]);
        $catIds[$c['slug']] = $pdo->lastInsertId();
    }

    $pdo->exec("INSERT INTO users (name, email, password_hash, role) VALUES ('Editor', 'admin@khabran.in', 'hash', 'super_admin')");
    $adminId = $pdo->lastInsertId();

    // Insertion Prepared Statements
    $sql = "INSERT INTO articles (title, slug, body, author_id, category_id, lang, priority, featured_image, status, published_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'published', NOW())";
    $stmt = $pdo->prepare($sql);

    $langs = ['pa', 'hi', 'en'];
    $heroData = [
        'pa' => ['t' => 'ਪੰਜਾਬ ਬਜਟ 2026: ਸਿੱਖਿਆ ਤੇ ਸਿਹਤ ਲਈ ਵੱਡੇ ਫੰਡ', 's' => 'punjab-budget-2026', 'c' => 'politics', 'i' => 'politics'],
        'hi' => ['t' => 'पंजाब बजट 2026: शिक्षा/स्वास्थ्य पर जोर', 's' => 'punjab-budget-hi', 'c' => 'politics', 'i' => 'politics'],
        'en' => ['t' => 'Punjab Budget 2026: Focus on Health & Edu', 's' => 'punjab-budget-en', 'c' => 'politics', 'i' => 'politics']
    ];

    foreach($langs as $l) {
        // 1. Insert Featured Hero
        $stmt->execute([$heroData[$l]['t'], $heroData[$l]['s'], 'Content...', $adminId, $catIds[$heroData[$l]['c']], $l, 'featured', $mediaIds[$heroData[$l]['i']]]);

        // 2. Insert 3 Grid Items
        for($i=1; $i<=3; $i++) {
            $stmt->execute(["Latest Story $i ($l)", "news-$l-$i", "Body...", $adminId, $catIds['punjab'], $l, 'normal', $mediaIds['city']]);
        }
    }

    echo "TRILINGUAL DATA SEEDED SUCCESSFULLY.";
} catch (Exception $e) { echo "ERROR: " . $e->getMessage(); }
?>
