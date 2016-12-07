<?php

namespace App\Services;

use App\APIs\Flights;
use App\Contracts\Repositories\TripRepository;
use Mockery\CountValidator\Exception;

class TripService
{
    /**
     * The TripRepository instance.
     *
     * @var TripRepository
     */
    protected $tripRepository;

    /**
     * The Flights api instance.
     *
     * @var Flights
     */
    protected $flightsApi;

    /**
     * TripService constructor.
     *
     * @param TripRepository $tripRepository
     * @param Flights $flightsApi
     */
    public function __construct(TripRepository $tripRepository, Flights $flightsApi)
    {
        $this->tripRepository = $tripRepository;
        $this->flightsApi = $flightsApi;
    }

    /**
     * Finds available flights for a given trip.
     *
     * @param $tripId
     * @return array
     */
    public function getAvailableFlightsForTrip($tripId)
    {
        $trip = $this->tripRepository->findById($tripId);

        $availableFlights = $this->flightsApi->getAvailableFlights($trip['airport_departure_id'], $trip['airport_destination_id']);

        return $availableFlights;
    }

    /**
     * Adds a flight to a trip.
     *
     * @param $tripId
     * @param $flightNumber
     * @return array
     */
    public function addFlightToTrip($tripId, $flightNumber)
    {
        if (empty($tripId) || empty($flightNumber)) {
            throw new Exception('Trip id and/or flight number are not set');
        }

        $flightData = $this->flightsApi->getFlightByNumber($flightNumber);
        
        return $this->tripRepository->addFlightToTrip($tripId, $flightData);
    }

    /**
     * Fetches a list of associated flights for a given trip.
     *
     * @param $tripId
     * @return array
     */
    public function getFlights($tripId)
    {
        if (empty($tripId)) {
            throw new Exception('Trip id is empty');
        }
        
        return $this->tripRepository->getFlights($tripId);
    }
}