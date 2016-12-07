<?php

use App\Contracts\Providers\AirportDataProvider;
use Illuminate\Database\Seeder;

class AirportsTableSeeder extends Seeder
{
    /**
     * The AirportDataProvider instance.
     *
     * @var AirportDataProvider
     */
    protected $airportDataProvider;

    /**
     * AirportsTableSeeder constructor.
     *
     * @param AirportDataProvider $airportDataService
     */
    public function __construct(AirportDataProvider $airportDataProvider)
    {
        $this->airportDataProvider = $airportDataProvider;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->airportDataProvider->getAirportData();

        DB::table('airports')->insert($data);
    }
    
}
