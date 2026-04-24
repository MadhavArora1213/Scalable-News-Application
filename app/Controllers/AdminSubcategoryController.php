<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\SubcategoryModel;
use App\Models\CategoryModel;
use App\Helpers\SlugHelper;
use App\Middleware\AuthMiddleware;

class AdminSubcategoryController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new SubcategoryModel();
        $this->render('admin/subcategories/index', [
            'title' => 'All Subcategories',
            'subcategories' => $model->getAll()
        ]);
    }

    public function create() {
        $catModel = new CategoryModel();
        $this->render('admin/subcategories/create', [
            'title' => 'Create Subcategory',
            'categories' => $catModel->getAll()
        ]);
    }

    public function edit($id) {
        $model = new SubcategoryModel();
        $catModel = new CategoryModel();
        $sub = $model->findById($id);
        if (!$sub) die("Subcategory not found");

        $this->render('admin/subcategories/edit', [
            'title' => 'Edit Subcategory',
            'subcategory' => $sub,
            'categories' => $catModel->getAll()
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new SubcategoryModel();
            $data = [
                ':category_id' => $_POST['category_id'] ?? 0,
                ':name_en' => $_POST['name_en'] ?? '',
                ':name_pa' => $_POST['name_pa'] ?? '',
                ':name_hi' => $_POST['name_hi'] ?? '',
                ':slug' => !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($_POST['name_en'] ?? ''),
                ':sort_order' => $_POST['sort_order'] ?? 0
            ];
            $model->save($data);
            header('Location: ' . SITE_URL . '/admin/subcategories');
            exit;
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new SubcategoryModel();
            $data = [
                'category_id' => $_POST['category_id'] ?? 0,
                'name_en' => $_POST['name_en'] ?? '',
                'name_pa' => $_POST['name_pa'] ?? '',
                'name_hi' => $_POST['name_hi'] ?? '',
                'slug' => !empty($_POST['slug']) ? SlugHelper::create($_POST['slug']) : SlugHelper::create($_POST['name_en'] ?? ''),
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            $model->update($id, $data);
            header('Location: ' . SITE_URL . '/admin/subcategories');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new SubcategoryModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/subcategories');
            exit;
        }
    }
}
