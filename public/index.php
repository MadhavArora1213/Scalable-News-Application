<?php

require_once dirname(__DIR__) . '/config/app.php';

/**
 * Autoloader (Temporary replacement for Composer autoload)
 */
spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
});

/**
 * Routing
 */
$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$router = require_once dirname(__DIR__) . '/config/routes.php';

$router->dispatch($method, $url);
