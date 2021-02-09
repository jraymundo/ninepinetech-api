<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');

require_once __DIR__.'/../vendor/autoload.php';

use App\Controllers\VehicleController;
use App\Repositories\VehicleRepository;
use App\Services\VehicleService;

/**
 * Route Service
 *
 * If Refactor:
 * 1. Create new Route and Router Service class that would handle all routes specific on each request
 * 2. Add handler for middleware classes and authentication service and user resolvers etcs
 * 3. Add Service Container to handle Dependency Injection and Inversion properly
 */
$routes = [
    'POST' => [
        '/vehicle' => [
            'controller' => new VehicleController(new VehicleService(new VehicleRepository())),
            'function' => 'create',
        ],
    ],
    'GET' => [
        '/vehicle' => [
            'controller' => new VehicleController(new VehicleService(new VehicleRepository())),
            'function' => 'all',
        ],
    ],
];

/**
 * Router Service class
 */
$router = $routes[$_SERVER['REQUEST_METHOD']][$_SERVER['REQUEST_URI']];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = json_decode(file_get_contents('php://input'), true);

    return $router['controller']->{$router['function']}($params);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    return $router['controller']->{$router['function']}();
}
