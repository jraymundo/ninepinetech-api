<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Exception;

/**
 * What we can place here
 *
 * 1. Business Rules
 * 2. Gateways, Internal Service and 3rd Party Service integration
 * 3. Call Repositories
 * 4. Business level Validations
 * 5. Throw Exceptions for errors
 */
class VehicleService
{
    /**
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * VehicleService constructor.
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param array $params
     * @return Vehicle
     * @throws Exception
     */
    public function create(array $params)
    {
        if ($this->isExist($params['unique_identifier'])) {
            throw new Exception('Vehicle Already Exist');
        }

        return $this->vehicleRepository->create($params);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->vehicleRepository->getAll();
    }

    private function isExist($uniqueIdentifier)
    {
        return $this->vehicleRepository->getByUniqueIdentifier($uniqueIdentifier);
    }
}
