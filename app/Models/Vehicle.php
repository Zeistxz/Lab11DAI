<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Customer;

class Vehicle extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
