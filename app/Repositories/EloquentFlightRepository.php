<?php

namespace App\Repositories;

use App\Contracts\Repositories\FlightRepository;
use App\Models\Flight;

class EloquentFlightRepository implements FlightRepository
{
    /**
     * The Flight model.
     * 
     * @var Flight
     */
    protected $model;

    /**
     * EloquentFlightRepository constructor.
     * 
     * @param Flight $model
     */
    public function __construct(Flight $model)
    {
        $this->model = $model;
    }

    /**
     * Removes a given flight from a trip.
     * 
     * @param $flightId
     * @return boolean
     */
    public function removeFlight($flightId)
    {
        $count = $this->model->destroy($flightId);

        return $count > 0;
    }
}