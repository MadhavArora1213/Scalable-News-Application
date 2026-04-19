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
            'title' => 'Manage Navigation & Categories',
            'categories' => $model->getAll()
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CategoryModel();
            $data = [
                ':name_pa' => $_POST['name_pa'] ?? '',
                ':name_hi' => $_POST['name_hi'] ?? '',
                ':name_en' => $_POST['name_en'] ?? '',
                ':slug' => SlugHelper::create($_POST['name_en'] ?? ''),
                ':parent_id' => null,
                ':sort_order' => $_POST['sort_order'] ?? 0
            ];
            $model->save($data);
            header('Location: /news/Scalable-News-Application/admin/categories');
            exit;
        }
    }
}
