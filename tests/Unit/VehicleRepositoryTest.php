<?php

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Faker\Factory as Faker;
use PHPUnit\Framework\TestCase;
use App\Resolvers\ConnectionResolver;

class VehicleRepositoryTest extends TestCase
{
    use ConnectionResolver;

    public function setUp(): void
    {
        parent::setUp();

        pg_fetch_object(pg_query($this->instantiateDB(), 'TRUNCATE table vehicles'));
    }

    /** @test */
    public function it_returns_a_vehicle_on_successful_creation_of_vehicle()
    {
        $faker = Faker::create();

        $vehicle = new VehicleRepository();

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $serviceResult = $vehicle->create($payload);

        $this->assertInstanceOf(Vehicle::class, $serviceResult);
    }

    /** @test */
    public function it_returns_a_vehicle_when_searched_by_unique_identifier()
    {
        $vehicle = new VehicleRepository();
        $faker = Faker::create();

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $vehicle->create($payload);

        $serviceResult = $vehicle->getByUniqueIdentifier($payload['unique_identifier']);

        $this->assertInstanceOf(Vehicle::class, $serviceResult);
    }

    /** @test */
    public function it_returns_a_list_of_vehicle()
    {
        $vehicle = new VehicleRepository();
        $faker = Faker::create();

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $vehicle->create($payload);

        $serviceResult = $vehicle->getAll();

        $this->assertIsArray($serviceResult);
        $this->assertInstanceOf(Vehicle::class, $serviceResult[0]);
    }

    /** @test */
    public function it_returns_an_empty_collection_when_no_vehicles_exist()
    {
        $vehicle = new VehicleRepository();

        $serviceResult = $vehicle->getAll();

        $this->assertEmpty($serviceResult);
    }
}
