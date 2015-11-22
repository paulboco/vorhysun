<?php

namespace Library;

use Library\Database\Connector;
use Library\Database\Grammar;

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

        $this->grammar = new Grammar;
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
    public function all($wheres = array(), $columns = array())
    {
        $columns = $this->grammar->buildSelectExpression($columns);

        $statement  = "SELECT * FROM {$this->table}";
        $statement .= $this->grammar->buildWhereClause($wheres);

dd($columns, $statement);

        $bindings = array();

        return $this->pdo->fetchAll($statement, $bindings);
    }
}
