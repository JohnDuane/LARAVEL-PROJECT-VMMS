<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle';
    protected $primaryKey = 'vehicle_id';

    protected $fillable = [
    'plate_number',
    'make',
    'engine_model',
    'customer_id'
    ];
}
