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
    
    $defaultSettings = [
        ['site_name', 'Khabran News', 'general'],
        ['site_tagline', "Punjab's #1 News Portal", 'general'],
        ['site_logo', '', 'general'],
        ['copyright_text', '© 2026 Khabran. All rights reserved.', 'general'],
        
        ['meta_description', 'Latest news from Punjab, India and the World.', 'seo'],
        ['meta_keywords', 'punjab news, breaking news, politics', 'seo'],
        
        ['youtube_url', 'https://youtube.com', 'social'],
        ['facebook_url', 'https://facebook.com', 'social'],
        ['instagram_url', 'https://instagram.com', 'social'],
        ['twitter_url', 'https://twitter.com', 'social'],
        
        ['support_email', 'contact@khabran.com', 'contact'],
        ['office_address', 'Amritsar, Punjab, India', 'contact'],
    ];

    $stmt = $db->prepare("INSERT INTO settings (`key`, `value`, `group`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE value=value");
    foreach ($defaultSettings as $s) {
        $stmt->execute($s);
    }
    
    echo "Settings seeded successfully.";
} catch (Exception $e) {
    echo $e->getMessage();
}
