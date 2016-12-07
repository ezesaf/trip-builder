<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('airports', 'AirportController@index');

Route::get('airports/paginated', 'AirportController@indexPaginated');

Route::get('trips', 'TripController@index');

Route::get('trips/{tripId}/available-flights', 'TripController@availableFlights');

Route::get('trips/{tripId}/flights', 'TripController@flights');

Route::post('trips/{tripId}/flights', 'FlightController@store');

Route::delete('flights/{flightId}', 'FlightController@delete');


