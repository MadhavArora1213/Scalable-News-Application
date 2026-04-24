<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\SubscriberModel;

class SubscriberController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new SubscriberModel();
        
        $this->render('admin/subscribers/index', [
            'title' => 'Audience & Engagement',
            'subscribers' => $model->getAll(),
            'emailCount' => $model->getEmailCount(),
            'pushCount' => $model->getPushCount()
        ]);
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new SubscriberModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/subscribers');
            exit;
        }
    }
}
