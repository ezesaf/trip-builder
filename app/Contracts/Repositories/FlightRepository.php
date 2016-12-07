<?php

namespace App\Contracts\Repositories;

interface FlightRepository
{
    /**
     * Removes a given flight from a trip
     * @param $flightId
     * @return boolean
     */
    public function removeFlight($flightId);
}