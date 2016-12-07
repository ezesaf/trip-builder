<?php

use App\Services\AirportService;

class AirportServiceTest extends TestCase
{
    /**
     * Test fetching list of airports.
     *
     * @return void
     */
    public function test_fetching_list_of_airports()
    {
        $mock = Mockery::mock('App\Contracts\Repositories\AirportRepository')
            ->shouldReceive('getAllAirportsAlphabetically')
            ->andReturn($this->getMockedAirportData())
            ->mock();

        $service = new AirportService($mock);

        $airports = $service->getAlphabeticalListing();

        $this->assertCount(2, $airports);
    }

    /**
     * Test fetching empty list of airports.
     *
     * @return void
     */
    public function test_fetching_empty_list_of_airports()
    {
        $mock = Mockery::mock('App\Contracts\Repositories\AirportRepository')
            ->shouldReceive('getAllAirportsAlphabetically')
            ->andReturn([])
            ->mock();

        $service = new AirportService($mock);

        $airports = $service->getAlphabeticalListing();

        $this->assertCount(0, $airports);
    }

    /**
     * Test fetching paginated list of airports
     *
     * @return void
     */
    public function test_fetching_paginated_list_of_airports()
    {
        $mock = Mockery::mock('App\Contracts\Repositories\AirportRepository')
            ->shouldReceive('getAllAirportsAlphabetically')
            ->andReturn($this->getMockedPaginatedAirportData())
            ->mock();

        $service = new AirportService($mock);

        $data = $service->getAlphabeticalListing();

        $this->assertArraySubset($this->getMockedPaginatedAirportData(), $data);
        $this->assertCount(8, $data);
    }

    protected function getMockedAirportData()
    {
        return [
            [
                'id' => 1,
                'name' => 'Mocked Aiport',
                'city' => 'Mocked City',
                'country' => 'Mocked Country',
                'iata_faa_code' => 'MOC',
                'icao_code' => 'MOCK',
            ],
            [
                'id' => 2,
                'name' => 'Mocked Aiport',
                'city' => 'Mocked City',
                'country' => 'Mocked Country',
                'iata_faa_code' => 'MOC',
                'icao_code' => 'MOCK',
            ]
        ];
    }

    protected function getMockedPaginatedAirportData()
    {
        return [
            'total' => 8107,
            'per_page' => 30,
            'current_page' => 1,
            'last_page' => 271,
            'next_page_url' => 'http://trip-builder.dev/api/airports?page=2',
            'prev_page_url' => null,
            'from' => 1,
            'to' => 30,
        ];
    }
}
