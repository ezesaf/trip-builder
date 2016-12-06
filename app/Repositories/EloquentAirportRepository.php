<?php

namespace App\Repositories;

use App\Airport;
use App\Contracts\Repositories\AirportRepository;

class EloquentAirportRepository implements AirportRepository
{
    protected $model;

    /**
     * EloquentAirportRepository constructor.
     * @param Airport $model
     */
    public function __construct(Airport $model)
    {
        $this->model = $model;
    }

    /**
     * returns a list of airports ordered alphabetically
     *
     * @param array $columns
     * @return array
     */
    public function getAllAirportsAlphabetically($columns = ['*'])
    {
        return $this->model->orderBy('name', 'ASC')->get($columns)->toArray();
    }
}