<?php

namespace App\Repositories;

use App\Contracts\Repositories\TripRepository;
use App\Trip;

class EloquentTripRepository implements TripRepository
{
    /**
     * The Eloquent model instance
     * @var Trip
     */
    protected $model;

    /**
     * EloquentTripRepository constructor.
     * @param Trip $model
     */
    public function __construct(Trip $model)
    {
        $this->model = $model;
    }

    /**
     * Finds a trip by id
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
     * has a trip with the specified id
     * @param $id
     * @return boolean
     */
    public function has($id)
    {
        return $this->model->get()->contains($id);
    }

    /**
     * Adds a flight to the given trip
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
}