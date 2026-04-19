<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;
use Core\LanguageHelper;

class CategoryController extends BaseController {
    /**
     * Show articles for a specific category
     */
    public function index(string $lang, string $category) {
        $articleModel = new ArticleModel();
        
        // 1. Get Category Articles
        $articles = $articleModel->getLatestByCategory($category, $lang, 12, 0);
        
        if (empty($articles)) {
            // Handle empty category or invalid slug
            $this->render('frontend/category', [
                'articles' => [],
                'category_name' => ucfirst($category),
                'lang' => $lang,
                'title' => ucfirst($category) . ' - The Khabran'
            ]);
            return;
        }

        $categoryName = $articles[0]['category_name'];

        // Render the view
        $this->render('frontend/category', [
            'articles' => $articles,
            'category_name' => $categoryName,
            'lang' => $lang,
            'title' => $categoryName . ' - The Khabran'
        ]);
    }
}
