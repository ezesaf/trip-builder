<?php

namespace App\Services;

use App\APIs\Flights;
use App\Contracts\Repositories\TripRepository;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class TripService
{
    protected $tripRepository;

    protected $flightsApi;

    /**
     * TripService constructor.
     * @param TripRepository $tripRepository
     */
    public function __construct(TripRepository $tripRepository, Flights $flightsApi)
    {
        $this->tripRepository = $tripRepository;
        $this->flightsApi = $flightsApi;
    }

    /**
     * Finds available flights for a given trip
     * @param $tripId
     * @return array
     */
    public function getAvailableFlightsForTrip($tripId)
    {
        $trip = $this->tripRepository->findById($tripId);

        $availableFlights = $this->flightsApi->getAvailableFlights($trip['airport_departure_id'], $trip['airport_destination_id']);

        return $this->encryptFlightNumbers($availableFlights);
    }

    /**
     * Adds a flight to a trip
     * @param $tripId
     * @param Request $request
     * @return array
     */
    public function addFlightToTrip($tripId, Request $request)
    {
        $this->verifyBeforeAddingFlightToTrip($tripId, $request);

        $flightData = $this->getFlightData($request->input('flight_number'));
        
        return $this->tripRepository->addFlightToTrip($tripId, $flightData);
    }
    
    /**
     * Encrypts the flight numbers
     * @param $flights
     * @return array
     */
    protected function encryptFlightNumbers($flights)
    {
        return array_map(function($flight) {
            $flight['flight_number'] = encrypt($flight['flight_number']);
            return $flight;
        }, $flights);
    }

    /**
     * Verifies that the trip and flight number are part of the request
     * @param $tripId
     * @param Request $request
     */
    protected function verifyBeforeAddingFlightToTrip($tripId, Request $request)
    {
        if (!isset($tripId) || !$request->has('flight_number')) {
            throw new Exception('Trip id and/or flight number are not set');
        }

        if (!$this->tripRepository->has($tripId)) {
            throw new Exception('Trip does not exist');
        }
    }

    /**
     * Decrypts the flight number and gets the associated flight data
     * @param $flightNumber
     * @return array
     */
    protected function getFlightData($flightNumber)
    {
        $flightNumber = decrypt($flightNumber);

        return $this->flightsApi->getFlightByNumber($flightNumber);
    }
}