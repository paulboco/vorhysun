<?php

namespace App\Models;

use Library\Sqlsrv\Sqlsrv;

class Optedin extends Sqlsrv
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'opted_in';
}
