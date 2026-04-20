<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    protected $table = 'job_order';

    protected $primaryKey = 'job_order_id';

    public $incrementing = true;

    protected $fillable = [
    'customer_id',
    'vehicle_id',
    'staff_id',
    'date_issued',
    'total_cost',
    'status'
];
}
