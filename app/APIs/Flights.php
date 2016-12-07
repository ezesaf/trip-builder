<?php

namespace App\APIs;


use App\Contracts\Providers\FlightDataProvider;
use Mockery\CountValidator\Exception;

class Flights implements FlightDataProvider
{
   protected static $flights = [
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
       [
           'flight_number' => 'AC350',
           'airline_code' => 'AC',
           'airport_departure_id' => '192',
           'airport_destination_id' => '3881'
       ],
       [
           'flight_number' => 'AC200',
           'airline_code' => 'AC',
           'airport_departure_id' => '192',
           'airport_destination_id' => '2581'
       ],
       [
           'flight_number' => 'AF400',
           'airline_code' => 'AF',
           'airport_departure_id' => '145',
           'airport_destination_id' => '1363'
       ],
       [
           'flight_number' => 'AC150',
           'airline_code' => 'AC',
           'airport_departure_id' => '192',
           'airport_destination_id' => '145'
       ],
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
        return array_filter(static::$flights, function($flight) use ($origin, $destination) {
            return ($flight['airport_departure_id'] == $origin &&
                $flight['airport_destination_id'] == $destination) ||
                ($flight['airport_departure_id'] == $destination &&
                $flight['airport_destination_id'] == $origin);
        });


    }

    /**
     * finds a flight by its number
     * @param $flightNumber
     * @return array
     */
    public function getFlightByNumber($flightNumber)
    {
        $result = array_filter(static::$flights, function($flight) use ($flightNumber) {
            return $flight['flight_number'] == $flightNumber;
        });

        if (empty($result)) {
            throw new Exception('The flight does not exist');
        }

        return current($result);
    }
}