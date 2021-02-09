<?php

namespace App\Controllers;

use App\Services\VehicleService;
use App\Transformers\VehicleTransformer;
use App\Resolvers\ResponseResolver;
use Exception;

class VehicleController
{
    use ResponseResolver;

    /**
     * @var VehicleService
     */
    private $vehicleService;

    /**
     * VehicleController constructor.
     * @param VehicleService $vehicleService
     */
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function create(array $params)
    {
        /**
         * if to refactor:
         *
         * 1. WIll remove the try catch block as this leads to a FatController overtime
         * 2. WIll Use laravel/Lumen exception handling style
         */
        try {
            $result = $this->vehicleService->create($params);

            $this->createResponse((new VehicleTransformer)->transform($result));
        } catch (Exception $exception) {
            $this->unprocessableEntity($exception->getMessage());
        }
    }

    public function all()
    {
        $result = $this->vehicleService->findAll();

        $this->okResponse($result);
    }
}
