<?php
namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'shop',
    'username' => 'root',
    'password' => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$api = new ProductsAPI($_SERVER['REQUEST_URI']);

echo $api->processAPI();
