<?php
/**
 * Created by PhpStorm.
 * User: ezequiel
 * Date: 2016-12-06
 * Time: 1:28 PM
 */

namespace App\Contracts\Providers;


interface FlightDataProvider
{
    /**
     * returns a list of available flights between 2 airports
     * @param $origin
     * @param $destination
     * @return array
     */
    public function getAvailableFlights($origin, $destination);

    /**
     * finds a flight by its number
     * @param $flightNumber
     * @return array
     */
    public function getFlightByNumber($flightNumber);
}