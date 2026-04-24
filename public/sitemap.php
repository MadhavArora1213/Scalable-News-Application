<?php
// public/sitemap.php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../core/Database.php';

header("Content-Type: text/xml;charset=utf-8");

$db = \Core\Database::getInstance();

$type = $_GET['type'] ?? 'index'; // pa, hi, en, news, index

if ($type === 'index') {
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
    $langs = ['pa', 'hi', 'en', 'news'];
    foreach ($langs as $l) {
        echo '  <sitemap>' . "\n";
        echo '    <loc>' . SITE_URL . '/sitemap-' . $l . '.xml</loc>' . "\n";
        echo '    <lastmod>' . date('c') . '</lastmod>' . "\n";
        echo '  </sitemap>' . "\n";
    }
    
    echo '</sitemapindex>';
    exit;
}

if ($type === 'news') {
    // Google News Sitemap - only articles from last 48 hours
    $stmt = $db->query("SELECT a.title, a.slug, a.lang, a.published_at, c.name_en, c.slug as category_slug 
                        FROM articles a 
                        LEFT JOIN categories c ON a.category_id = c.id 
                        WHERE a.status = 'published' AND a.published_at >= DATE_SUB(NOW(), INTERVAL 48 HOUR) 
                        ORDER BY a.published_at DESC LIMIT 1000");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";

    foreach ($articles as $article) {
        echo '  <url>' . "\n";
        echo '    <loc>' . SITE_URL . '/' . $article['lang'] . '/' . ($article['category_slug'] ?? 'news') . '/' . $article['slug'] . '</loc>' . "\n";
        echo '    <news:news>' . "\n";
        echo '      <news:publication>' . "\n";
        echo '        <news:name>Khabran News</news:name>' . "\n";
        echo '        <news:language>' . $article['lang'] . '</news:language>' . "\n";
        echo '      </news:publication>' . "\n";
        echo '      <news:publication_date>' . date('c', strtotime($article['published_at'])) . '</news:publication_date>' . "\n";
        echo '      <news:title>' . htmlspecialchars($article['title']) . '</news:title>' . "\n";
        echo '    </news:news>' . "\n";
        echo '  </url>' . "\n";
    }

    echo '</urlset>';
    exit;
}

// Standard sitemaps for pa, hi, en
if (in_array($type, ['pa', 'hi', 'en'])) {
    $stmt = $db->prepare("SELECT a.slug, a.published_at, c.slug as category_slug 
                          FROM articles a 
                          LEFT JOIN categories c ON a.category_id = c.id 
                          WHERE a.status = 'published' AND a.lang = ? 
                          ORDER BY a.published_at DESC");
    $stmt->execute([$type]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Add homepage
    echo '  <url>' . "\n";
    echo '    <loc>' . SITE_URL . '/' . $type . '</loc>' . "\n";
    echo '    <changefreq>hourly</changefreq>' . "\n";
    echo '    <priority>1.0</priority>' . "\n";
    echo '  </url>' . "\n";

    foreach ($articles as $article) {
        echo '  <url>' . "\n";
        echo '    <loc>' . SITE_URL . '/' . $type . '/' . ($article['category_slug'] ?? 'news') . '/' . $article['slug'] . '</loc>' . "\n";
        echo '    <lastmod>' . date('c', strtotime($article['published_at'])) . '</lastmod>' . "\n";
        echo '    <changefreq>daily</changefreq>' . "\n";
        echo '    <priority>0.8</priority>' . "\n";
        echo '  </url>' . "\n";
    }

    echo '</urlset>';
    exit;
}

http_response_code(404);
echo "Sitemap not found.";
?>
