<?php

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use App\Resolvers\ConnectionResolver;
use App\Services\VehicleService;
use Faker\Factory as Faker;
use PHPUnit\Framework\TestCase;

class VehicleServiceTest extends TestCase
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

        $vehicle = new VehicleService(new VehicleRepository());

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $serviceResult = $vehicle->create($payload);
        $dbResult = pg_fetch_object(pg_query($this->instantiateDB(), 'SELECT * from vehicles where id  =' .$serviceResult->id));

        $this->assertInstanceOf(Vehicle::class, $serviceResult);

        /**
         * Check for DB inserts
         */
        $this->assertEquals($payload['name'], $dbResult->name);
    }

    /** @test */
    public function it_throws_an_exception_on_vehicle_create_when_vehicle_already_exist()
    {
        $this->expectException(Exception::class);

        $faker = Faker::create();

        $vehicle = new VehicleService(new VehicleRepository());

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $vehicle->create($payload);

        $vehicle->create($payload);
    }

    /** @test */
    public function it_returns_a_collection_of_vehicles()
    {
        $faker = Faker::create();

        $vehicle = new VehicleService(new VehicleRepository());

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $vehicle->create($payload);

        $result = $vehicle->findAll();

        $this->assertIsArray($result);
        $this->assertInstanceOf(Vehicle::class, $result[0]);
    }

    /** @test */
    public function it_returns_an_empty_collection_when_no_vehicles_exists()
    {
        $faker = Faker::create();

        $vehicle = new VehicleService(new VehicleRepository());

        $result = $vehicle->findAll();

        $this->assertEmpty($result);
    }
}
