<?php

/**
 * Wrapper for sqlsrv_* functions.
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
    function __construct($serverName, $connectionInfo)
    {
        $connection = sqlsrv_connect($serverName, $connectionInfo);

        if ($connection === false) {
             throw new Exception(
                "Could not connection to database{$connectionInfo['Database']}"
                . " on server{$serverName}", 1);
        }

        $this->database = $connectionInfo['Database'];
        $this->server = $serverName;
        $this->connection = $connection;
    }

    /**
     * Conditionally get a row from the database.
     *
     * The $wheres array is structured as follows:
     *     array('field_name', 'comparison', 'expected_value');
     *
     * @param  string  $table
     * @param  array  $wheres
     * @param  boolean  $noData
     * @return array|boolean
     */
    public function getRow($table, $wheres, $noData = false)
    {
        $whereClause = $this->buildWhereClause($wheres);

        $sql = "SELECT * FROM {$table} {$whereClause}";

        $statement = sqlsrv_query(
            $this->connection,
            $sql,
            $this->getValues($wheres)
        );

        if ($statement === false) {
            throw new Exception(
               "There is an error in your sql syntax: '{$sql}'", 1);
        }

        if ($noData) {
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
            return $this->getRow($table, array('id', '=', $id));
     }

    /**
     * Conditionally check if a row exists in the database.
     *
     * @param  string  $table
     * @param  array  $wheres
     * @return boolean
     */
     public function rowExists($table, $wheres)
     {
            return $this->getRow($table, $wheres, true);
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
