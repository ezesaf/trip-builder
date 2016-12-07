<?php

namespace App\Http\Controllers;

use App\Services\FlightService;
use App\Services\TripService;
use Exception;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * The FlightService instance.
     *
     * @var FlightService
     */
    protected $flightService;

    /**
     * FlightController constructor.
     *
     * @param FlightService $flightService
     */
    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    /**
     * Adds a flight to a trip.
     *
     * @param $tripId
     * @param Request $request
     * @param TripService $tripService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($tripId, Request $request, TripService $tripService)
    {
        try {
            $data = $tripService->addFlightToTrip($tripId, $request->input('flight_number'));
            return response()->json($data, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'code' => 403
            ], 403);
        }

    }

    /**
     * Deletes a flight from a trip.
     *
     * @param $flightId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($flightId)
    {
        try {
            return $this->removeFlight($flightId);
        } catch (Exception $e) {
            return response()->json([
                'sucess' => false,
                'error' => $e->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Deletes a flight from a trip.
     * 
     * @param $flightId
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    protected function removeFlight($flightId)
    {
        $data = $this->flightService->removeFlightFromTrip($flightId);

        if (empty($data)) {
            return response()->json([
                'success' => $data,
                'error' => 'Flight not found',
                'code' => 404
            ], 404);
        }

        return response()->json([
            'success' => $data,
            'code' => 200,
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
