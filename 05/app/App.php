<?php
namespace App;

class App
{
    protected static $instance = null;

    private static $post = null;
    private static $error = null;

    protected function __construct()
    {
        self::$post = $_POST;

        $routerResponse = Router::get();
        $controller = '\\App\\Controllers\\' . ucfirst($routerResponse['controllerName']) . 'Controller';
        if (class_exists($controller)) {
            new $controller($routerResponse);
        }
    }

    public static function getPost($key)
    {
        if (!empty(self::$post[$key])) {
            return self::$post[$key];
        }
        return null;
    }

    public static function existsPost($key)
    {
        if (!empty(self::$post[$key])) {
            return isset(self::$post[$key]);
        }
        return false;
    }


    public static function getPostAll()
    {
        if (!empty(self::$post)) {
            return self::$post;
        }
        return null;
    }

    public static function getError()
    {
        return self::$error;
    }

    public static function setError($error)
    {
        self::$error = $error;
    }

    public static function run()
    {
        if (!isset(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }
}
