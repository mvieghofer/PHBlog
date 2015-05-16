<?php

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule();
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'dd5926.kasserver.com',
    'username' => 'd01deb5e',
    'password' => 'PHBlogPassword',
    'database' => 'd01deb5e',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->bootEloquent();
?>