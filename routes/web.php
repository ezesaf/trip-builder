<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
    dd(request()->input('test'));
//    dd(decrypt('eyJpdiI6ImtWZmswYlRMZ2lKd3lqYURSR2xTNHc9PSIsInZhbHVlIjoiVEhtdWpwZEdGXC9wSUNtb1NEZW9aQnc9PSIsIm1hYyI6IjNlNGM3MTAzN2U0ZmYyZDEyZjhlYWRiN2FhNDNmNjNiZDg3NzVkMjljNmJmNDkzZjI3NTM0NmM1ODlkM2UyMDAifQ=='));
//    dd(app()->make(\App\APIs\Flights::class)->getFlightByNumber('AF400'));

});
