<?php

use App\Services\FlightService;

class FlightServiceTest extends TestCase
{
    /**
     * test deleting flight with valid id
     *
     * @return void
     */
    public function test_deleting_flight_with_valid_id()
    {
        $flightId = 1;

        $mock = Mockery::mock('App\Contracts\Repositories\FlightRepository')
            ->shouldReceive('removeFlight')
            ->with($flightId)
            ->andReturn(true)
            ->mock();

        $service = new FlightService($mock);

        $result = $service->removeFlightFromTrip($flightId);

        $this->assertTrue($result);
    }

    /**
     * test deleting flight with empty id
     *
     * @return void
     */
    public function test_throwing_exception_when_deleting_flight_with_empty_id()
    {
        $flightId = null;

        $this->expectException(Exception::class);

        $mock = Mockery::mock('App\Contracts\Repositories\FlightRepository');

        $service = new FlightService($mock);

        $service->removeFlightFromTrip($flightId);
    }
}
