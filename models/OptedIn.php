<?php

namespace Models;

use Library\Sqlsrv;

class OptedIn extends Sqlsrv
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'opted_in';
}