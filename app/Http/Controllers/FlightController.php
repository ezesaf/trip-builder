<?php

namespace App\Http\Controllers;

use App\Services\FlightService;
use App\Services\TripService;
use Exception;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    protected $flightService;

    /**
     * FlightController constructor.
     * @param FlightService $flightService
     */
    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    /**
     * @param $tripId
     * @param Request $request
     * @param TripService $tripService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($tripId, Request $request, TripService $tripService)
    {
        try {
            $data = $tripService->addFlightToTrip($tripId, $request);
            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'code' => 400
            ], 400);
        }

    }

    /**
     * @param $flightId
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Services\Exception
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
     * @param $flightId
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Services\Exception
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
        ], 200);
    }
}
