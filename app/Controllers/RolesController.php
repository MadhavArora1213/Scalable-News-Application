<?php

namespace App\Controllers;

use Core\BaseController;

class RolesController extends BaseController {
    public function index() {
        $this->render('admin/roles/index', [
            'title' => 'Roles & Permissions - Admin'
        ]);
    }
}
