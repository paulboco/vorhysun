<?php

namespace Library;

use Aura\Sql\ExtendedPdo;

abstract class Model
{
    /**
     * The pdo instance.
     *
     * @var PDO
     */
    private $pdo;

    /**
     * Make a new model.
     */
    public function __construct()
    {
        $this->pdo = new ExtendedPdo(
            'sqlsrv:server=VM2012\SQLEXPRESS;database=sqlsrv',
            'sa',
            'Secret#01'
        );
    }

    /**
     * Make a new model.
     *
     * @return mixed
     */
    public static function make()
    {
        return new static;
    }

    /**
     * Fetch all rows.
     *
     * @return array
     */
    public function all()
    {
        $stm = "SELECT * FROM " . $this->table;
        $bind = array();

        return $this->pdo->fetchAll($stm, $bind);
    }
}
