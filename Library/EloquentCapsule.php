<?php

namespace Library;

use Illuminate\Database\Capsule\Manager as Capsule;
use Library\Config;

class EloquentCapsule
{
    public static function boot()
    {
        require BASE_PATH . '/vendor/autoload.php';

        $capsule = new Capsule;
        $capsule->addConnection(
            Config::get('database.connections.' . Config::get('database.default'))
        );
        $capsule->bootEloquent();
    }
}
