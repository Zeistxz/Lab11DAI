<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Vehicle;

class Customer extends Model
{
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
