<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'flight_number',
        'airline_code',
        'airport_departure_id',
        'airport_destination_id',
    ];
}
