<?php

$router = new Core\Router();

/**
 * Admin Panel Routes
 */
$router->get('admin', 'AuthController@loginForm');
$router->get('admin/login', 'AuthController@loginForm');
$router->post('admin/login', 'AuthController@login');
$router->get('admin/logout', 'AuthController@logout');

$router->get('admin/dashboard', 'DashboardController@index');

// Articles Management
$router->get('admin/articles', 'AdminArticleController@index');
$router->get('admin/articles/new', 'AdminArticleController@create');
$router->post('admin/articles/store', 'AdminArticleController@store');
$router->get('admin/articles/{id}/edit', 'AdminArticleController@edit');
$router->post('admin/articles/{id}/update', 'AdminArticleController@update');
$router->post('admin/articles/{id}/delete', 'AdminArticleController@delete');

// Category Management
$router->get('admin/categories', 'CategoryAdminController@index');
$router->get('admin/categories/new', 'CategoryAdminController@create');
$router->post('admin/categories/store', 'CategoryAdminController@store');
$router->get('admin/categories/{id}/edit', 'CategoryAdminController@edit');
$router->post('admin/categories/{id}/update', 'CategoryAdminController@update');
$router->post('admin/categories/{id}/delete', 'CategoryAdminController@delete');

// Tag Management
$router->get('admin/tags', 'AdminTagController@index');
$router->get('admin/tags/new', 'AdminTagController@create');
$router->post('admin/tags/store', 'AdminTagController@store');
$router->get('admin/tags/{id}/edit', 'AdminTagController@edit');
$router->post('admin/tags/{id}/update', 'AdminTagController@update');
$router->post('admin/tags/{id}/delete', 'AdminTagController@delete');

// Subcategory Management
$router->get('admin/subcategories', 'AdminSubcategoryController@index');
$router->get('admin/subcategories/new', 'AdminSubcategoryController@create');
$router->post('admin/subcategories/store', 'AdminSubcategoryController@store');
$router->get('admin/subcategories/{id}/edit', 'AdminSubcategoryController@edit');
$router->post('admin/subcategories/{id}/update', 'AdminSubcategoryController@update');
$router->post('admin/subcategories/{id}/delete', 'AdminSubcategoryController@delete');

// Roles & Permissions
$router->get('admin/roles', 'RolesController@index');

// Catch-all for other admin routes to prevent falling through to public routes
$router->get('admin/{any}', 'AuthController@loginForm');

/**
 * Public Frontend Routes
 */
$router->get('', 'HomeController@index');
$router->get('{lang}', 'HomeController@lang');

// Specific Lang Routes
$router->get('{lang}/district/{district}', 'DistrictController@index');
$router->get('{lang}/search', 'SearchController@search');
$router->get('{lang}/author/{name}', 'AuthorController@show');
$router->get('{lang}/tag/{tag}', 'TagController@index');

// Generic News Routes
$router->get('{lang}/{category}', 'CategoryController@index');
$router->get('{lang}/{category}/{slug}', 'ArticleController@show');

return $router;
