<?php

use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    /**
     * The trip records to seed.
     *
     * @var array
     */
    protected $trips = [
        [
            'airport_departure_id' => 145,
            'airport_destination_id' => 192,
        ],
        [
            'airport_departure_id' => 192,
            'airport_destination_id' => 3881,
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert($this->trips);
    }
}
