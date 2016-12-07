<?php

namespace App\Http\Controllers;

class WebController extends Controller
{
    /**
     * Displays a list of all available trips to manage.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Displays a view to manage the flight of a trip.
     *
     * @param $tripId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trip($tripId)
    {
        return view('trip',[
            'tripId' => $tripId
        ]);
    }
}
