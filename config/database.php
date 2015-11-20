<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Define the default connection.
    |--------------------------------------------------------------------------
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | The available connections.
    |--------------------------------------------------------------------------
    */

    'connections' => array(

        'local' => array(
            'server' => 'VM2012\SQLEXPRESS',
            'connection' => array(
                'Database'=>'sqlsrv',
                'UID'=>'sa',
                'PWD'=>'Secret#01',
            ),
        ),
    ),
);
