<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\AdModel;

class AdController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new AdModel();
        
        $this->render('admin/ads/index', [
            'title' => 'Advertisement Management',
            'ads' => $model->getAll()
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AdModel();
            $model->update($id, $_POST['code'], isset($_POST['is_active']) ? 1 : 0);
            header('Location: ' . SITE_URL . '/admin/ads');
            exit;
        }
    }

    public function toggle($id) {
        $model = new AdModel();
        $model->toggle($id);
        header('Location: ' . SITE_URL . '/admin/ads');
        exit;
    }
}
