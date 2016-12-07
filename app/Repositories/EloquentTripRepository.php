<?php

namespace App\Repositories;

use App\Contracts\Repositories\TripRepository;
use App\Models\Trip;

class EloquentTripRepository implements TripRepository
{
    /**
     * The Trip model.
     *
     * @var Trip
     */
    protected $model;

    /**
     * EloquentTripRepository constructor.
     *
     * @param Trip $model
     */
    public function __construct(Trip $model)
    {
        $this->model = $model;
    }

    /**
     * Finds a trip by its id.
     *
     * @param $id
     * @return array
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id)->toArray();
    }

    /**
     * Returns whether or not the repository
     * has a trip with the specified id.
     *
     * @param $id
     * @return boolean
     */
    public function has($id)
    {
        return $this->model->get()->contains($id);
    }

    /**
     * Adds a flight to the given trip.
     * 
     * @param $tripId
     * @param $flightData
     * @return array
     */
    public function addFlightToTrip($tripId, $flightData)
    {
        $trip = $this->model->findOrFail($tripId);
        $flight = $trip->flights()->create($flightData);

        return $flight->toArray();
    }

    /**
     * Returns the list of associated flights for a given trip.
     *
     * @param $tripId
     * @return array
     */
    public function getFlights($tripId)
    {
        $trip = $this->model->findOrFail($tripId);

        return $trip->flights->toArray();
    }
}