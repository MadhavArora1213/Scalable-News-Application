<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Database.php';

use Core\Database;

$db = Database::getInstance();

// We are NOT truncating here, just ADDING more news to create a backlog
$news = [
    [
        'category' => 3, // Weather/India
        'author' => 1,
        'image' => 'assets/images/north_india_heatwave_intense_1776531425266.png',
        'priority' => 'normal',
        'time_offset' => '1 hour ago',
        'slug' => 'north-india-heatwave-alert-imd',
        'en' => ['title' => 'IMD warns of severe heatwave in North India; temperatures to cross 45°C', 'excerpt' => 'The India Meteorological Department has issued a red alert for several states as a brutal heatwave sweeps the northern plains.'],
        'hi' => ['title' => 'उत्तर भारत में भीषण लू की चेतावनी; तापमान 45 डिग्री सेल्सियस के पार पहुंचेगा', 'excerpt' => 'भारतीय मौसम विभाग ने कई राज्यों के लिए रेड अलर्ट जारी किया है क्योंकि उत्तर भारत में भीषण लू चल रही है।'],
        'pa' => ['title' => 'ਉੱਤਰੀ ਭਾਰਤ ਵਿੱਚ ਭਿਆਨਕ ਗਰਮੀ ਦੀ ਚੇਤਾਵਨੀ; ਤਾਪਮਾਨ 45 ਡਿਗਰੀ ਸੈਲਸੀਅਸ ਤੋਂ ਪਾਰ ਜਾਵੇਗਾ', 'excerpt' => 'ਭਾਰਤੀ ਮੌਸਮ ਵਿਭਾਗ ਨੇ ਕਈ ਰਾਜਾਂ ਲਈ ਰੈੱਡ ਅਲਰਟ ਜਾਰੀ ਕੀਤਾ ਹੈ ਕਿਉਂਕਿ ਉੱਤਰੀ ਮੈਦਾਨੀ ਇਲਾਕਿਆਂ ਵਿੱਚ ਭਿਆਨਕ ਲੂ ਚੱਲ ਰਹੀ ਹੈ।']
    ],
    [
        'category' => 2, // Economy
        'author' => 1,
        'image' => 'assets/images/stock_market_decline_red_1776531490170.png',
        'priority' => 'normal',
        'time_offset' => '3 hours ago',
        'slug' => 'sensex-drops-points-global-cues',
        'en' => ['title' => 'Sensex drops 500 points on global cues; IT and Banking stocks lead decline', 'excerpt' => 'Indian markets witnessed a sharp sell-off today as global economic uncertainty continues to weigh on investor sentiment.'],
        'hi' => ['title' => 'ग्लोबल संकेतों से सेंसेक्स 500 अंक गिरा; आईटी और बैंकिंग शेयरों में भारी गिरावट', 'excerpt' => 'वैश्विक आर्थिक अनिश्चितता के कारण आज भारतीय बाजारों में भारी बिकवाली देखी गई।'],
        'pa' => ['title' => 'ਗਲੋਬਲ ਸੰਕੇਤਾਂ ਕਾਰਨ ਸੈਂਸੈਕਸ 500 ਅੰਕ ਡਿੱਗਿਆ; ਆਈਟੀ ਅਤੇ ਬੈਂਕਿੰਗ ਸ਼ੇਅਰਾਂ ਵਿੱਚ ਭਾਰੀ ਗਿਰਾਵਟ', 'excerpt' => 'ਗਲੋਬਲ ਆਰਥਿਕ ਅਨਿਸ਼ਚਿਤਤਾ ਦੇ ਕਾਰਨ ਅੱਜ ਭਾਰਤੀ ਬਾਜ਼ਾਰਾਂ ਵਿੱਚ ਭਾਰੀ ਵਿਕਵਾਲੀ ਦੇਖੀ ਗਈ।']
    ],
    [
        'category' => 4, // Punjab
        'author' => 1,
        'image' => 'assets/images/golden_temple_baisakhi_celebration_1776531572259.png',
        'priority' => 'top',
        'time_offset' => '5 hours ago',
        'slug' => 'golden-temple-record-footfall-baisakhi',
        'en' => ['title' => 'Golden Temple sees record footfall on Baisakhi; 1.5 lakh devotees visit Shrine', 'excerpt' => 'The holy city of Amritsar was drenched in religious fervor as thousands of devotees gathered at Harmandir Sahib to celebrate Baisakhi.'],
        'hi' => ['title' => 'बैसाखी पर स्वर्ण मंदिर में रिकॉर्ड भीड़; 1.5 लाख भक्तों ने मत्था टेका', 'excerpt' => 'बैसाखी मनाने के लिए स्वर्ण मंदिर में हजारों भक्तों के जुटने से अमृतसर शहर धार्मिक रंग में रंग गया।'],
        'pa' => ['title' => 'ਵਿਸਾਖੀ ਮੌਕੇ ਸ੍ਰੀ ਹਰਿਮੰਦਰ ਸਾਹਿਬ ਵਿਖੇ ਰਿਕਾਰਡ ਸੰਗਤਾਂ ਦੀ ਆਮਦ; 1.5 ਲੱਖ ਸ਼ਰਧਾਲੂ ਨਤਮਸਤਕ', 'excerpt' => 'ਵਿਸਾਖੀ ਮਨਾਉਣ ਲਈ ਸ੍ਰੀ ਹਰਿਮੰਦਰ ਸਾਹਿਬ ਵਿਖੇ ਹਜ਼ਾਰਾਂ ਦੀ ਗਿਣਤੀ ਵਿੱਚ ਸੰਗਤਾਂ ਦੇ ਇਕੱਠੇ ਹੋਣ ਕਾਰਨ ਅੰਮ੍ਰਿਤਸਰ ਸ਼ਹਿਰ ਧਾਰਮਿਕ ਰੰਗ ਵਿੱਚ ਰੰਗਿਆ ਗਿਆ।']
    ],
    [
        'category' => 4, // Punjab
        'author' => 1,
        'image' => 'assets/images/punjab_clean_agriculture_farm_1776531629028.png',
        'priority' => 'normal',
        'time_offset' => '8 hours ago',
        'slug' => 'punjab-stubble-burning-drop-report',
        'en' => ['title' => 'Punjab records 20% drop in stubble burning cases this season, central report reveals', 'excerpt' => 'Consistent efforts by the state government and awareness campaigns among farmers have led to a significant decrease in farm fires.'],
        'hi' => ['title' => 'पंजाब में इस सीजन में पराली जलाने के मामलों में 20% की कमी, केंद्रीय रिपोर्ट में खुलासा', 'excerpt' => 'राज्य सरकार के प्रयासों और किसानों में जागरूकता अभियानों के कारण पराली जलाने की घटनाओं में भारी कमी आई है।'],
        'pa' => ['title' => 'ਪੰਜਾਬ ਵਿੱਚ ਇਸ ਸੀਜ਼ਨ ਦੌਰਾਨ ਪਰਾਲੀ ਸਾੜਨ ਦੇ ਮਾਮਲਿਆਂ ਵਿੱਚ 20% ਦੀ ਕਮੀ, ਕੇਂਦਰੀ ਰਿਪੋਰਟ ਵਿੱਚ ਖੁਲਾਸਾ', 'excerpt' => 'ਰਾਜ ਸਰਕਾਰ ਦੇ ਯਤਨਾਂ ਅਤੇ ਕਿਸਾਨਾਂ ਵਿੱਚ ਜਾਗਰੂਕਤਾ ਮੁਹਿੰਮਾਂ ਸਦਕਾ ਪਰਾਲੀ ਸਾੜਨ ਦੀਆਂ ਘਟਨਾਵਾਂ ਵਿੱਚ ਭਾਰੀ ਕਮੀ ਆਈ ਹੈ।']
    ]
];

// Adding 6 more "Quick Fill" news stories to ensure the scroll goes long
for($i = 1; $i <= 6; $i++) {
    $news[] = [
        'category' => rand(1, 7),
        'author' => 1,
        'image' => 'assets/images/punjab_politics_news_1776523711178.png',
        'priority' => 'normal',
        'time_offset' => ($i * 12) . ' hours ago',
        'slug' => "archived-news-item-$i",
        'en' => ['title' => "Editorial Archive Story #$i: National News Digest", 'excerpt' => "A deep dive into the historical significance of today's events and how they shape the future of India."],
        'hi' => ['title' => "संपादकीय संग्रह कहानी #$i: राष्ट्रीय समाचार डाइजेस्ट", 'excerpt' => "आज की घटनाओं के ऐतिहासिक महत्व और वे भारत के भविष्य को कैसे आकार देती हैं, इस पर एक गहरी नज़र।"],
        'pa' => ['title' => "ਸੰਪਾਦਕੀ ਪੁਰਾਲੇਖ ਕਹਾਣੀ #$i: ਰਾਸ਼ਟਰੀ ਸਮਾਚਾਰ ਡਾਈਜੈਸਟ", 'excerpt' => "ਅੱਜ ਦੀਆਂ ਘਟਨਾਵਾਂ ਦੇ ਇਤਿਹਾਸਕ ਮਹੱਤਵ ਅਤੇ ਉਹ ਭਾਰਤ ਦੇ ਭਵਿੱਖ ਨੂੰ ਕਿਵੇਂ ਆਕਾਰ ਦਿੰਦੀਆਂ ਹਨ, ਇਸ 'ਤੇ ਇੱਕ ਡੂੰਘੀ ਨਜ਼ਰ।"]
    ];
}

$stmtMedia = $db->prepare("INSERT INTO media (filename, path) VALUES (?, ?)");
$stmtArticle = $db->prepare("INSERT INTO articles (title, slug, excerpt, body, category_id, author_id, lang, featured_image, published_at, status, priority) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'published', ?)");

foreach ($news as $item) {
    try {
        $stmtMedia->execute([basename($item['image']), $item['image']]);
        $mediaId = $db->lastInsertId();
        $pubDate = date('Y-m-d H:i:s', strtotime('-' . ($item['time_offset'] ?? '1 day')));

        foreach (['en', 'hi', 'pa'] as $l) {
            $langSlug = $item['slug'] . ($l === 'en' ? '' : "-$l");
            $stmtArticle->execute([
                $item[$l]['title'],
                $langSlug,
                $item[$l]['excerpt'],
                $item[$l]['excerpt'] . " Full detailed archive content for infinite scroll testing.",
                $item['category'],
                $item['author'],
                $l,
                $mediaId,
                $pubDate,
                $item['priority']
            ]);
        }
    } catch (\Exception $e) {
        echo "Error saving " . $item['slug'] . ": " . $e->getMessage() . "<br>";
    }
}

echo "Database successfully enriched with 10+ historical stories for Infinite Scroll development.";
?>
