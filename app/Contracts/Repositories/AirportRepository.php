<?php

namespace App\Contracts\Repositories;

interface AirportRepository
{
    /**
     * returns a list of airports ordered alphabetically
     * 
     * @param array $columns
     * @return array
     */
    public function getAllAirportsAlphabetically($columns = ['*']);

}