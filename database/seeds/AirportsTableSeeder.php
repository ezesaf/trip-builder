<?php

use App\Contracts\Providers\AirportDataProvider;
use Illuminate\Database\Seeder;

class AirportsTableSeeder extends Seeder
{
    protected $airportDataService;

    public function __construct(AirportDataProvider $airportDataService)
    {
        $this->airportDataService = $airportDataService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->airportDataService->getAirportData();

        DB::table('airports')->insert($data);
    }
    
}
