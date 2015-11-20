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
        $default = Config::get('database.default');
        $server = Config::get('database.connections.' . $default . '.server');
        $connection = Config::get('database.connections.' . $default . '.connection');

        $resource = sqlsrv_connect($server, $connection);

        if ($resource === false) {
            throw new Exception(
                "Could not connect to database{$connection['Database']}"
                . " on server{$server}", 1);
        }

        return $resource;
    }
}
