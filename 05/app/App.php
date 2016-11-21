<?php
namespace App;

/**
 * Class App (Singleton Pattern)
 * @package App
 */
class App
{
    protected static $instance = null;

    private static $config = null;
    private static $auth = false;
    private static $post = null;

    protected function __construct()
    {
        self::$config = (file_exists(BASE . 'config.php')) ? require BASE . 'config.php' : null;
        self::$auth = (bool) Session::get('id');
        self::$post = $_POST;
    }

    public static function getConfig($key)
    {
        if (!empty(self::$config[$key])) {
            return self::$config[$key];
        }
        return null;
    }

    public static function isAuth()
    {
        return self::$auth;
    }

    public static function getPost($key)
    {
        if (!empty(self::$post[$key])) {
            return self::$post[$key];
        }
        return null;
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
