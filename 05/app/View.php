<?php
namespace App;

class View
{
    public static function show($pageName, $pageDataInput = [])
    {
        $params = [];
        $pageDataOutput = [];
        if (APP_CACHE) {
            $params += ['cache' => CACHE];
        }
        if (APP_DEBUG) {
            $params += ['debug' => true];
        }
        $template = $pageName . '.twig';
        $templates = new \Twig_Loader_Filesystem(TEMPLATES);
        $twig = new \Twig_Environment($templates, $params);
        $twig->addExtension(new \Twig_Extension_Debug());
        $pageDataOutput += $pageDataInput;
        echo $twig->render($template, $pageDataOutput);
    }
}
