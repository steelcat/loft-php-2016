<?php
/**
 * Project: loft-php-2016
 * Author: Zorca (vs@zorca.org)
 */

namespace App;


class View
{
    public static function show($router)
    {
        $template = mb_strtolower($router['controllerName']) . DS . $router['pageName'] . '.twig';
        if (!file_exists(TEMPLATES . $template)) {
            $template = '404.twig';
            header('HTTP/1.1 404 Not Found');
            header('Status: 404 Not Found');
        }
        $templates = new \Twig_Loader_Filesystem(TEMPLATES);
        $twig = new \Twig_Environment($templates);
        echo $twig->render($template, $router);
    }
}
