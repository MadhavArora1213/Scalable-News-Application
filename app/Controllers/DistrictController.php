<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;
use Core\LanguageHelper;

class DistrictController extends BaseController {
    
    public function index(string $lang, string $district) {
        $articleModel = new ArticleModel();
        
        // In a real app, you would search by a district_id or a specific tag
        // For now, we search for articles containing the district name
        $articles = $articleModel->search($district, $lang, 12);
        
        $tr = LanguageHelper::getTranslations($lang);
        
        $this->render('frontend/category', [
            'title' => ucfirst($district) . " News - The Khabran",
            'lang' => $lang,
            'category_name' => ucfirst($district) . " District",
            'articles' => $articles,
            'description' => "Stay updated with the latest news, events, and ground reports from {$district} district of Punjab. Our dedicated reporting brings you stories from the heart of the city."
        ]);
    }
}
