<?php

$router = new Core\Router();

/**
 * API Routes (Must come first to avoid dynamic route collision)
 */
$router->get('api/v1/articles', 'ApiController@articles');

/**
 * Admin Panel Routes
 */
$router->get('admin', 'AuthController@loginForm');
$router->get('admin/login', 'AuthController@loginForm');
$router->post('admin/login', 'AuthController@login');
$router->get('admin/logout', 'AuthController@logout');

$router->get('admin/dashboard', 'DashboardController@index');

$router->get('admin/articles', 'AdminArticleController@index');
$router->get('admin/articles/new', 'AdminArticleController@create');
$router->post('admin/articles/store', 'AdminArticleController@store');
$router->get('admin/articles/{id}/edit', 'AdminArticleController@edit');
$router->post('admin/articles/{id}/update', 'AdminArticleController@update');
$router->post('admin/articles/{id}/delete', 'AdminArticleController@delete');

$router->get('admin/media', 'MediaController@index');
$router->post('admin/media/upload', 'MediaController@upload');

$router->get('admin/categories', 'CategoryAdminController@index');
$router->post('admin/categories/store', 'CategoryAdminController@store');
$router->get('admin/users', 'UserController@index');
$router->get('admin/comments', 'CommentAdminController@index');
$router->get('admin/subscribers', 'SubscriberController@index');
$router->get('admin/subscribers/delete/{id}', 'SubscriberController@delete');
$router->post('admin/subscribers/broadcast', 'SubscriberController@broadcast');

$router->get('admin/homepage', 'HomepageController@editor');
$router->post('admin/homepage/save', 'HomepageController@save');
$router->get('admin/breaking', 'BreakingController@index');

$router->get('admin/seo', 'SeoAdminController@index');
$router->post('admin/seo/update', 'SeoAdminController@update');
$router->get('admin/ads', 'AdController@index');
$router->get('admin/analytics', 'AnalyticsController@index');
$router->get('admin/settings', 'SettingsController@index');

/**
 * Public Frontend Routes
 */
$router->get('', 'HomeController@index');
$router->get('{lang}', 'HomeController@lang');

// Specific Lang Routes (Must come before generic category/article)
$router->get('{lang}/district/{district}', 'DistrictController@index');
$router->get('{lang}/search', 'SearchController@search');
$router->get('{lang}/author/{name}', 'AuthorController@show');
$router->get('{lang}/tag/{tag}', 'TagController@index');

// Generic News Routes
$router->get('{lang}/{category}', 'CategoryController@index');
$router->get('{lang}/{category}/{slug}', 'ArticleController@show');

// Sitemaps & RSS
$router->get('sitemap.xml', 'SitemapController@index');
$router->get('sitemap-{lang}.xml', 'SitemapController@lang');
$router->get('sitemap-news.xml', 'SitemapController@news');
$router->get('feed/{lang}', 'RssController@feed');
$router->get('robots.txt', 'SeoController@robots');

$router->post('subscribe', 'SubscribeController@store');
$router->post('comments', 'CommentController@store');

// End of routes
return $router;
