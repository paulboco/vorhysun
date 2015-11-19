<?php

namespace Library\Sqlsrv;

use Library\Config;

/**
* Connect to a Sql Server resource.
*/
class SqlsrvConnector
{
    /**
     * Create a new SqlsrvConnector
     *
     * @return void
     */
    public function getConnection()
    {
        $connection = sqlsrv_connect(
            Config::get('database.serverName'),
            Config::get('database.connectionInfo')
        );

        if ($connection === false) {
            throw new Exception(
                "Could not connection to database{$connectionInfo['Database']}"
                . " on server{$serverName}"
            );
        }

        return $connection;
    }
}