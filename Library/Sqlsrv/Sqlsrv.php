<?php

namespace Library\Sqlsrv;

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
        $wheres = $this->prepareWheresArray($wheres);
        $whereClause = $this->buildWhereClause($wheres);

        $sql = "SELECT * FROM {$this->table} {$whereClause}";
        $statement = sqlsrv_query(
            $this->connection,
            $sql,
            $this->getValues($wheres)
        );

        if ($statement === false) {
            throw new Exception(
               "There is an error in your sql syntax: '{$sql}'", 1);
        }

        return sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC);
    }

    /**
     * Build a where clause from an array.
     *
     * @param  array  $wheres
     * @return string
     */
    private function buildWhereClause($wheres)
    {
        $whereClauses = array();

        foreach ($wheres as $where) {
            $whereClauses[] = "{$where[0]}{$where[1]}?";
        }

        $clauses = implode(' AND ', $whereClauses);

        if (!$clauses) {
            return '';
        }

        return  'WHERE ' . $clauses;
    }

    /**
     * Prepare the $wheres array for use by Sqlsrv::buildWhereClause()
     *
     * @param  mixed  $wheres
     * @return array
     */
    private function prepareWheresArray($wheres)
    {
        if (!is_array($wheres)) {
            throw new Exception('Argument 1 of method ' . __METHOD__ .
                ' must be an array.', 1);
        }

        if (empty($wheres)) {
            return $wheres;
        }

        if (!is_array($wheres[0])) {
            $wheres = array($wheres);
        }

        return $wheres;
    }

     /**
      * Get an array values from a where clause array.
      *
      * @param  array  $wheres
      * @return array
      */
    private function getValues($wheres)
    {
        return array_map(function($v) {
            return $v[2];
        }, $wheres);
    }
}
