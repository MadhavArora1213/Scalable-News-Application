<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Database.php';

use Core\Database;

$db = Database::getInstance();

$db->exec("SET FOREIGN_KEY_CHECKS = 0");
$db->exec("TRUNCATE TABLE media");
$db->exec("TRUNCATE TABLE articles");
$db->exec("SET FOREIGN_KEY_CHECKS = 1");

$news = [
    [
        'category' => 1, // Politics
        'author' => 1,
        'image' => 'assets/images/pm_modi_address_authoritative_1776525448809.png',
        'priority' => 'featured',
        'slug' => 'pm-modi-address-nation-womens-quota',
        'en' => [
            'title' => 'PM Modi to address nation at 8:30 PM after women’s quota bill defeat',
            'excerpt' => 'Prime Minister Narendra Modi is set to address the nation tonight following the controversial fall of the Women’s Reservation Bill in the Lok Sabha.'
        ],
        'hi' => [
            'title' => 'महिला कोटा विधेयक गिरने के बाद आज रात 8:30 बजे राष्ट्र को संबोधित करेंगे पीएम मोदी',
            'excerpt' => 'लोकसभा में महिला आरक्षण विधेयक के गिरने के बाद प्रधानमंत्री नरेंद्र मोदी आज रात राष्ट्र को संबोधित करने वाले हैं।'
        ],
        'pa' => [
            'title' => 'ਮਹਿਲਾ ਕੋਟਾ ਬਿੱਲ ਡਿੱਗਣ ਤੋਂ ਬਾਅਦ ਪੀਐਮ ਮੋਦੀ ਅੱਜ ਰਾਤ 8:30 ਵਜੇ ਰਾਸ਼ਟਰ ਨੂੰ ਸੰਬੋਧਨ ਕਰਨਗੇ',
            'excerpt' => 'ਲੋਕ ਸਭਾ ਵਿੱਚ ਮਹਿਲਾ ਰਾਖਵਾਂਕਰਨ ਬਿੱਲ ਦੇ ਡਿੱਗਣ ਤੋਂ ਬਾਅਦ ਪ੍ਰਧਾਨ ਮੰਤਰੀ ਨਰਿੰਦਰ ਮੋਦੀ ਅੱਜ ਰਾਤ ਦੇਸ਼ ਨੂੰ ਸੰਬੋਧਨ ਕਰਨ ਵਾਲੇ ਹਨ।'
        ]
    ],
    [
        'category' => 7, // International
        'author' => 1,
        'image' => 'assets/images/hormuz_strait_conflict_tanker_1776525465773.png',
        'priority' => 'top',
        'slug' => 'mea-summons-iran-envoy-hormuz',
        'en' => [
            'title' => 'Hormuz firing: MEA summons Iran envoy; seeks safe passage for Indian tankers',
            'excerpt' => 'India has lodged a strong protest with Tehran after gunfire was reported in the Strait of Hormuz, affecting commercial maritime routes.'
        ],
        'hi' => [
            'title' => 'हॉर्मुज गोलीबारी: विदेश मंत्रालय ने ईरानी दूत को तलब किया; भारतीय टैंकरों के लिए सुरक्षित मार्ग की मांग की',
            'excerpt' => 'हॉर्मुज जलडमरूमध्य में गोलीबारी की खबर मिलने के बाद भारत ने तेहरान के सामने कड़ा विरोध दर्ज कराया है।'
        ],
        'pa' => [
            'title' => 'ਹਾਰਮੁਜ਼ ਗੋਲੀਬਾਰੀ: ਵਿਦੇਸ਼ ਮੰਤਰਾਲੇ ਨੇ ਈਰਾਨੀ ਦੂਤ ਨੂੰ ਤਲਬ ਕੀਤਾ; ਭਾਰਤੀ ਟੈਂਕਰਾਂ ਲਈ ਸੁਰੱਖਿਅਤ ਰਸਤੇ ਦੀ ਮੰਗ ਕੀਤੀ',
            'excerpt' => 'ਹਾਰਮੁਜ਼ ਦੇ ਜਲਡਮਰੂ ਮੱਧ ਵਿੱਚ ਗੋਲੀਬਾਰੀ ਦੀ ਸੂਚਨਾ ਮਿਲਣ ਤੋਂ ਬਾਅਦ ਭਾਰਤ ਨੇ ਤੇਹਰਾਨ ਕੋਲ ਸਖ਼ਤ ਵਿਰੋਧ ਦਰਜ ਕਰਵਾਇਆ ਹੈ।'
        ]
    ],
    [
        'category' => 5, // Tech
        'author' => 1,
        'image' => 'assets/images/ai_coding_future_sleek_1776525486891.png',
        'priority' => 'normal',
        'slug' => 'claudecode-creator-ide-dead-soon',
        'en' => [
            'title' => 'Claude Code creator: IDEs like VS Code and Xcode will be "dead soon"',
            'excerpt' => 'AI agent pioneer Boris Cherny predicts traditional coding environments will vanish as autonomous builders take over the development cycle.'
        ],
        'hi' => [
            'title' => 'क्लाउड कोड निर्माता: वीएस कोड और एक्सकोड जैसे आईडीई जल्द ही "खत्म" हो जाएंगे',
            'excerpt' => 'एआई एजेंट अग्रणी बोरिस चेर्नी ने भविष्यवाणी की है कि पारंपरिक कोडिंग वातावरण गायब हो जाएंगे क्योंकि स्वायत्त निर्माता विकास चक्र को संभाल लेंगे।'
        ],
        'pa' => [
            'title' => 'ਕਲਾਉਡ ਕੋਡ ਨਿਰਮਾਤਾ: VS ਕੋਡ ਅਤੇ ਐਕਸਕੋਡ ਵਰਗੇ IDE ਜਲਦੀ ਹੀ "ਖਤਮ" ਹੋ ਜਾਣਗੇ',
            'excerpt' => 'AI ਏਜੰਟ ਪਾਇਨੀਅਰ ਬੋਰਿਸ ਚੇਰਨੀ ਨੇ ਭਵਿੱਖਬਾਣੀ ਕੀਤੀ ਹੈ ਕਿ ਰਵਾਇਤੀ ਕੋਡਿੰਗ ਵਾਤਾਵਰਣ ਗਾਇਬ ਹੋ ਜਾਣਗੇ ਕਿਉਂਕਿ ਖੁਦਮੁਖਤਿਆਰ ਬਿਲਡਰ ਵਿਕਾਸ ਚੱਕਰ ਨੂੰ ਸੰਭਾਲ ਲੈਣਗੇ।'
        ]
    ],
    [
        'category' => 6, // Sports
        'author' => 1,
        'image' => 'assets/images/ipl_cricket_stadium_action_1776525507623.png',
        'priority' => 'normal',
        'slug' => 'ipl-2026-david-miller-finish-rcb',
        'en' => [
            'title' => 'IPL 2026: David Miller redeems himself with last-over finish against RCB',
            'excerpt' => 'Killer Miller returns to form as Delhi Capitals pull off a massive chase at the Chinnaswamy stadium in a high-octane encounter.'
        ],
        'hi' => [
            'title' => 'आईपीएल 2026: डेविड मिलर ने आरसीबी के खिलाफ आखिरी ओवर में फिनिश के साथ खुद को साबित किया',
            'excerpt' => 'किलर मिलर फिर से फॉर्म में आ गए हैं क्योंकि दिल्ली कैपिटल्स ने चिन्नास्वामी स्टेडियम में एक बड़े लक्ष्य का पीछा करते हुए रोमांचक जीत दर्ज की।'
        ],
        'pa' => [
            'title' => 'IPL 2026: ਡੇਵਿਡ ਮਿਲਰ ਨੇ RCB ਦੇ ਖਿਲਾਫ ਆਖਰੀ ਓਵਰ ਵਿੱਚ ਫਿਨਿਸ਼ ਦੇ ਨਾਲ ਆਪਣੇ ਆਪ ਨੂੰ ਸਾਬਤ ਕੀਤਾ',
            'excerpt' => 'ਕਿਲਰ ਮਿਲਰ ਫਾਰਮ ਵਿੱਚ ਵਾਪਸ ਆ ਗਿਆ ਹੈ ਕਿਉਂਕਿ ਦਿੱਲੀ ਕੈਪੀਟਲਜ਼ ਨੇ ਚਿੰਨਾਸਵਾਮੀ ਸਟੇਡੀਅਮ ਵਿੱਚ ਇੱਕ ਵੱਡੇ ਟੀਚੇ ਦਾ ਪਿੱਛਾ ਕਰਦੇ ਹੋਏ ਯਾਦਗਾਰ ਜਿੱਤ ਦਰਜ ਕੀਤੀ।'
        ]
    ]
];

$stmtMedia = $db->prepare("INSERT INTO media (filename, path) VALUES (?, ?)");
$stmtArticle = $db->prepare("INSERT INTO articles (title, slug, excerpt, body, category_id, author_id, lang, featured_image, published_at, status, priority) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'published', ?)");

foreach ($news as $item) {
    try {
        $stmtMedia->execute([basename($item['image']), $item['image']]);
        $mediaId = $db->lastInsertId();
        
        foreach (['en', 'hi', 'pa'] as $l) {
            $langSlug = $item['slug'] . ($l === 'en' ? '' : "-$l");
            $stmtArticle->execute([
                $item[$l]['title'],
                $langSlug,
                $item[$l]['excerpt'],
                $item[$l]['excerpt'] . " Full detailed content for testing trilingual news delivery.",
                $item['category'],
                $item['author'],
                $l,
                $mediaId, // featured_image id
                $item['priority']
            ]);
        }
    } catch (\Exception $e) {
        echo "Error saving " . $item['slug'] . ": " . $e->getMessage() . "<br>";
    }
}

echo "Database populated with high-priority headlines and editorial metadata.";
?>
