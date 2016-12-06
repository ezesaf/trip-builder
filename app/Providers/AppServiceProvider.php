<?php

namespace App\Providers;

use App\Contracts\Providers\AirportDataProvider;
use App\Contracts\Repositories\AirportRepository;
use App\Repositories\EloquentAirportRepository;
use App\APIs\OpenFlight;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        $this->app->bind(AirportDataProvider::class, OpenFlight::class);
        $this->app->bind(AirportRepository::class, EloquentAirportRepository::class);
    }
}
