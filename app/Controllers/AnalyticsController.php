<?php

namespace App\Controllers;

use Core\BaseController;
use App\Middleware\AuthMiddleware;
use App\Models\AnalyticsModel;

class AnalyticsController extends BaseController {
    public function __construct($route_params) {
        parent::__construct($route_params);
        AuthMiddleware::check();
    }

    public function index() {
        $model = new AnalyticsModel();
        
        $this->render('admin/analytics/index', [
            'title' => 'Traffic & Trending Stories',
            'totalViews' => $model->getTotalViews(),
            'trendingToday' => $model->getTrending(10, 1),
            'trendingWeek' => $model->getTrending(10, 7)
        ]);
    }
}
