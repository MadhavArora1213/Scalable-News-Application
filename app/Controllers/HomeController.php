<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;
use Core\LanguageHelper;

class HomeController extends BaseController {
    /**
     * Main homepage entry point
     */
    public function index() {
        $lang = LanguageHelper::detect();
        header('Location: ' . SITE_URL . '/' . $lang);
        exit;
    }

    /**
     * Homepage for a specific language
     */
    public function lang(string $lang) {
        // Validate language
        if (!in_array($lang, ['pa', 'hi', 'en'])) {
            header('Location: /News_Website/pa');
            exit;
        }

        $articleModel = new ArticleModel();
        
        // 1. Get Hero Story (Top priority)
        $hero = $articleModel->getFeatured($lang, 1);
        $hero = !empty($hero) ? $hero[0] : null;

        // 2. Get Recent News (Latest 15)
        $recent = $articleModel->getLatest($lang, 15, 0);

        // FALLBACK MOCK DATA FOR HERO
        if (!$hero) {
            $hero = [
                'id' => 0,
                'title' => 'Crisis and Calm: A Deep Dive into Punjab\'s Rural Transformation',
                'excerpt' => 'As the global economy shifts, we examine how the heartland of India is navigating the challenges of modernization while preserving its rich heritage.',
                'image_path' => '',
                'category_name' => 'PORTAL EXCLUSIVE',
                'category_id' => 'news',
                'category_slug' => 'news',
                'slug' => '#',
                'published_at' => date('Y-m-d H:i:s')
            ];
        }

        // Filter hero from recent
        $filteredRecent = array_filter($recent, function($a) use ($hero) {
            return ($hero && isset($a['id'])) ? $a['id'] !== $hero['id'] : true;
        });

        // FALLBACK MOCK DATA FOR RECENT
        if (empty($filteredRecent)) {
            $filteredRecent = [
                ['id' => 101, 'title' => 'Global summits to focus on sustainable water management', 'category_name' => 'WORLD', 'category_slug' => 'world', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 102, 'title' => 'Ludhiana tech hub expansion approved by State Board', 'category_name' => 'ECONOMY', 'category_slug' => 'economy', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 103, 'title' => 'Cultural festival to bring together performers from across the state', 'category_name' => 'PUNJAB', 'category_slug' => 'punjab', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 104, 'title' => 'New sports policy aims to produce 500 international athletes', 'category_name' => 'POLITICS', 'category_slug' => 'politics', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 105, 'title' => 'Historic artifacts discovered during highway excavation', 'category_name' => 'PUNJAB', 'category_slug' => 'punjab', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 106, 'title' => 'Market report: Essential commodities see price stability', 'category_name' => 'ECONOMY', 'category_slug' => 'economy', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 107, 'title' => 'Border security enhanced following joint drill', 'category_name' => 'INDIA', 'category_slug' => 'india', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')],
                ['id' => 108, 'title' => 'Health advisory issued for the upcoming summer season', 'category_name' => 'INDIA', 'category_slug' => 'india', 'slug' => '#', 'image_path' => '', 'published_at' => date('Y-m-d H:i:s')]
            ];
        }
        
        // Populate buckets
        $latest = array_slice($filteredRecent, 0, 5); 
        $grid = array_slice($filteredRecent, 5, 6);   

        // 4. Get Dynamic Section Content
        $politics = $articleModel->getLatestByCategory('politics', $lang, 4);
        $economy = $articleModel->getLatestByCategory('economy', $lang, 4);
        $opinions = $articleModel->getLatestByCategory('opinion', $lang, 3);
        $groundReports = $articleModel->getLatestByCategory('ground-reports', $lang, 1);

        // FALLBACK MOCK DATA (If database is empty)
        if (empty($politics)) {
            $politics = [
                ['title' => 'Election Commission issues new guidelines for state polls', 'category_slug' => 'politics', 'slug' => '#', 'image_path' => ''],
                ['title' => 'Cabinet approves infrastructure project for Rural Punjab', 'category_slug' => 'politics', 'slug' => '#', 'image_path' => ''],
                ['title' => 'Political realignment ahead of local body elections', 'category_slug' => 'politics', 'slug' => '#', 'image_path' => '']
            ];
        }
        if (empty($economy)) {
            $economy = [
                ['title' => 'GST collections reach a record high of â‚¹2 Lakh Crore', 'slug' => '#', 'image_path' => ''],
                ['title' => 'Ludhiana knitwear industry sees surge in winter exports', 'slug' => '#', 'image_path' => ''],
                ['title' => 'Tech startups in Mohali secure $50M in seed funding', 'slug' => '#', 'image_path' => '']
            ];
        }
        if (empty($opinions)) {
            $opinions = [
                ['title' => 'The digitalization of Rural Punjab: A new dawn?', 'author_name' => 'Dr. Aman Singh', 'slug' => '#'],
                ['title' => 'Why traditional agriculture needs a tech overhaul', 'author_name' => 'Gurpreet Kaur', 'slug' => '#'],
                ['title' => 'Economic resilience in the face of global uncertainty', 'author_name' => 'Prof. S. Bajaj', 'slug' => '#']
            ];
        }
        if (!$groundReports) {
            $groundReports = [[
                'title' => 'The invisible crisis: Water depletion in the border districts',
                'excerpt' => 'Our reporters traveled 500km along the border to understand why traditional wells are drying up faster than ever before.',
                'slug' => '#',
                'image_path' => '',
                'category_name' => 'Ground Report',
                'category_slug' => 'punjab'
            ]];
        }

        // 5. Get Breaking News items (Mock for now, should be from DB later)
        $breaking = [
            ['headline' => 'ਪੰਜਾਬ ਵਿੱਚ ਨਵੀਂ ਸਿੱਖਿਆ ਨੀਤੀ ਲਾਗੂ', 'url' => '#'],
            ['headline' => 'Punjab farmers reach consensus on new water treaty', 'url' => '#'],
            ['headline' => 'ਲੁਧਿਆਣਾ ਵਿੱਚ ਖੇਡ ਮੇਲੇ ਦਾ ਆਗਾਜ਼', 'url' => '#'],
        ];

        // Render the view
        $this->render('frontend/home', [
            'hero' => $hero,
            'latest' => $latest,
            'grid' => $grid,
            'politics' => $politics,
            'economy' => $economy,
            'opinions' => $opinions,
            'groundReports' => !empty($groundReports) ? $groundReports[0] : null,
            'breaking' => $breaking,
            'lang' => $lang,
            'title' => 'ਖ਼ਬਰਾਂ Khabran - Voice of Punjab'
        ]);
    }
}
