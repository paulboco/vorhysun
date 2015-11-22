<?php

namespace Library;

use Library\Database\Connector;

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
        $connector = new Connector;

        $this->pdo = $connector->connect();
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
    public function all($wheres)
    {
        $stm = "SELECT * FROM " . $this->table;
        $bind = array();

        return $this->pdo->fetchAll($stm, $bind);
    }
}
