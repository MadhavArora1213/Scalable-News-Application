<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;

class SearchController extends BaseController {
    public function search($lang) {
        $q = $_GET['q'] ?? '';
        $articleModel = new ArticleModel();
        
        $results = [];
        if (!empty($q)) {
            $results = $articleModel->search($q, $lang, 20);
        }

        $this->render('frontend/search', [
            'results' => $results,
            'query' => $q,
            'lang' => $lang,
            'title' => 'Search Results for: ' . htmlspecialchars($q)
        ]);
    }
}
