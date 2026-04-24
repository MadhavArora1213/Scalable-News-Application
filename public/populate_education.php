<?php
// public/populate_education.php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../core/Database.php';

$db = \Core\Database::getInstance();

// Find the Education category
$stmt = $db->query("SELECT id FROM categories WHERE slug = 'education' LIMIT 1");
$educationCat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$educationCat) {
    die("Error: Education category not found. Please run setup_categories.php first.");
}

$cat_id = $educationCat['id'];
$author_id = 1; // Assuming default admin is 1

// Education images from Unsplash
$images = [
    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80', // University
    'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800&q=80', // School
    'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80', // Students studying
    'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80'  // Library
];

// Education Articles Data (English)
$articles_en = [
    [
        'title' => 'PSEB Class 12 Board Exam Dates Announced for 2026',
        'slug' => 'pseb-class-12-board-exam-dates-2026',
        'excerpt' => 'The Punjab School Education Board has officially released the date sheet for the upcoming Class 12 examinations starting this March.',
        'body' => '<p>The Punjab School Education Board (PSEB) has released the much-awaited date sheet for the Class 12 board examinations for the academic year 2026. The exams will commence on March 3, 2026, and conclude by the first week of April.</p><p>Students can download the official schedule from the PSEB website. The board has also announced strict anti-cheating measures across all examination centers in Punjab.</p>',
        'image' => $images[0],
        'lang' => 'en'
    ],
    [
        'title' => 'Panjab University Ranked Among Top 10 in India Again',
        'slug' => 'panjab-university-ranked-top-10-india',
        'excerpt' => 'In the latest national rankings, Panjab University Chandigarh has secured its position among the top educational institutions in the country.',
        'body' => '<p>Panjab University (PU) Chandigarh continues its legacy of academic excellence by securing a spot in the top 10 universities in the latest National Institutional Ranking Framework (NIRF). The university scored particularly well in research output and teaching quality.</p><p>The Vice-Chancellor congratulated the faculty and students, noting that the university aims to break into the top 5 by next year with increased funding for research programs.</p>',
        'image' => $images[1],
        'lang' => 'en'
    ]
];

// Punjabi Translations
$articles_pa = [
    [
        'title' => 'PSEB ਨੇ 2026 ਲਈ 12ਵੀਂ ਜਮਾਤ ਦੀਆਂ ਬੋਰਡ ਪ੍ਰੀਖਿਆਵਾਂ ਦੀਆਂ ਤਰੀਕਾਂ ਦਾ ਕੀਤਾ ਐਲਾਨ',
        'slug' => 'pseb-class-12-board-exam-dates-2026-pa',
        'excerpt' => 'ਪੰਜਾਬ ਸਕੂਲ ਸਿੱਖਿਆ ਬੋਰਡ ਨੇ ਮਾਰਚ ਤੋਂ ਸ਼ੁਰੂ ਹੋਣ ਵਾਲੀਆਂ 12ਵੀਂ ਜਮਾਤ ਦੀਆਂ ਪ੍ਰੀਖਿਆਵਾਂ ਲਈ ਡੇਟਸ਼ੀਟ ਜਾਰੀ ਕਰ ਦਿੱਤੀ ਹੈ।',
        'body' => '<p>ਪੰਜਾਬ ਸਕੂਲ ਸਿੱਖਿਆ ਬੋਰਡ (PSEB) ਨੇ ਵਿੱਦਿਅਕ ਸਾਲ 2026 ਲਈ 12ਵੀਂ ਜਮਾਤ ਦੀਆਂ ਬੋਰਡ ਪ੍ਰੀਖਿਆਵਾਂ ਲਈ ਬੇਸਬਰੀ ਨਾਲ ਉਡੀਕੀ ਜਾ ਰਹੀ ਡੇਟਸ਼ੀਟ ਜਾਰੀ ਕਰ ਦਿੱਤੀ ਹੈ। ਪ੍ਰੀਖਿਆਵਾਂ 3 ਮਾਰਚ, 2026 ਨੂੰ ਸ਼ੁਰੂ ਹੋਣਗੀਆਂ ਅਤੇ ਅਪ੍ਰੈਲ ਦੇ ਪਹਿਲੇ ਹਫ਼ਤੇ ਤੱਕ ਸਮਾਪਤ ਹੋਣਗੀਆਂ।</p><p>ਵਿਦਿਆਰਥੀ PSEB ਦੀ ਵੈੱਬਸਾਈਟ ਤੋਂ ਅਧਿਕਾਰਤ ਸ਼ਡਿਊਲ ਡਾਊਨਲੋਡ ਕਰ ਸਕਦੇ ਹਨ। ਬੋਰਡ ਨੇ ਪੰਜਾਬ ਦੇ ਸਾਰੇ ਪ੍ਰੀਖਿਆ ਕੇਂਦਰਾਂ ਵਿੱਚ ਨਕਲ ਰੋਕਣ ਲਈ ਸਖ਼ਤ ਕਦਮ ਚੁੱਕਣ ਦਾ ਐਲਾਨ ਵੀ ਕੀਤਾ ਹੈ।</p>',
        'image' => $images[2],
        'lang' => 'pa'
    ],
    [
        'title' => 'ਕੈਨੇਡਾ ਸਟੱਡੀ ਵੀਜ਼ਾ ਨਿਯਮਾਂ ਵਿੱਚ ਬਦਲਾਅ: ਪੰਜਾਬ ਦੇ ਵਿਦਿਆਰਥੀਆਂ ਲਈ ਵੱਡੀ ਖ਼ਬਰ',
        'slug' => 'canada-study-visa-rules-change-punjab-students',
        'excerpt' => 'ਕੈਨੇਡਾ ਸਰਕਾਰ ਵੱਲੋਂ ਅੰਤਰਰਾਸ਼ਟਰੀ ਵਿਦਿਆਰਥੀਆਂ ਲਈ ਸਟੱਡੀ ਵੀਜ਼ਾ ਨਿਯਮਾਂ ਵਿੱਚ ਨਵੇਂ ਬਦਲਾਅ ਕੀਤੇ ਗਏ ਹਨ, ਜਿਸ ਦਾ ਸਭ ਤੋਂ ਵੱਧ ਅਸਰ ਪੰਜਾਬ ਦੇ ਵਿਦਿਆਰਥੀਆਂ ਤੇ ਪਵੇਗਾ।',
        'body' => '<p>ਕੈਨੇਡਾ ਸਰਕਾਰ ਵੱਲੋਂ ਅੰਤਰਰਾਸ਼ਟਰੀ ਵਿਦਿਆਰਥੀਆਂ ਲਈ ਸਟੱਡੀ ਵੀਜ਼ਾ ਨਿਯਮਾਂ ਵਿੱਚ ਨਵੇਂ ਬਦਲਾਅ ਕੀਤੇ ਗਏ ਹਨ। ਨਵੇਂ ਨਿਯਮਾਂ ਤਹਿਤ GIC ਫੰਡਾਂ ਦੀ ਰਕਮ ਵਧਾ ਦਿੱਤੀ ਗਈ ਹੈ, ਜਿਸ ਕਾਰਨ ਪੰਜਾਬ ਦੇ ਵਿਦਿਆਰਥੀਆਂ ਨੂੰ ਹੁਣ ਵਧੇਰੇ ਵਿੱਤੀ ਸਬੂਤ ਦਿਖਾਉਣੇ ਪੈਣਗੇ।</p><p>ਇਸ ਤੋਂ ਇਲਾਵਾ, ਕੰਮ ਕਰਨ ਦੇ ਘੰਟਿਆਂ ਸੰਬੰਧੀ ਵੀ ਨਵੇਂ ਦਿਸ਼ਾ-ਨਿਰਦੇਸ਼ ਜਾਰੀ ਕੀਤੇ ਗਏ ਹਨ। ਇਮੀਗ੍ਰੇਸ਼ਨ ਮਾਹਿਰਾਂ ਦਾ ਕਹਿਣਾ ਹੈ ਕਿ ਇਸ ਨਾਲ ਅਰਜ਼ੀਆਂ ਵਿੱਚ ਕਮੀ ਆ ਸਕਦੀ ਹੈ।</p>',
        'image' => $images[3],
        'lang' => 'pa'
    ]
];

// Hindi Translations
$articles_hi = [
    [
        'title' => 'पंजाब यूनिवर्सिटी ने भारत के टॉप 10 में फिर से जगह बनाई',
        'slug' => 'panjab-university-ranked-top-10-india-hi',
        'excerpt' => 'नवीनतम राष्ट्रीय रैंकिंग में, पंजाब विश्वविद्यालय चंडीगढ़ ने देश के शीर्ष शैक्षणिक संस्थानों में अपना स्थान सुरक्षित किया है।',
        'body' => '<p>पंजाब विश्वविद्यालय (PU) चंडीगढ़ ने नवीनतम नेशनल इंस्टीट्यूशनल रैंकिंग फ्रेमवर्क (NIRF) में शीर्ष 10 विश्वविद्यालयों में स्थान हासिल करके अपनी शैक्षणिक उत्कृष्टता की विरासत को जारी रखा है। विश्वविद्यालय ने अनुसंधान आउटपुट और शिक्षण गुणवत्ता में विशेष रूप से अच्छा स्कोर किया है।</p><p>कुलपति ने संकाय और छात्रों को बधाई देते हुए कहा कि विश्वविद्यालय का लक्ष्य अनुसंधान कार्यक्रमों के लिए बढ़े हुए धन के साथ अगले वर्ष तक शीर्ष 5 में शामिल होना है।</p>',
        'image' => $images[0],
        'lang' => 'hi'
    ]
];

$all_articles = array_merge($articles_en, $articles_pa, $articles_hi);

echo "Populating Education category...\n";

foreach ($all_articles as $art) {
    // Check if image exists in media table, if not insert
    $stmt = $db->prepare("SELECT id FROM media WHERE path = ?");
    $stmt->execute([$art['image']]);
    $media = $stmt->fetch();
    
    if (!$media) {
        $stmt = $db->prepare("INSERT INTO media (filename, path) VALUES (?, ?)");
        $stmt->execute(['unsplash_image', $art['image']]);
        $media_id = $db->lastInsertId();
    } else {
        $media_id = $media['id'];
    }

    // Insert article
    $stmt = $db->prepare("INSERT INTO articles (title, slug, body, excerpt, author_id, category_id, lang, status, priority, featured_image, seo_title, meta_desc, published_at) 
                          VALUES (:title, :slug, :body, :excerpt, :author_id, :category_id, :lang, :status, 'normal', :media_id, :seo_title, :meta_desc, NOW())");
    $stmt->execute([
        ':title' => $art['title'],
        ':slug' => $art['slug'],
        ':body' => $art['body'],
        ':excerpt' => $art['excerpt'],
        ':author_id' => $author_id,
        ':category_id' => $cat_id,
        ':lang' => $art['lang'],
        ':status' => 'published',
        ':media_id' => $media_id,
        ':seo_title' => $art['title'],
        ':meta_desc' => $art['excerpt']
    ]);
    
    echo "Inserted: " . $art['title'] . "\n";
}

echo "Done! Education category is now populated.\n";
?>
