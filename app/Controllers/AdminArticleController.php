<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Helpers\SlugHelper;
use App\Helpers\ImageHelper;
use App\Middleware\AuthMiddleware;

class AdminArticleController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new ArticleModel();
        // Get all articles across all languages for admin view
        $stmt = \Core\Database::getInstance()->prepare(
            "SELECT a.*, u.name AS author_name, c.name_en AS category_name, m.path AS image_path 
             FROM articles a 
             LEFT JOIN users u ON a.author_id = u.id 
             LEFT JOIN categories c ON a.category_id = c.id 
             LEFT JOIN media m ON a.featured_image = m.id 
             ORDER BY a.created_at DESC LIMIT 100"
        );
        $stmt->execute();
        $articles = $stmt->fetchAll();
        
        $this->render('admin/articles/index', [
            'articles' => $articles,
            'title' => 'Manage Articles'
        ]);
    }

    public function create() {
        $catModel = new CategoryModel();
        $this->render('admin/articles/create', [
            'title' => 'Write New Article',
            'categories' => $catModel->getAll()
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleModel = new ArticleModel();
            
            $title = $_POST['title'] ?? '';
            $slug = !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($title);
            
            $data = [
                ':title' => $title,
                ':slug' => $slug,
                ':body' => $_POST['body'] ?? '',
                ':excerpt' => $_POST['excerpt'] ?? '',
                ':author_id' => $_SESSION['admin_user']['id'],
                ':category_id' => $_POST['category_id'] ?? 1,
                ':lang' => $_POST['lang'] ?? 'pa',
                ':status' => $_POST['status'] ?? 'draft',
                ':priority' => $_POST['priority'] ?? 'normal',
                ':featured_image' => null,
                ':seo_title' => $_POST['seo_title'] ?? $title,
                ':meta_desc' => $_POST['meta_desc'] ?? '',
                ':published_at' => ($_POST['status'] === 'published') ? date('Y-m-d H:i:s') : null
            ];

            // Image process placeholder
            if (!empty($_FILES['image']['tmp_name'])) {
                // In real world: process image, save to media table, get ID
            }

            $articleModel->save($data);
            header('Location: /News_Website/admin/articles');
            exit;
        }
    }

    public function edit($id) {
        $articleModel = new ArticleModel();
        $catModel = new CategoryModel();
        
        $stmt = \Core\Database::getInstance()->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch();

        if (!$article) {
            die("Article not found");
        }

        $this->render('admin/articles/edit', [
            'title' => 'Edit Article',
            'article' => $article,
            'categories' => $catModel->getAll()
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleModel = new ArticleModel();
            
            $title = $_POST['title'] ?? '';
            $slug = !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($title);

            $data = [
                'title' => $title,
                'slug' => $slug,
                'body' => $_POST['body'] ?? '',
                'excerpt' => $_POST['excerpt'] ?? '',
                'category_id' => $_POST['category_id'] ?? 1,
                'lang' => $_POST['lang'] ?? 'pa',
                'status' => $_POST['status'] ?? 'draft',
                'priority' => $_POST['priority'] ?? 'normal',
                'seo_title' => $_POST['seo_title'] ?? '',
                'meta_desc' => $_POST['meta_desc'] ?? '',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($_POST['status'] === 'published' && empty($_POST['published_at'])) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }

            $articleModel->update($id, $data);
            header('Location: /News_Website/admin/articles');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleModel = new ArticleModel();
            $articleModel->delete($id);
            header('Location: /News_Website/admin/articles');
            exit;
        }
    }
}
