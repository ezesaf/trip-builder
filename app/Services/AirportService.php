<?php

namespace App\Services;

use App\Contracts\Repositories\AirportRepository;

class AirportService
{
    /**
     * The AirportRepository instance.
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
     * Returns an alphabetically sorted list of all airports.
     * 
     * @param array $columns
     * @return array
     */
    public function getAlphabeticalListing($columns = ['*'])
    {
        return $this->airportRepository->getAllAirportsAlphabetically($columns);
    }

    /**
     * Returns a paginated result of all airports.
     * 
     * @param int $perPage
     * @param array $columns
     * @return array
     */
    public function getPaginatedListing($perPage = 30, $columns = ['*'])
    {
        return $this->airportRepository->getPaginatedAirportsAlphabetically($perPage, $columns);
    }
}