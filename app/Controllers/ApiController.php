<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use Core\LanguageHelper;

class ApiController {
    /**
     * Get articles list in JSON for Infinite Scroll
     */
    public function articles() {
        header('Content-Type: application/json');
        
        $lang = $_GET['lang'] ?? 'pa';
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $limit = 6;

        $model = new ArticleModel();
        $articles = $model->getLatest($lang, $limit, $offset);

        // Format dates and ensure absolute URLs for images
        foreach($articles as &$a) {
            $a['date_formatted'] = date('M d, Y', strtotime($a['published_at']));
            $a['url'] = SITE_URL . '/' . $lang . '/' . ($a['category_name'] ?? 'news') . '/' . $a['slug'];
            if ($a['image_path']) {
                $a['image_path'] = SITE_URL . '/' . $a['image_path'];
            }
        }

        echo json_encode([
            'status' => 'success',
            'data' => $articles,
            'count' => count($articles),
            'next_offset' => $offset + $limit
        ]);
    }
}
