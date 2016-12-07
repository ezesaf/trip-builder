<?php

namespace App\Repositories;

use App\Models\Airport;
use App\Contracts\Repositories\AirportRepository;

class EloquentAirportRepository implements AirportRepository
{
    /**
     * The Airport model.
     * 
     * @var Airport
     */
    protected $model;

    /**
     * EloquentAirportRepository constructor.
     * 
     * @param Airport $model
     */
    public function __construct(Airport $model)
    {
        $this->model = $model;
    }

    /**
     * Returns a list of airports ordered alphabetically.
     * 
     * @param array $columns
     * @return array
     */
    public function getAllAirportsAlphabetically($columns = ['*'])
    {
        return $this->model->orderBy('name', 'ASC')->get($columns)->toArray();
    }


    /**
     * Returns a paginated result of airports ordered alphabetically.
     * 
     * @param int $perPage
     * @param array $columns
     * @return array
     */
    public function getPaginatedAirportsAlphabetically($perPage = 30, $columns = ['*'])
    {
        return $this->model->orderBy('name', 'ASC')->paginate($perPage, $columns)->toArray();
    }
}