<?php

use App\Services\TripService;

class TripServiceTest extends TestCase
{
    /**
     * Test fetching available flights for a trip.
     *
     * @return void
     */
    public function test_fetching_available_flights_for_a_trip()
    {
        $tripId = 1;

        $tripData = $this->getMockedTripData();

        $tripRepository = Mockery::mock('App\Contracts\Repositories\TripRepository')
            ->shouldReceive('findById')
            ->with($tripId)
            ->andReturn($tripData)
            ->mock();
        
        $flightsApi = Mockery::mock('App\APIs\Flights')
            ->shouldReceive('getAvailableFlights')
            ->with($tripData['airport_departure_id'], $tripData['airport_destination_id'])
            ->andReturn($this->getMockedAvailableFlights())
            ->mock();
        
        $service = new TripService($tripRepository, $flightsApi);

        $flights = $service->getAvailableFlightsForTrip($tripId);

        $this->assertCount(2, $flights);
    }

    /**
     * Test adding a flight for a trip.
     *
     * @return void
     */
    public function test_adding_flight_to_a_trip()
    {
        $tripId = 1;
        $flightNumber = 'AC324';
        $flightData = $this->getMockedAvailableFlights()[0];

        $tripRepository = Mockery::mock('App\Contracts\Repositories\TripRepository')
            ->shouldReceive('addFlightToTrip')
            ->with($tripId, $flightData)
            ->andReturn($flightData)
            ->mock();

        $flightsApi = Mockery::mock('App\APIs\Flights')
            ->shouldReceive('getFlightByNumber')
            ->with($flightNumber)
            ->andReturn($flightData)
            ->mock();

        $service = new TripService($tripRepository, $flightsApi);

        $result = $service->addFlightToTrip($tripId, $flightNumber);

        $this->assertArraySubset($result, $flightData);
    }

    /**
     * Test adding a flight for a trip with null id.
     *
     * @return void
     */
    public function test_throwing_exception_when_adding_flight_to_trip_with_empty_id()
    {
        $tripId = null;
        $flightNumber = encrypt('AC324');

        $this->expectException('Exception');

        $tripRepository = Mockery::mock('App\Contracts\Repositories\TripRepository');

        $flightsApi = Mockery::mock('App\APIs\Flights');

        $service = new TripService($tripRepository, $flightsApi);

        $service->addFlightToTrip($tripId, $flightNumber);

    }

    /**
     * Test adding a flight with empty flight number.
     *
     * @return void
     */
    public function test_throwing_exception_when_adding_flight_to_trip_with_empty_fligth_number()
    {
        $tripId = 1;
        $flightNumber = null;

        $this->expectException('Exception');

        $tripRepository = Mockery::mock('App\Contracts\Repositories\TripRepository');

        $flightsApi = Mockery::mock('App\APIs\Flights');

        $service = new TripService($tripRepository, $flightsApi);

        $service->addFlightToTrip($tripId, $flightNumber);

    }

    protected function getMockedTripData()
    {
        return [
            'id' => 1,
            'airport_departure_id' => 145,
            'airport_destination_id' => 192,
        ];
    }

    protected function getMockedAvailableFlights()
    {
        return [
            [
                'flight_number' => 'AC324',
                'airline_code' => 'AC',
                'airport_departure_id' => '145',
                'airport_destination_id' => '192'
            ],
            [
                'flight_number' => 'AC900',
                'airline_code' => 'AC',
                'airport_departure_id' => '145',
                'airport_destination_id' => '192'
            ],
        ];
    }
}
