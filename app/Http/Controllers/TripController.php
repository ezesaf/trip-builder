<?php

namespace App\Http\Controllers;

use App\APIs\Flights;
use App\Services\TripService;
use NotFoundHttpException;

class TripController extends Controller
{
    /**
     * the TripService instance.
     *
     * @var TripService
     */
    protected $tripService;

    /**
     * TripController constructor.
     *
     * @param TripService $tripService
     */
    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    /**
     * Returns a list of available flights for a trip.
     *
     * @param $tripId
     * @return \Illuminate\Http\JsonResponse
     */
    public function availableFlights($tripId)
    {
        try {
            return $this->getAvailableFlights($tripId);
        } catch (NotFoundHttpException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Returns a list of available flights for a trip
     * 
     * @param $tripId
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getAvailableFlights($tripId)
    {
        $data = $this->tripService->getAvailableFlightsForTrip($tripId);

        if (empty($data)) {
            return response()->json([
                'error' => 'No flights available'
            ], 204);
        }

        return response()->json($data, 200);
    }
}
