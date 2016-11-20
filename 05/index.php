<?php
// Получаем разделитель директорий
define('DS', '/');
// Получаем базовую папку сайта
define('BASE', str_replace(DIRECTORY_SEPARATOR, DS, __DIR__ . DS));
// Определяем папки для шаблонов и кеша Twig
define('TEMPLATES', BASE . 'templates' . DS);
define('CACHE', BASE . 'cache' . DS);
// Загружаем библиотеки через Composer
require BASE . 'vendor' . DS . 'autoload.php';
// Запускаем приложение
App\App::run();
