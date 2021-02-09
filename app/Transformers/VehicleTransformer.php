<?php

namespace App\Transformers;

use App\Models\Vehicle;

class VehicleTransformer
{
    public function transform(Vehicle $vehicle)
    {
        return [
            'id' => $vehicle->id,
            'unique_identifier' => $vehicle->unique_identifier,
            'name' => $vehicle->name,
            'engine_displacement' => $vehicle->engine_displacement,
            'engine_power' => $vehicle->engine_power,
            'price' => $vehicle->price,
            'location' => $vehicle->location,
        ];
    }
}
