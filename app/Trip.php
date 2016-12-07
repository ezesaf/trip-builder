<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define a one-to-many relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
