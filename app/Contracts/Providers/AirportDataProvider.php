<?php

namespace App\Contracts\Providers;

interface AirportDataProvider
{
    /**
     * Returns a list of airports with their corresponding
     * name, city, country, IATA, FAA and/or ICAO code.
     *
     * @return array
     */
    public function getAirportData();
}