<?php

namespace Library;

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
        $serverName = Config::get('database.serverName');
        $connectionInfo = Config::get('database.connectionInfo');

        $connection = sqlsrv_connect($serverName, $connectionInfo);

        if ($connection === false) {
            throw new Exception(
                "Could not connection to database{$connectionInfo['Database']}"
                . " on server{$serverName}", 1);
        }

        return $connection;
    }
}