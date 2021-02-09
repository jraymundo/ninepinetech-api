<?php

use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use App\Resolvers\ConnectionResolver;

class VehicleControllerTest extends TestCase
{
    use ConnectionResolver;

    private $apiEndpoint;

    public function setUp(): void
    {
        parent::setUp();

        pg_fetch_object(pg_query($this->instantiateDB(), 'TRUNCATE table vehicles'));

        $this->apiEndpoint = 'http://sidelines.ninepinetech.devv';
    }

    /** @test */
    public function it_returns_a_created_response_on_successful_creation_of_vehicle()
    {
        $faker = Faker::create();

        $client = new GuzzleHttp\Client();

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $response = $client->request('POST', $this->apiEndpoint.'/vehicle', [
            'json' => $payload,
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function it_returns_an_unprocessable_entity_when_registering_an_existing_vehicle()
    {
        $faker = Faker::create();

        $client = new GuzzleHttp\Client();

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $client->request('POST', $this->apiEndpoint.'/vehicle', [
            'json' => $payload,
        ]);

        try {
            $response = $client->request('POST', $this->apiEndpoint.'/vehicle', ['json' => $payload,]);


        } catch (Exception $exception) {
            $this->assertEquals(422, $exception->getCode());
        }

    }


    /** @test */
    public function it_returns_a_valid_response_on_fetching_all_vehicles()
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request('GET', $this->apiEndpoint.'/vehicle');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_returns_a_valid_response_on_fetching_all_vehicles_when_no_vehicle_exist()
    {
        $faker = Faker::create();

        $client = new GuzzleHttp\Client();

        $payload = [
            'unique_identifier' => '1HGBH41JXMN'.$faker->numberBetween(109186, 209186),
            'name' => $faker->name,
            'engine_displacement' => $faker->randomElement(['1L', '1.0L', '1.0', '1L', '1000CC', '1000 CC']),
            'engine_power' => $faker->word,
            'price' => $faker->randomFloat(),
            'location' => $faker->word,
        ];

        $client->request('POST', $this->apiEndpoint.'/vehicle', [
            'json' => $payload,
        ]);


        $response = $client->request('GET', 'http://sidelines.ninepinetech.devv/vehicle');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
