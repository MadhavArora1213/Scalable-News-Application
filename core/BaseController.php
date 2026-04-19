<?php

namespace Core;

abstract class BaseController {
    protected $route_params = [];

    public function __construct($route_params) {
        $this->route_params = $route_params;
    }

    protected function render($view, $args = []) {
        extract($args, EXTR_SKIP);

        $file = __DIR__ . "/../app/Views/$view.php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
}
