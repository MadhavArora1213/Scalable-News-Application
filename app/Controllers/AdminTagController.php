<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\TagModel;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use App\Helpers\SlugHelper;
use App\Middleware\AuthMiddleware;

class AdminTagController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new TagModel();
        $this->render('admin/tags/index', [
            'title' => 'All Tags',
            'tags' => $model->getAll()
        ]);
    }

    public function create() {
        $catModel = new CategoryModel();
        $subModel = new SubcategoryModel();
        
        $this->render('admin/tags/create', [
            'title' => 'Create New Tag',
            'categories' => $catModel->getAll(),
            'subcategories' => $subModel->getAll()
        ]);
    }

    public function edit($id) {
        $model = new TagModel();
        $catModel = new CategoryModel();
        $subModel = new SubcategoryModel();
        
        $tag = $model->findById($id);
        if (!$tag) die("Tag not found");

        $this->render('admin/tags/edit', [
            'title' => 'Edit Tag',
            'tag' => $tag,
            'categories' => $catModel->getAll(),
            'subcategories' => $subModel->getAll()
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new TagModel();
            $data = [
                ':name' => $_POST['name'] ?? '',
                ':slug' => SlugHelper::create($_POST['name'] ?? ''),
                ':lang' => $_POST['lang'] ?? 'pa',
                ':category_id' => !empty($_POST['category_id']) ? $_POST['category_id'] : null,
                ':subcategory_id' => !empty($_POST['subcategory_id']) ? $_POST['subcategory_id'] : null
            ];
            $model->save($data);
            header('Location: ' . SITE_URL . '/admin/tags');
            exit;
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new TagModel();
            $data = [
                'name' => $_POST['name'] ?? '',
                'slug' => SlugHelper::create($_POST['name'] ?? ''),
                'lang' => $_POST['lang'] ?? 'pa',
                'category_id' => !empty($_POST['category_id']) ? $_POST['category_id'] : null,
                'subcategory_id' => !empty($_POST['subcategory_id']) ? $_POST['subcategory_id'] : null
            ];
            $model->update($id, $data);
            header('Location: ' . SITE_URL . '/admin/tags');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new TagModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/tags');
            exit;
        }
    }
}
