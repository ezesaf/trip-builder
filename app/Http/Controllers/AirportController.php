<?php

namespace App\Http\Controllers;

use App\Services\AirportService;

class AirportController extends Controller
{
    /**
     * The AiportService instance
     * @var AirportService
     */
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
     * Returns a list of alphabetically ordered airports
     * @return array
     */
    public function index()
    {
        $data = $this->airportService->getAlphabeticalListing();

        if (empty($data)) {
            return response()->json([
                'error' => 'No airport data available'
            ], 204);
        }

        return response()->json($data, 200);
    }
}
