<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFksToTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->foreign('airport_departure_id', 'fk_trips_airports_airport_departure_id')
                ->references('id')
                ->on('airports')
                ->onDelete('cascade');

            $table->foreign('airport_destination_id', 'fk_trips_airports_airport_destination_id')
                ->references('id')
                ->on('airports')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign('fk_trips_airports_airport_departure_id');
            $table->dropForeign('fk_trips_airports_airport_destination_id');
        });
    }
}
