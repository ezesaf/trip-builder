<?php

namespace App\Contracts\Providers;

interface AirportDataProvider
{
    /**
     * returns a list of airports with their corresponding
     * name, city, country, IATA, FAA and/or ICAO code.
     *
     * @return array
     */
    public function getAirportData();
}