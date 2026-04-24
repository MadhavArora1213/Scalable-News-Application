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
    
    $defaultAds = [
        ['Global Header Banner', 'header', '<!-- Place AdSense Header code here -->'],
        ['Homepage Sidebar', 'sidebar_home', '<!-- Place Sidebar Ad code here -->'],
        ['Article Top (Above Content)', 'article_top', '<!-- Place Article Top Ad code here -->'],
        ['Article Middle', 'article_middle', '<!-- Place Article Middle Ad code here -->'],
        ['Article Sidebar', 'sidebar_article', '<!-- Place Article Sidebar Ad code here -->'],
        ['Footer Full Width', 'footer', '<!-- Place Footer Ad code here -->'],
    ];

    $stmt = $db->prepare("INSERT INTO ad_zones (name, position, code) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE position=position");
    foreach ($defaultAds as $ad) {
        $stmt->execute($ad);
    }
    
    echo "Ad Zones seeded successfully.";
} catch (Exception $e) {
    echo $e->getMessage();
}
