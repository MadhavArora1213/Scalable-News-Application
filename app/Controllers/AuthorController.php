<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;

class AuthorController extends BaseController {
    public function show($lang, $name) {
        $articleModel = new ArticleModel();
        // Simple search for author name in articles
        $db = \Core\Database::getInstance();
        $articles = $db->prepare("SELECT a.*, c.name_en as category_name 
                                FROM articles a 
                                LEFT JOIN categories c ON a.category_id = c.id
                                WHERE a.author_name = :name AND a.lang = :lang 
                                AND a.status = 'published'
                                ORDER BY a.published_at DESC LIMIT 20")
                     ->execute(['name' => $name, 'lang' => $lang])
                     ->fetchAll();

        $this->render('frontend/author', [
            'articles' => $articles,
            'author_name' => $name,
            'lang' => $lang,
            'title' => 'Articles by ' . htmlspecialchars($name)
        ]);
    }
}
