<?php
/**
 * Created by PhpStorm.
 * User: ezequiel
 * Date: 2016-12-06
 * Time: 7:39 PM
 */

namespace App\Services;

use App\Contracts\Repositories\FlightRepository;
use Exception;

class FlightService
{
    /**
     * The flightRepository instance.
     *
     * @var FlightRepository
     */
    protected $flightRepository;

    /**
     * FlightService constructor.
     *
     * @param FlightRepository $flightRepository
     */
    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    /**
     * Removes a given flight form a trip.
     * 
     * @param $flightId
     * @return bool
     * @throws Exception
     */
    public function removeFlightFromTrip($flightId)
    {
        if (empty($flightId)) {
            throw new Exception('Flight id is not set');
        }

        return $this->flightRepository->removeFlight($flightId);
    }
}