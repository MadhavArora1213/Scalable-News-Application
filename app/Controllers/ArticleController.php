<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;

class ArticleController extends BaseController {
    /**
     * Show a single article
     */
    public function show(string $lang, string $category, string $slug): void {
        if (!in_array($lang, ['pa', 'hi', 'en'])) {
            http_response_code(404);
            die("404 - Invalid Language");
        }

        $model = new ArticleModel();
        
        // Find the article
        $article = $model->findBySlug($slug, $lang);
        
        if (!$article) {
            http_response_code(404);
            require __DIR__ . '/../Views/errors/404.php';
            return;
        }

        // Fetch related articles
        $related = $model->getRelated($article['id'], $article['category_id'], 3);
        
        // Placeholder for comments (CommentModel needs to be created next)
        $comments = []; 

        // Increment view count & Record Analytics
        $model->incrementViews($article['id']);
        $analyticsModel = new \App\Models\AnalyticsModel();
        $analyticsModel->recordView($article['id']);

        // Language translations (Mockup for now)
        $translations = [
            ['lang' => 'pa', 'url' => "/pa/{$category}/{$slug}"],
            ['lang' => 'hi', 'url' => "/hi/{$category}/{$slug}"],
            ['lang' => 'en', 'url' => "/en/{$category}/{$slug}"],
        ];

        // Render the view
        $this->render('frontend/article', [
            'article' => $article,
            'related' => $related,
            'comments' => $comments,
            'translations' => $translations,
            'lang' => $lang
        ]);
    }
}
