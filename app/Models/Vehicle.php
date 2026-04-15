<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle';

    protected $fillable = [
    'customer_id',
    'plate_number',
    'make',
    'engine_model'
    ];
}
