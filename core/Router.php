<?php

namespace Core;

class Router {
    protected $routes = [];

    public function get($route, $handler) {
        $this->add('GET', $route, $handler);
    }

    public function post($route, $handler) {
        $this->add('POST', $route, $handler);
    }

    protected function add($method, $route, $handler) {
        // Convert route to regex
        // Handles {slug}, {id}, {lang} etc.
        $regex = preg_replace('/\//', '\\/', $route);
        $regex = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z0-9-]+)', $regex);
        $regex = '/^' . $regex . '$/i';

        $this->routes[$method][$regex] = $handler;
    }

    public function dispatch($method, $url) {
        $url = $this->removeQueryStringVariables($url);

        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            if (preg_match($route, $url, $matches)) {
                // Remove numeric keys from matches to keep only named parameters
                $params = array_filter($matches, function($key) {
                    return is_string($key);
                }, ARRAY_FILTER_USE_KEY);
                
                $this->executeAction($handler, $params);
                return;
            }
        }

        http_response_code(404);
        $errorView = dirname(__DIR__) . '/app/Views/errors/404.php';
        if (is_readable($errorView)) {
            require $errorView;
        } else {
            echo "404 - Page Not Found";
        }
    }

    protected function executeAction($handler, $params) {
        [$controllerName, $action] = explode('@', $handler);
        $fullControllerName = "App\\Controllers\\" . $controllerName;

        if (class_exists($fullControllerName)) {
            $controller = new $fullControllerName($params);

            if (method_exists($controller, $action)) {
                // Call the action with parameters unpacked
                call_user_func_array([$controller, $action], $params);
            } else {
                die("Method $action not found in controller $fullControllerName");
            }
        } else {
            die("Controller class $fullControllerName not found");
        }
    }

    protected function removeQueryStringVariables($url) {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}
