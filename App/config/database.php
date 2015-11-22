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
            'server' => 'VM2012\SQLEXPRESS',
            'database' => 'vurhysin',
            'username' => 'sa',
            'password' => 'Secret#01',
        ),

        'production' => array(
            'server' => 'production\sqlServer',
            'database' => 'vurhysin',
            'username'=>'production_username',
            'password'=>'production_password',
        ),
    ),
);
