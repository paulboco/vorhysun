<?php

/*
|--------------------------------------------------------------------------
| Use Illuminate's Capsule Manager to boot Eloquent.
|--------------------------------------------------------------------------
*/

require BASE_PATH . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Library\Config;

$capsule = new Capsule;
$capsule->addConnection(
    Config::get('database.connections.' . Config::get('database.default'))
);
$capsule->bootEloquent();

unset($capsule);
