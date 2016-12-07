<?php

namespace App\Providers;

use App\Contracts\Providers\AirportDataProvider;
use App\Contracts\Repositories\AirportRepository;
use App\Contracts\Repositories\FlightRepository;
use App\Contracts\Repositories\TripRepository;
use App\Repositories\EloquentAirportRepository;
use App\APIs\OpenFlight;
use App\Repositories\EloquentFlightRepository;
use App\Repositories\EloquentTripRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $bindings = [
        AirportDataProvider::class => OpenFlight::class,
        AirportRepository::class => EloquentAirportRepository::class,
        TripRepository::class => EloquentTripRepository::class,
        FlightRepository::class => EloquentFlightRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
