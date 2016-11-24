<?php
namespace App;

class Router
{
    public static function get()
    {
        $controllerName = 'Page';
        $actionName = 'index';
        $routes = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        if (!empty($routes[0])) {
            $controllerName = $routes[0];
        }
        if (!empty($routes[1])) {
            $actionName = $routes[1];
        }
        return ['controllerName' => $controllerName, 'actionName' => $actionName];
    }
}
