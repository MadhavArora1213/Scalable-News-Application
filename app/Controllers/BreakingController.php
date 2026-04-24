<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\BreakingModel;
use App\Models\ArticleModel;

class BreakingController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new BreakingModel();
        $articleModel = new ArticleModel();
        
        // Fetch latest articles for the "Select Article" option
        $stmt = \Core\Database::getInstance()->prepare("SELECT id, title, lang FROM articles ORDER BY created_at DESC LIMIT 20");
        $stmt->execute();
        $recentArticles = $stmt->fetchAll();

        $this->render('admin/breaking/index', [
            'title' => 'Breaking News Ticker Manager',
            'items' => $model->getAll(),
            'recentArticles' => $recentArticles
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new BreakingModel();
            
            $data = [
                ':headline' => $_POST['headline'] ?? '',
                ':url' => $_POST['url'] ?? '#',
                ':lang' => $_POST['lang'] ?? 'pa',
                ':is_active' => 1,
                ':sort_order' => 0
            ];

            $model->save($data);
            header('Location: ' . SITE_URL . '/admin/breaking');
            exit;
        }
    }

    public function promote() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['article_id'] ?? null;
            if ($id) {
                return $this->addFromArticle($id);
            }
        }
        header('Location: ' . SITE_URL . '/admin/breaking');
        exit;
    }

    public function addFromArticle($id) {
        $articleModel = new ArticleModel();
        $stmt = \Core\Database::getInstance()->prepare("SELECT title, slug, lang FROM articles WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch();

        if ($article) {
            $model = new BreakingModel();
            $data = [
                ':headline' => $article['title'],
                ':url' => '/article/' . $article['slug'],
                ':lang' => $article['lang'],
                ':is_active' => 1,
                ':sort_order' => 0
            ];
            $model->save($data);
        }

        header('Location: ' . SITE_URL . '/admin/breaking');
        exit;
    }

    public function toggle($id) {
        $model = new BreakingModel();
        $db = \Core\Database::getInstance();
        $stmt = $db->prepare("SELECT is_active FROM breaking_news WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $current = $stmt->fetchColumn();

        $model->update($id, ['is_active' => $current ? 0 : 1]);
        header('Location: ' . SITE_URL . '/admin/breaking');
        exit;
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new BreakingModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/breaking');
            exit;
        }
    }
}
