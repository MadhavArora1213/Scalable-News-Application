<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\MediaModel;
use App\Helpers\ImageHelper;

class MediaController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new MediaModel();
        
        $this->render('admin/media/index', [
            'title' => 'Media Library',
            'media' => $model->getAll()
        ]);
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['file'])) {
            try {
                $uploadResult = ImageHelper::processUpload($_FILES['file']);
                
                $model = new MediaModel();
                $model->save([
                    ':filename' => $_FILES['file']['name'],
                    ':path' => $uploadResult['path'],
                    ':alt_text' => $_POST['alt_text'] ?? '',
                    ':credit' => $_POST['credit'] ?? '',
                    ':type' => 'image',
                    ':size' => $_FILES['file']['size']
                ]);
                
                header('Location: ' . SITE_URL . '/admin/media');
                exit;
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new MediaModel();
            $model->update($id, [
                'alt_text' => $_POST['alt_text'] ?? '',
                'credit' => $_POST['credit'] ?? ''
            ]);
            header('Location: ' . SITE_URL . '/admin/media');
            exit;
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new MediaModel();
            $model->delete($id);
            header('Location: ' . SITE_URL . '/admin/media');
            exit;
        }
    }
}
