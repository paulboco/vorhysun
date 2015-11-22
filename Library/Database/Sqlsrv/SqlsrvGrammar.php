<?php

namespace Library\Database\Sqlsrv;

class SqlsrvGrammar
{
    /**
     * Build a where clause from an array.
     *
     * @param  array  $wheres
     * @return string
     */
    public function buildWhereClause($wheres)
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
    public function prepareWheresArray($wheres)
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
    public function getValues($wheres)
    {
        return array_map(function($v) {
            return $v[2];
        }, $wheres);
    }
}