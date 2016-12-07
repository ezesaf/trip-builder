<?php

namespace App\Contracts\Repositories;

interface AirportRepository
{
    /**
     * Returns a list of airports ordered alphabetically
     * @param array $columns
     * @return array
     */
    public function getAllAirportsAlphabetically($columns = ['*']);


    /**
     * Returns a paginated result of airports ordered alphabetically
     * @return array
     */
    public function getPaginatedAirportsAlphabetically($perPage = 30, $columns = ['*']);


}