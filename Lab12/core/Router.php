<?php
class Router {
    public static function run() {
        $controllerName = $_GET['c'] ?? 'employee';
        $actionName = $_GET['a'] ?? 'index';

        $controllerClass = ucfirst($controllerName) . "Controller";
        $controllerFile = __DIR__ . "/../app/Controllers/" . $controllerClass . ".php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerClass();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                echo "Action không tồn tại!";
            }
        } else {
            echo "Controller không tồn tại!";
        }
    }
}