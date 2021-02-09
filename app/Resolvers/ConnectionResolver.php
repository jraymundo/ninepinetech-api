<?php

namespace App\Resolvers;

trait ConnectionResolver
{
    /**
     * If refactor:
     * 1. DB settings can be placed on a different file
     * 2. Can create a singleton Class that handles database connection
     * @return resource
     */
    public function instantiateDB()
    {
        $db = [
            'host' => 'localhost',
            'port' => 5432,
            'dbname' => 'ninepinetech',
            'user' => 'homestead',
            'password' => 'secret',
        ];

        return pg_connect('host='.$db['host'].' port='.$db['port'].' dbname='.$db['dbname'].' user='.$db['user'].' password='.$db['password']);
    }
}
