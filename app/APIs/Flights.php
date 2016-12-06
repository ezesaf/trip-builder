<?php

namespace App\APIs;


use App\Contracts\Providers\FlightDataProvider;

class Flights implements FlightDataProvider
{

   protected static $flights = [
       []
   ];

    /**
     * returns a list of available flights between 2 airports
     *
     * @param $origin
     * @param $destination
     * @return array
     */
    public function getAvailableFlights($origin, $destination)
    {
        // TODO: Implement getAvailableFlights() method.
    }
}