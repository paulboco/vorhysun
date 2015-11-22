<?php

namespace Library\Database\Sqlsrv;

use Exception;

/**
 * Wrapper class for sqlsrv_* functions.
 */
abstract class Sqlsrv
{
    /**
     * The database connection.
     *
     * @var resource
     */
    private $connection;
    private $grammar;

    /**
     * Create a new sqlsrv.
     *
     * @return void
     */
    function __construct()
    {
        if ($this->connection) {
            return;
        }

        $connector = new SqlsrvConnector;

        $this->connection = $connector->getConnection();

        $this->grammar = new SqlsrvGrammar;
    }

    /**
     * Get all rows.
     *
     * @return boolean
     */
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $statement = sqlsrv_query($this->connection, $sql);

        if ($statement === false) {
            throw new Exception(
                "There is an error in your sql syntax: '{$sql}'"
            );
        }

        while ($row = sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Find a row by id.
     *
     * @param  integer  $id
     * @return boolean
     */
    public function findById($id)
    {
        return $this->getWhere(array('id', '=', $id));
    }

    /**
     * Conditionally get a row from the database.
     *
     * @param  array  $wheres
     * @return boolean
     */
    public function getRowWhere($wheres)
    {
        return $this->getWhere($wheres);
    }

    /**
     * Conditionally check if a row exists in the database.
     *
     * @param  array  $wheres
     * @return boolean
     */
    public function rowExists($wheres)
    {
        return $this->getWhere($wheres);
    }

    /**
     * Conditionally get a row from the database.
     *
     * The $wheres array is structured as follows:
     *     array('field_name', 'comparison', 'expected_value');
     *     example: array('participant', '=', 'tester')
     *
     * @param  array  $wheres
     * @return mixed
     */
    public function getWhere($wheres = array())
    {
        $wheres = $this->grammar->prepareWheresArray($wheres);
        $whereClause = $this->grammar->buildWhereClause($wheres);

        $sql = "SELECT * FROM {$this->table} {$whereClause}";
        $statement = sqlsrv_query(
            $this->connection,
            $sql,
            $this->grammar->getValues($wheres)
        );

        if ($statement === false) {
            throw new Exception(
               "There is an error in your sql syntax: '{$sql}'", 1);
        }

        return sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC);
    }
}
