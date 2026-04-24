<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../core/Database.php';

$db = \Core\Database::getInstance();

// 1. Insert new media entries
$stmt = $db->prepare("INSERT INTO media (filename, path) VALUES (?, ?)");
$stmt->execute(['education_hero', 'assets/images/education_hero.png']);
$hero_media_id = $db->lastInsertId();

$stmt->execute(['education_secondary', 'assets/images/education_secondary.png']);
$sec_media_id = $db->lastInsertId();

// 2. Find Education category
$stmt = $db->query("SELECT id FROM categories WHERE slug = 'education' LIMIT 1");
$educationCat = $stmt->fetch(PDO::FETCH_ASSOC);

if ($educationCat) {
    $cat_id = $educationCat['id'];
    
    // 3. Update articles in this category
    // Set the first one as hero
    $stmt = $db->prepare("SELECT id FROM articles WHERE category_id = ? ORDER BY id ASC LIMIT 1");
    $stmt->execute([$cat_id]);
    $firstArt = $stmt->fetch();
    
    if ($firstArt) {
        $db->prepare("UPDATE articles SET featured_image = ? WHERE id = ?")->execute([$hero_media_id, $firstArt['id']]);
        
        // Set others as secondary
        $db->prepare("UPDATE articles SET featured_image = ? WHERE category_id = ? AND id != ?")->execute([$sec_media_id, $cat_id, $firstArt['id']]);
    }
}

echo "Education images updated successfully to local high-quality assets!";
?>
