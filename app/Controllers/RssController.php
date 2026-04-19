<?php

namespace App\Controllers;

use Core\BaseController;

class RssController extends BaseController {
    public function feed($lang) {
        $db = \Core\Database::getInstance();
        $articles = $db->prepare("SELECT * FROM articles WHERE lang = :lang AND status = 'published' ORDER BY published_at DESC LIMIT 20")
                     ->execute(['lang' => $lang])
                     ->fetchAll();

        header("Content-Type: application/rss+xml; charset=utf-8");
        
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<rss version="2.0">';
        echo '<channel>';
        echo '<title>Khabran News - ' . strtoupper($lang) . '</title>';
        echo '<link>' . SITE_URL . '/' . $lang . '</link>';
        echo '<description>Latest news from Punjab, India and the World.</description>';

        foreach ($articles as $article) {
            echo '<item>';
            echo '<title>' . htmlspecialchars($article['title']) . '</title>';
            echo '<link>' . SITE_URL . '/' . $lang . '/news/' . $article['slug'] . '</link>';
            echo '<pubDate>' . date(DATE_RSS, strtotime($article['published_at'])) . '</pubDate>';
            echo '<description>' . htmlspecialchars($article['excerpt']) . '</description>';
            echo '</item>';
        }

        echo '</channel>';
        echo '</rss>';
        exit;
    }
}
