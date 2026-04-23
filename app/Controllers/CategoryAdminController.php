<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\CategoryModel;
use App\Middleware\AuthMiddleware;
use App\Helpers\SlugHelper;

class CategoryAdminController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new CategoryModel();
        $this->render('admin/categories/index', [
            'title' => 'All Categories',
            'categories' => $model->getAll()
        ]);
    }

    public function create() {
        $this->render('admin/categories/create', [
            'title' => 'Create New Category'
        ]);
    }

    public function edit($id) {
        $model = new CategoryModel();
        $category = $model->findById($id);
        if (!$category) die("Category not found");

        $this->render('admin/categories/edit', [
            'title' => 'Edit Category',
            'category' => $category
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CategoryModel();
            $data = [
                ':name_pa' => $_POST['name_pa'] ?? '',
                ':name_hi' => $_POST['name_hi'] ?? '',
                ':name_en' => $_POST['name_en'] ?? '',
                ':slug' => !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($_POST['name_en'] ?? ''),
                ':sort_order' => $_POST['sort_order'] ?? 0
            ];
            $model->save($data);
            header('Location: ' . SITE_URL . '/admin/categories');
            exit;
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CategoryModel();
            $data = [
                'name_pa' => $_POST['name_pa'] ?? '',
                'name_hi' => $_POST['name_hi'] ?? '',
                'name_en' => $_POST['name_en'] ?? '',
                'slug' => !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($_POST['name_en'] ?? ''),
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            $model->update($id, $data);
            header('Location: ' . SITE_URL . '/admin/categories');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CategoryModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/categories');
            exit;
        }
    }
}
