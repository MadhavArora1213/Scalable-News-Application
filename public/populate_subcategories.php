<?php
require_once __DIR__ . '/../core/Database.php';
use Core\Database;

$db = Database::getInstance();

// 1. Get all categories and subcategories
$categories = $db->query("SELECT id, slug, name_en FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// 2. Sample data for seeding
$titles = [
    "en" => [
        "Major developments reported in {cat} sector today",
        "How {cat} is shaping the future of Punjab",
        "Expert analysis: The impact of recent shifts in {cat}",
        "Ground report: Challenges and opportunities in {cat}",
        "New policy announced for {cat} to boost growth"
    ],
    "pa" => [
        "{cat} ਖੇਤਰ ਵਿੱਚ ਅੱਜ ਵੱਡੀਆਂ ਤਬਦੀਲੀਆਂ ਦੇਖਣ ਨੂੰ ਮਿਲੀਆਂ",
        "{cat} ਪੰਜਾਬ ਦੇ ਭਵਿੱਖ ਨੂੰ ਕਿਵੇਂ ਨਵਾਂ ਰੂਪ ਦੇ ਰਿਹਾ ਹੈ",
        "ਮਾਹਿਰਾਂ ਦਾ ਵਿਸ਼ਲੇਸ਼ਣ: {cat} ਵਿੱਚ ਤਾਜ਼ਾ ਤਬਦੀਲੀਆਂ ਦਾ ਪ੍ਰਭਾਵ",
        "ਗਰਾਊਂਡ ਰਿਪੋਰਟ: {cat} ਵਿੱਚ ਚੁਣੌਤੀਆਂ ਅਤੇ ਮੌਕੇ",
        "ਵਿਕਾਸ ਨੂੰ ਹੁਲਾਰਾ ਦੇਣ ਲਈ {cat} ਲਈ ਨਵੀਂ ਨੀਤੀ ਦਾ ਐਲਾਨ"
    ],
    "hi" => [
        "{cat} क्षेत्र में आज बड़े घटनाक्रम दर्ज किए गए",
        "{cat} पंजाब के भविष्य ਨੂੰ कैसे आकार दे रहा है",
        "विशेषज्ञ विश्लेषण: {cat} में हालिया बदलावों का प्रभाव",
        "ग्राउंड रिपोर्ट: {cat} में चुनौतियाँ और अवसर",
        "{cat} के विकास को बढ़ावा देने के लिए नई नीति की घोषणा"
    ]
];

$excerpts = [
    "en" => "A detailed look into the latest trends and updates from the {cat} sector in Punjab and beyond.",
    "pa" => "ਪੰਜਾਬ ਅਤੇ ਇਸ ਤੋਂ ਬਾਹਰ ਦੇ {cat} ਖੇਤਰ ਦੇ ਤਾਜ਼ਾ ਰੁਝਾਨਾਂ ਅਤੇ ਅਪਡੇਟਾਂ 'ਤੇ ਇੱਕ ਵਿਸਤ੍ਰਿਤ ਨਜ਼ਰ।",
    "hi" => "पंजाब और उससे आगे के {cat} क्षेत्र के नवीनतम रुझानों और अपडेट पर एक विस्तृत नज़र।"
];

// 3. For each category, if it has fewer than 5 articles, add some
foreach ($categories as $cat) {
    foreach (['en', 'pa', 'hi'] as $lang) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM articles WHERE category_id = ? AND lang = ?");
        $stmt->execute([$cat['id'], $lang]);
        $count = $stmt->fetchColumn();

        if ($count < 3) {
            echo "Seeding articles for {$cat['name_en']} ($lang)...\n";
            for ($i = 0; $i < 4; $i++) {
                $titleTemplate = $titles[$lang][array_rand($titles[$lang])];
                $title = str_replace("{cat}", $cat['name_en'], $titleTemplate);
                $slug = $cat['slug'] . '-' . strtolower(str_replace(' ', '-', substr($title, 0, 30))) . '-' . rand(100, 999);
                $excerpt = str_replace("{cat}", $cat['name_en'], $excerpts[$lang]);
                $body = "<p>" . $excerpt . "</p><p>This is a detailed ground report covering the latest developments in " . $cat['name_en'] . ". Our team of journalists traveled across various districts to bring you this exclusive analysis.</p><p>Key points covered include current challenges, government initiatives, and future projections for the sector.</p>";
                
                $stmt = $db->prepare("INSERT INTO articles (title, slug, body, excerpt, author_id, category_id, lang, status, priority, published_at) 
                                     VALUES (?, ?, ?, ?, 1, ?, ?, 'published', 'normal', ?)");
                $stmt->execute([
                    $title,
                    $slug,
                    $body,
                    $excerpt,
                    $cat['id'],
                    $lang,
                    date('Y-m-d H:i:s', strtotime("-$i days"))
                ]);
            }
        }
    }
}

echo "Seeding complete! All subcategories now have articles.\n";
