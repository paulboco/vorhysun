<?php

namespace Library;

/**
 * Wrapper class for sqlsrv_* functions.
 */
class Sqlsrv
{
    private $server;
    private $database;
    private $connection;

    /**
     * Create a new Sqlsrv.
     *
     * @param  string  $serverName
     * @param  array  $connectionInfo
     * @return void
     */
    function __construct($serverName = null, $connectionInfo = null)
    {
        $this->setConnection($serverName, $connectionInfo);
    }

    /**
     * Set the SQL Server connection.
     *
     * @param  string  $serverName
     * @param  array  $connectionInfo
     * @return void
     */
    private function setConnection($serverName = null, $connectionInfo = null)
    {
        if (is_null($serverName)) {
            $serverName = Config::get('database.serverName');
        }

        if (is_null($connectionInfo)) {
            $connectionInfo = Config::get('database.connectionInfo');
        }

        $connection = sqlsrv_connect($serverName, $connectionInfo);

        if ($this->connection === false) {
            throw new Exception(
                "Could not connection to database{$connectionInfo['Database']}"
                . " on server{$serverName}", 1);
        }

        $this->connection = $connection;
        $this->server = $serverName;
        $this->database = $connectionInfo['Database'];
    }

    /**
     * Conditionally get a row from the database.
     *
     * The $wheres array is structured as follows:
     *     array('field_name', 'comparison', 'expected_value');
     *     example: array('participant', '=', 'tester')
     *
     * @param  array  $wheres
     * @param  boolean  $existanceTest
     * @return array|boolean
     */
    public function getRow($wheres, $existanceTest = false)
    {
        $wheres = $this->prepareWheres($wheres);

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

        if ($existanceTest) {
            return (boolean) sqlsrv_fetch($statement);
        }

        return sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC);
    }

    /**
     * Find a row by id.
     *
     * @param  integer  $id
     * @return boolean
     */
    public function findById($id)
    {
        return $this->getRow(array('id', '=', (string) $id));
    }

    /**
     * Conditionally check if a row exists in the database.
     *
     * @param  array  $wheres
     * @return boolean
     */
    public function rowExists($wheres)
    {
        return $this->getRow($wheres, true);
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

        return  'WHERE ' . implode(' AND ', $whereClauses);
    }

    /**
     * Prepare the $wheres variable for use by Sqlsrv::buildWhereClause()
     *
     * @param  mixed  $wheres
     * @return array
     */
    private function prepareWheres($wheres)
    {
        if (!is_array($wheres)) {
            throw new Exception('Argument 1 of method ' . __METHOD__ .
                ' must be an array.', 1);
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
