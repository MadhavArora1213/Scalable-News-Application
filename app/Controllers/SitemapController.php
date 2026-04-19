<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;

class SitemapController extends BaseController {
    
    /**
     * Main Sitemap Index
     */
    public function index() {
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        ?>
        <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <sitemap><loc><?= SITE_URL ?>/sitemap-pa.xml</loc></sitemap>
            <sitemap><loc><?= SITE_URL ?>/sitemap-hi.xml</loc></sitemap>
            <sitemap><loc><?= SITE_URL ?>/sitemap-en.xml</loc></sitemap>
            <sitemap><loc><?= SITE_URL ?>/sitemap-news.xml</loc></sitemap>
        </sitemapindex>
        <?php
    }

    /**
     * Language specific Sitemap
     */
    public function lang(string $lang) {
        $model = new ArticleModel();
        $articles = $model->getLatest($lang, 1000);
        
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <url>
                <loc><?= SITE_URL ?>/<?= $lang ?></loc>
                <changefreq>hourly</changefreq>
                <priority>1.0</priority>
            </url>
            <?php foreach($articles as $a): ?>
            <url>
                <loc><?= SITE_URL ?>/<?= $lang ?>/<?= $a['category_slug'] ?? 'news' ?>/<?= $a['slug'] ?></loc>
                <lastmod><?= date('c', strtotime($a['updated_at'] ?? $a['published_at'])) ?></lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.8</priority>
            </url>
            <?php endforeach; ?>
        </urlset>
        <?php
    }

    /**
     * Google News Specific Sitemap (Last 48 hours only)
     * Requirement: Blueprint 10.2
     */
    public function news() {
        $model = new ArticleModel();
        // getRecentForSitemap was already in ArticleModel! (Last 48h)
        $articles = $model->getRecentForSitemap(48);
        
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
            <?php foreach($articles as $a): ?>
            <url>
                <loc><?= SITE_URL ?>/<?= $a['lang'] ?>/<?= $a['category_slug'] ?? 'news' ?>/<?= $a['slug'] ?></loc>
                <news:news>
                    <news:publication>
                        <news:name>The Khabran</news:name>
                        <news:language><?= $a['lang'] ?></news:language>
                    </news:publication>
                    <news:publication_date><?= date('c', strtotime($a['published_at'])) ?></news:publication_date>
                    <news:title><?= htmlspecialchars($a['title']) ?></news:title>
                </news:news>
            </url>
            <?php endforeach; ?>
        </urlset>
        <?php
    }
}
