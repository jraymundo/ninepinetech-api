<?php

namespace App\Resolvers;

trait QueryBuilderResolver
{
    /**
     * Just a normal insert query builder
     *
     * If refactor:
     * 1. Can be placed on a Builder class that handles all build object
     *
     * @param string $tableName
     * @param array $fields
     * @param array $values
     * @param string $primaryKey
     * @return string
     */
    public function buildInsertQuery(string $tableName, array $fields, array $values, string $primaryKey)
    {
        return "INSERT INTO $tableName ( ".implode(',', $fields).") 
                VALUES('".implode("','", array_map('pg_escape_string', $values))."' ); 
                SELECT currval('$primaryKey')";
    }
}
