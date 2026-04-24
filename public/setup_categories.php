<?php
require_once __DIR__ . '/../core/Database.php';

try {
    $db = \Core\Database::getInstance();
    
    // Primary categories
    $categories = [
        ['slug' => 'politics', 'pa' => 'ਸਿਆਸਤ', 'hi' => 'राजनीति', 'en' => 'Politics'],
        ['slug' => 'economy-business', 'pa' => 'ਆਰਥਿਕਤਾ', 'hi' => 'अर्थव्यवस्था', 'en' => 'Economy & Business'],
        ['slug' => 'ground-reports', 'pa' => 'ਜ਼ਮੀਨੀ ਰਿਪੋਰਟਾਂ', 'hi' => 'ग्राउंड रिपोर्ट', 'en' => 'Ground Reports'],
        ['slug' => 'crime-law', 'pa' => 'ਕਾਨੂੰਨ ਅਤੇ ਅਪਰਾਧ', 'hi' => 'अपराध और कानून', 'en' => 'Crime & Law'],
        ['slug' => 'education', 'pa' => 'ਸਿੱਖਿਆ', 'hi' => 'शिक्षा', 'en' => 'Education'],
        ['slug' => 'health', 'pa' => 'ਸਿਹਤ', 'hi' => 'स्वास्थ्य', 'en' => 'Health'],
        ['slug' => 'sports-culture', 'pa' => 'ਖੇਡਾਂ ਅਤੇ ਸੱਭਿਆਚਾਰ', 'hi' => 'खेल और संस्कृति', 'en' => 'Sports & Culture'],
        ['slug' => 'opinion-analysis', 'pa' => 'ਵਿਚਾਰ', 'hi' => 'विचार', 'en' => 'Opinion & Analysis'],
    ];

    $subcategories = [
        'politics' => [
            ['slug' => 'punjab-govt', 'pa' => 'ਪੰਜਾਬ ਸਰਕਾਰ', 'hi' => 'पंजाब सरकार', 'en' => 'Punjab Government & Cabinet'],
            ['slug' => 'parliament', 'pa' => 'ਲੋਕ ਸਭਾ ਅਤੇ ਰਾਜ ਸਭਾ', 'hi' => 'लोकसभा और राज्यसभा', 'en' => 'Lok Sabha & Rajya Sabha'],
            ['slug' => 'political-parties', 'pa' => 'ਸਿਆਸੀ ਪਾਰਟੀਆਂ', 'hi' => 'राजनीतिक दल', 'en' => 'Political Parties (AAP, Congress, SAD, BJP)'],
            ['slug' => 'local-elections', 'pa' => 'ਸਥਾਨਕ ਚੋਣਾਂ', 'hi' => 'स्थानीय चुनाव', 'en' => 'Municipal & Panchayat Elections'],
            ['slug' => 'political-analysis', 'pa' => 'ਸਿਆਸੀ ਵਿਸ਼ਲੇਸ਼ਣ', 'hi' => 'राजनीतिक विश्लेषण', 'en' => 'Political Analysis'],
            ['slug' => 'governor-office', 'pa' => 'ਰਾਜਪਾਲ ਦਫ਼ਤਰ', 'hi' => 'राज्यपाल कार्यालय', 'en' => 'Governor Office & Raj Bhavan'],
        ],
        'economy-business' => [
            ['slug' => 'agriculture', 'pa' => 'ਖੇਤੀਬਾੜੀ', 'hi' => 'कृषि', 'en' => 'Agriculture (MSP, Mandi, Crop)'],
            ['slug' => 'industry', 'pa' => 'ਉਦਯੋਗ', 'hi' => 'उद्योग', 'en' => 'Industry & Manufacturing'],
            ['slug' => 'jobs', 'pa' => 'ਰੁਜ਼ਗਾਰ', 'hi' => 'रोजगार', 'en' => 'Jobs & Employment'],
            ['slug' => 'budget', 'pa' => 'ਬਜਟ', 'hi' => 'बजट', 'en' => 'Budget (Union & State)'],
            ['slug' => 'markets', 'pa' => 'ਬਾਜ਼ਾਰ', 'hi' => 'बाजार', 'en' => 'Markets & Commodities'],
            ['slug' => 'startups', 'pa' => 'ਸਟਾਰਟਅੱਪ', 'hi' => 'स्टार्टअप', 'en' => 'Startups & MSME'],
        ],
        'ground-reports' => [
            ['slug' => 'village-reports', 'pa' => 'ਪਿੰਡਾਂ ਦੀਆਂ ਰਿਪੋਰਟਾਂ', 'hi' => 'गांव की रिपोर्ट', 'en' => 'Village-level Reporting'],
            ['slug' => 'farmer-issues', 'pa' => 'ਕਿਸਾਨੀ ਮੁੱਦੇ', 'hi' => 'किसानों के मुद्दे', 'en' => 'Farmer Distress & Environment'],
            ['slug' => 'migration', 'pa' => 'ਪਰਵਾਸ', 'hi' => 'प्रवास', 'en' => 'Migration & Youth'],
            ['slug' => 'border-areas', 'pa' => 'ਸਰਹੱਦੀ ਖੇਤਰ', 'hi' => 'सीमावर्ती क्षेत्र', 'en' => 'Border Areas'],
            ['slug' => 'marginalized-communities', 'pa' => 'ਦੱਬੇ-ਕੁਚਲੇ ਭਾਈਚਾਰੇ', 'hi' => 'हाशिए के समुदाय', 'en' => 'Tribal & Dalit Communities'],
        ],
        'crime-law' => [
            ['slug' => 'drug-crisis', 'pa' => 'ਨਸ਼ਾ ਸੰਕਟ', 'hi' => 'नशा संकट', 'en' => 'Drug Crisis & Rehab'],
            ['slug' => 'gangster-network', 'pa' => 'ਗੈਂਗਸਟਰ ਨੈੱਟਵਰਕ', 'hi' => 'गैंगस्टर नेटवर्क', 'en' => 'Gangster Network'],
            ['slug' => 'punjab-police', 'pa' => 'ਪੰਜਾਬ ਪੁਲਿਸ', 'hi' => 'पंजाब पुलिस', 'en' => 'Punjab Police'],
            ['slug' => 'courts', 'pa' => 'ਅਦਾਲਤਾਂ', 'hi' => 'अदालतें', 'en' => 'Courts & Judiciary'],
            ['slug' => 'cyber-crime', 'pa' => 'ਸਾਈਬਰ ਅਪਰਾਧ', 'hi' => 'साइबर अपराध', 'en' => 'Cyber Crime & Fraud'],
        ],
        'education' => [
            ['slug' => 'school-boards', 'pa' => 'ਸਕੂਲ ਬੋਰਡ', 'hi' => 'स्कूल बोर्ड', 'en' => 'PSEB & School Boards'],
            ['slug' => 'universities', 'pa' => 'ਯੂਨੀਵਰਸਿਟੀਆਂ', 'hi' => 'विश्वविद्यालय', 'en' => 'Universities'],
            ['slug' => 'govt-schools', 'pa' => 'ਸਰਕਾਰੀ ਸਕੂਲ', 'hi' => 'सरकारी स्कूल', 'en' => 'Govt School Infrastructure'],
            ['slug' => 'competitive-exams', 'pa' => 'ਮੁਕਾਬਲੇ ਦੀਆਂ ਪ੍ਰੀਖਿਆਵਾਂ', 'hi' => 'प्रतियोगी परीक्षाएं', 'en' => 'Competitive Exams'],
            ['slug' => 'study-visa', 'pa' => 'ਸਟੱਡੀ ਵੀਜ਼ਾ', 'hi' => 'स्टडी वीजा', 'en' => 'Study Visa News'],
            ['slug' => 'private-schools', 'pa' => 'ਪ੍ਰਾਈਵੇਟ ਸਕੂਲ', 'hi' => 'निजी स्कूल', 'en' => 'Private Schools Regulation'],
        ],
        'health' => [
            ['slug' => 'health-schemes', 'pa' => 'ਸਿਹਤ ਸਕੀਮਾਂ', 'hi' => 'स्वास्थ्य योजनाएं', 'en' => 'Govt Health Schemes'],
            ['slug' => 'hospitals', 'pa' => 'ਹਸਪਤਾਲ', 'hi' => 'अस्पताल', 'en' => 'Govt Hospitals'],
            ['slug' => 'de-addiction', 'pa' => 'ਨਸ਼ਾ ਛੁਡਾਊ', 'hi' => 'नशा मुक्ति', 'en' => 'De-addiction Centres'],
            ['slug' => 'mental-health', 'pa' => 'ਮਾਨਸਿਕ ਸਿਹਤ', 'hi' => 'मानसिक स्वास्थ्य', 'en' => 'Mental Health'],
            ['slug' => 'environment-health', 'pa' => 'ਵਾਤਾਵਰਣ ਸਿਹਤ', 'hi' => 'पर्यावरण स्वास्थ्य', 'en' => 'Water Contamination & Cancer'],
        ],
        'sports-culture' => [
            ['slug' => 'kabaddi', 'pa' => 'ਕਬੱਡੀ', 'hi' => 'कबड्डी', 'en' => 'Kabaddi'],
            ['slug' => 'cricket', 'pa' => 'ਕ੍ਰਿਕਟ', 'hi' => 'क्रिकेट', 'en' => 'Cricket'],
            ['slug' => 'punjabi-cinema', 'pa' => 'ਪੰਜਾਬੀ ਸਿਨੇਮਾ', 'hi' => 'पंजाबी सिनेमा', 'en' => 'Punjabi Cinema'],
            ['slug' => 'punjabi-music', 'pa' => 'ਪੰਜਾਬੀ ਸੰਗੀਤ', 'hi' => 'पंजाबी संगीत', 'en' => 'Punjabi Music'],
            ['slug' => 'festivals', 'pa' => 'ਤਿਉਹਾਰ', 'hi' => 'त्योहार', 'en' => 'Festivals'],
            ['slug' => 'heritage', 'pa' => 'ਵਿਰਾਸਤ', 'hi' => 'विरासत', 'en' => 'Cultural Heritage'],
        ],
        'opinion-analysis' => [
            ['slug' => 'editorial', 'pa' => 'ਸੰਪਾਦਕੀ', 'hi' => 'संपादकीय', 'en' => 'Editorial'],
            ['slug' => 'guest-columns', 'pa' => 'ਮਹਿਮਾਨ ਕਾਲਮ', 'hi' => 'अतिथि कॉलम', 'en' => 'Guest Columns'],
            ['slug' => 'quick-edits', 'pa' => 'ਸੰਖੇਪ ਵਿਚਾਰ', 'hi' => 'संक्षिप्त विचार', 'en' => '50-Word Edits'],
            ['slug' => 'fact-check', 'pa' => 'ਤੱਥ ਚੈੱਕ', 'hi' => 'फैक्ट चेक', 'en' => 'Fact Check'],
            ['slug' => 'reader-voice', 'pa' => 'ਪਾਠਕਾਂ ਦੀ ਆਵਾਜ਼', 'hi' => 'पाठकों की आवाज', 'en' => 'Reader Voice'],
        ],
    ];

    echo "Starting categories insertion...\n";

    $stmtInsert = $db->prepare("INSERT INTO categories (name_pa, name_hi, name_en, slug, parent_id) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE name_pa=VALUES(name_pa), name_hi=VALUES(name_hi), name_en=VALUES(name_en), parent_id=VALUES(parent_id)");
    $stmtSelect = $db->prepare("SELECT id FROM categories WHERE slug = ?");

    foreach ($categories as $cat) {
        $stmtInsert->execute([$cat['pa'], $cat['hi'], $cat['en'], $cat['slug'], null]);
        echo "Inserted Primary Category: " . $cat['en'] . "\n";
        
        $stmtSelect->execute([$cat['slug']]);
        $parentId = $stmtSelect->fetchColumn();

        if (isset($subcategories[$cat['slug']])) {
            foreach ($subcategories[$cat['slug']] as $sub) {
                $stmtInsert->execute([$sub['pa'], $sub['hi'], $sub['en'], $sub['slug'], $parentId]);
                echo "  Inserted Subcategory: " . $sub['en'] . "\n";
            }
        }
    }

    echo "Categories insertion completed successfully!\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
