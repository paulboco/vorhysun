<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Define the default database connection.
    |--------------------------------------------------------------------------
    */

    'default' => 'development',

    /*
    |--------------------------------------------------------------------------
    | The available connections.
    |--------------------------------------------------------------------------
    */

    'connections' => array(

        'development' => array(
            'driver'    => 'sqlsrv',
            'host'      => 'VM2012\SQLEXPRESS',
            'database'  => 'vorhysun',
            'username'  => 'sa',
            'password'  => 'Secret#01',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ),

        'production' => array(
            'driver'    => 'sqlsrv',
            'host'      => 'production_server',
            'database'  => 'vorhysun',
            'username'  => 'production_username',
            'password'  => 'production_password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ),
    ),
);
