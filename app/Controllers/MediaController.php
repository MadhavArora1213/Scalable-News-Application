<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;

class MediaController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        // Fetch media from DB logic here
        $this->render('admin/media/index', [
            'title' => 'Media Library',
            'files' => [] // Placeholder for real data
        ]);
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Upload logic
            header('Location: /news/Scalable-News-Application/admin/media');
            exit;
        }
    }
}
