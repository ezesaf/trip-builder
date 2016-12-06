<?php

namespace App\Services;

use App\Contracts\Repositories\AirportRepository;

class AirportService
{
    /**
     * the airport repository instance
     *
     * @var AirportRepository
     */
    protected $airportRepository;

    /**
     * AirportService constructor.
     *
     * @param AirportRepository $airportRepository
     */
    public function __construct(AirportRepository $airportRepository)
    {
        $this->airportRepository = $airportRepository;
    }

    /**
     * returns an alphabetically sorted list of all airports
     * @param array $columns
     * @return array
     */
    public function getAlphabeticalListing($columns = ['*'])
    {
        return $this->airportRepository->getAllAirportsAlphabetically($columns);
    }
}