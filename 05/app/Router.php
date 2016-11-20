<?php
/**
 * Project: loft-php-2016
 * Author: Zorca (vs@zorca.org)
 */

namespace App;

/**
 * Class Router
 * @package App
 */
class Router
{
    /**
     * @return array
     */
    public static function get($config)
    {
        $controllerName = 'Page';
        $pageName = 'index';
        $actionName = 'default';
        $post = $_POST;
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($routes[1])) {
            $pageName = $routes[1];
            foreach ($config['permalinks'] as $permalink => $controller) {
                if ($permalink === $routes[1]) {
                    $controllerName = $controller;
                    if (!empty($routes[2])) {
                        $pageName = $routes[2];
                    }
                    if (!empty($routes[3])) {
                        $actionName = $routes[3];
                    }
                }
            }
        }
        return ['controllerName' => $controllerName, 'pageName' => $pageName, 'actionName' => $actionName, 'post' => $post];
    }
}
