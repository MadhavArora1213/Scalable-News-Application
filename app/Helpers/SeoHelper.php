<?php

namespace App\Helpers;

use App\Models\ArticleModel;

class SeoHelper {
    /**
     * Generate NewsArticle Schema (JSON-LD)
     */
    public static function newsArticleSchema(array $article, string $lang): string {
        $schema = [
            '@context'      => 'https://schema.org',
            '@type'         => 'NewsArticle',
            'headline'      => $article['title'],
            'description'   => $article['meta_desc'] ?? '',
            'datePublished' => $article['published_at'],
            'dateModified'  => $article['updated_at'],
            'inLanguage'    => $lang,
            'author'        => ['@type' => 'Person', 'name' => $article['author_name']],
            'publisher'     => [
                '@type' => 'Organization',
                'name'  => 'ਖ਼ਬਰਾਂ News Portal',
                'logo'  => [
                    '@type' => 'ImageObject',
                    'url'   => SITE_URL . '/assets/logo.png'
                ]
            ],
            'image'         => $article['image_path'] ? SITE_URL . $article['image_path'] : '',
            'articleSection' => $article['category_name'] ?? '',
        ];
        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
    }

    /**
     * Generate Google News Sitemap
     */
    public static function generateNewsSitemap(): void {
        $articles = (new ArticleModel())->getRecentForSitemap(48); // Last 48 hours
        
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';
        
        foreach ($articles as $a) {
            $catSlug = $a['category_slug'] ?? 'news';
            $xml .= "<url><loc>" . SITE_URL . "/{$a['lang']}/{$catSlug}/{$a['slug']}</loc>";
            $xml .= '<news:news><news:publication>';
            $xml .= '<news:name>ਖ਼ਬਰਾਂ</news:name>';
            $xml .= "<news:language>{$a['lang']}</news:language></news:publication>";
            $xml .= "<news:publication_date>{$a['published_at']}</news:publication_date>";
            $xml .= "<news:title>" . htmlspecialchars($a['title']) . "</news:title></news:news></url>";
        }
        
        $xml .= '</urlset>';
        file_put_contents(PUBLIC_PATH . '/sitemap-news.xml', $xml);
        
        // Ping Google - Optional, can fail if no internet
        @file_get_contents('https://www.google.com/ping?sitemap=' . SITE_URL . '/sitemap-news.xml');
    }
}
