<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Resolvers\ConnectionResolver;
use App\Resolvers\QueryBuilderResolver;

class Collection
{

}

class VehicleRepository
{
    use ConnectionResolver, QueryBuilderResolver;

    private $conn;

    /**
     * VehicleRepository constructor.
     */
    public function __construct()
    {
        $this->conn = $this->instantiateDB();
    }

    /**
     * @param array $params
     * @return Vehicle
     */
    public function create(array $params)
    {
        $query = $this->buildInsertQuery('vehicles', array_keys($params), array_values($params), 'vehicles_id_seq');

        return $this->handleCreate('vehicles', $query);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->handleSelectAll('SELECT * FROM vehicles');
    }

    /**
     * @param string $uniqueIdentifier
     * @return array
     */
    public function getByUniqueIdentifier($uniqueIdentifier)
    {
        return $this->handleSelectOne("SELECT * FROM vehicles where unique_identifier = '" . "$uniqueIdentifier" ."'");
    }

    /**
     *
     * Helper function to get last inserted object
     *
     * if Refactor:
     * 1. Create a new Class that would handle ALL database persistence
     *
     * @param string $table
     * @param $query
     * @return Vehicle
     */
    protected function handleCreate($table, $query)
    {
        $result = pg_fetch_object(
            pg_query(
                $this->conn,
                'SELECT * from '.$table.' where id  = '.pg_fetch_row(pg_query($this->conn, $query))[0]
            )
        );

        return $this->cast($result, Vehicle::class);
    }

    /**
     * @param $query
     * @return array
     */
    protected function handleSelectAll($query)
    {
        $result = json_decode(
            json_encode(
                pg_fetch_all(
                    pg_query($this->instantiateDB(), $query)
                )
            )
        );

        if ($result) {
            return array_map(function ($stdObject) {
                return $this->cast($stdObject, Vehicle::class);
            }, $result);
        }

        return [];
    }

    /**
     * @param $query
     * @return array
     */
    protected function handleSelectOne($query)
    {
        $result = pg_fetch_object(pg_query($this->instantiateDB(), $query));

        return $this->cast($result, Vehicle::class);
    }

    /**
     * if Refactor:
     *
     * 1. Create a new Trait that would handle Casting of database result
     * @param $object
     * @param $class
     * @return mixed
     */
    private function cast($object, $class)
    {
        return unserialize(
            preg_replace(
                '/^O:\d+:"[^"]++"/',
                'O:'.strlen($class).':"'.$class.'"',
                serialize($object)
            )
        );
    }
}
