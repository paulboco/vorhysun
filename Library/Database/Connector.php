<?php

namespace Library\Database;

use Aura\Sql\ExtendedPdo;
use Library\Config;

class Connector
{
    /**
     * Make a new model.
     *
     * @return void
     */
    public function connect()
    {
        $default = Config::get('database.default');
        $server = Config::get('database.connections.' . $default . '.server');
        $database = Config::get('database.connections.' . $default . '.database');
        $username = Config::get('database.connections.' . $default . '.username');
        $password = Config::get('database.connections.' . $default . '.password');

        return new ExtendedPdo(
            "sqlsrv:server={$server};database={$database}",
            $username,
            $password
        );
    }
}
