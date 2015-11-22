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
            'connection' => array(
                'Database'=>'sqlsrv',
                'UID'=>'sa',
                'PWD'=>'Secret#01',
            ),
        ),

        'production' => array(
            'server' => 'Verizon\SqlServer',
            'connection' => array(
                'Database'=>'sqlsrv',
                'UID'=>'verizon_username',
                'PWD'=>'verizon_password',
            ),
        ),
    ),
);
