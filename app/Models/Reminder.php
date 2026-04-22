<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'job_order_id',
        'description',
        'due_date',
        'status'
    ];
}
