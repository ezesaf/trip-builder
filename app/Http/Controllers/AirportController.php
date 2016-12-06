<?php

namespace App\Http\Controllers;

use App\Services\AirportService;

class AirportController extends Controller
{
    protected $airportService;

    /**
     * AirportController constructor.
     * @param AirportService $airportService
     */
    public function __construct(AirportService $airportService)
    {
        $this->airportService = $airportService;
    }

    /**
     * @return array
     */
    public function index()
    {
        return $this->airportService->getAlphabeticalListing();
    }
}
