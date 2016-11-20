<?php
/**
 * Project: loft-php-2016
 * Author: Zorca (vs@zorca.org)
 */

namespace App;

/**
 * Class App
 * @package App
 */
class App
{
    public static function run()
    {
        $config = Config::get();
        $router = Router::get($config);
        $controllerFullName = '\\App\\Controllers\\' . $router['controllerName'];
        $controller = $controllerFullName::run();
        //$model = $controller['modelName']::run($controller);
        View::show($router);
    }
}
