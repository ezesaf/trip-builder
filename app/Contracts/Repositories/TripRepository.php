<?php

namespace App\Contracts\Repositories;

interface TripRepository
{
    /**
     * Finds a trip by id
     * @param $id
     * @return array
     */
    public function findById($id);

    /**
     * Returns whether or not the repository
     * has a trip with the specified id
     * @param $id
     * @return boolean
     */
    public function has($id);

    /**
     * Adds a flight to the given trip
     * @param $tripId
     * @param $flightData
     */
    public function addFlightToTrip($tripId, $flightData);

    /**
     * Returns the list of associated flights for a given trip.
     * 
     * @param $tripId
     * @return array
     */
    public function getFlights($tripId);
}