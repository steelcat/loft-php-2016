<?php
namespace App;

// Получаем разделитель директорий
define('DS', '/');

// Получаем базовую папку сайта
define('BASE', str_replace(DIRECTORY_SEPARATOR, DS, __DIR__ . DS));

// Определяем папку для аплоада файлов
define('UPLOAD_DIR', BASE . 'images' . DS);

// Определяем папки для шаблонов и кеша Twig
define('TEMPLATES', BASE . 'templates' . DS);
define('CACHE', BASE . 'cache' . DS);

// Загружаем библиотеки через Composer
require BASE . 'vendor' . DS . 'autoload.php';

// Устанавливаем режим дебага
define('APP_DEBUG', true);

// Устанавливаем режим кеширования
define('APP_CACHE', false);

// Запускаем приложение
App::run();
