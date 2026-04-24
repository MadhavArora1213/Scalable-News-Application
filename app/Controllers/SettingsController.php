<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\SettingsModel;
use App\Helpers\ImageHelper;

class SettingsController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new SettingsModel();
        
        $this->render('admin/settings/index', [
            'title' => 'Site Settings',
            'settings' => $model->getAll()
        ]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new SettingsModel();
            
            // Handle file uploads (Logo, Favicon)
            if (isset($_FILES['site_logo']) && $_FILES['site_logo']['error'] === UPLOAD_ERR_OK) {
                $logo = ImageHelper::processUpload($_FILES['site_logo']);
                if ($logo) {
                    $model->update('site_logo', $logo['path']);
                }
            }

            // Handle other settings
            $settings = $_POST['settings'] ?? [];
            foreach ($settings as $key => $value) {
                $model->update($key, $value);
            }

            header('Location: ' . SITE_URL . '/admin/settings');
            exit;
        }
    }
}
