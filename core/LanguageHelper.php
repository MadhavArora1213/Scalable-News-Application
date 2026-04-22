<?php

namespace Core;

class LanguageHelper {
    const SUPPORTED = ['pa', 'hi', 'en'];
    const DEFAULT   = 'pa';

    /**
     * Detect the language for the current request
     */
    public static function detect(): string {
        // 1. URL prefix takes priority
        $url = $_SERVER['REQUEST_URI'];
        // Remove base path if applicable (e.g., /News_Website/)
        // For simplicity, we assume the server root points to public/
        
        foreach (self::SUPPORTED as $lang) {
            if (str_contains($url, '/' . $lang . '/') || str_ends_with($url, '/' . $lang)) {
                return $lang;
            }
        }

        // 2. Cookie preference
        if (!empty($_COOKIE['lang']) && in_array($_COOKIE['lang'], self::SUPPORTED)) {
            return $_COOKIE['lang'];
        }

        // 3. Browser Accept-Language header
        $accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
        if (str_contains($accept, 'pa')) return 'pa';
        if (str_contains($accept, 'hi')) return 'hi';
        if (str_contains($accept, 'en')) return 'en';

        return self::DEFAULT;
    }

    /**
     * Load translation strings for a language
     */
    public static function getTranslations(string $lang): array {
        $file = __DIR__ . "/../app/lang/{$lang}.php";
        if (is_readable($file)) {
            return require $file;
        }
        return [];
    }

    /**
     * Get trilingual date string
     */
    public static function getFormattedDate(string $lang): string {
        $days = [
            'pa' => ['à¨à¨¤à¨µà¨¾à¨°', 'à¨¸à©‹à¨®à¨µà¨¾à¨°', 'à¨®à©°à¨—à¨²à¨µà¨¾à¨°', 'à¨¬à©à©±à¨§à¨µà¨¾à¨°', 'à¨µà©€à¨°à¨µà¨¾à¨°', 'à¨¸à¨¼à©à©±à¨•à¨°à¨µà¨¾à¨°', 'à¨¸à¨¼à¨¨à¨¿à©±à¨šà¨°à¨µà¨¾à¨°'],
            'hi' => ['à¤°à¤µà¤¿à¤µà¤¾à¤°', 'à¤¸à¥‹à¤®à¤µà¤¾à¤°', 'à¤®à¤‚à¤—à¤²à¤µà¤¾à¤°', 'à¤¬à¥à¤§à¤µà¤¾à¤°', 'à¤—à¥à¤°à¥à¤µà¤¾à¤°', 'à¤¶à¥à¤•à¥à¤°à¤µà¤¾à¤°', 'à¤¶à¤¨à¤¿à¤µà¤¾à¤°'],
            'en' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        ];
        $months = [
            'pa' => ['à¨œà¨¨à¨µà¨°à©€', 'à¨«à¨¼à¨°à¨µà¨°à©€', 'à¨®à¨¾à¨°à¨š', 'à¨…à¨ªà©à¨°à©ˆà¨²', 'à¨®à¨ˆ', 'à¨œà©‚à¨¨', 'à¨œà©à¨²à¨¾à¨ˆ', 'à¨…à¨—à¨¸à¨¤', 'à¨¸à¨¤à©°à¨¬à¨°', 'à¨…à¨•à¨¤à©‚à¨¬à¨°', 'à¨¨à¨µà©°à¨¬à¨°', 'à¨¦à¨¸à©°à¨¬à¨°'],
            'hi' => ['à¤œà¤¨à¤µà¤°à¥€', 'à¤«à¤°à¤µà¤°à¥€', 'à¤®à¤¾à¤°à¥à¤š', 'à¤…à¤ªà¥à¤°à¥ˆà¤²', 'à¤®à¤ˆ', 'à¤œà¥‚à¤¨', 'à¤œà¥à¤²à¤¾à¤ˆ', 'à¤…à¤—à¤¸à¥à¤¤', 'à¤¸à¤¿à¤¤à¤‚à¤¬à¤°', 'à¤…à¤•à¥à¤Ÿà¥‚à¤¬à¤°', 'à¤¨à¤µà¤‚à¤¬à¤°', 'à¤¦à¤¿à¤¸à¤‚à¤¬à¤°']
        ];

        $w = date('w');
        $m = date('n') - 1;
        $d = date('j');
        $y = date('Y');

        if ($lang === 'en') return date('l, F d, Y');
        
        $dayName = $days[$lang][$w];
        $monthName = $months[$lang][$m];
        
        return "$dayName, $d $monthName $y";
    }
}
