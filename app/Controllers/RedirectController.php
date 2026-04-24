<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\RedirectModel;

class RedirectController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new RedirectModel();
        
        $this->render('admin/redirects/index', [
            'title' => 'SEO URL Redirects',
            'redirects' => $model->getAll()
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new RedirectModel();
            $model->create($_POST['old_url'], $_POST['new_url']);
            header('Location: ' . SITE_URL . '/admin/redirects');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new RedirectModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/redirects');
            exit;
        }
    }
}
