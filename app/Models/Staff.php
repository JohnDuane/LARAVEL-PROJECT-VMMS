<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'staff_id';

    public $incrementing = true;

    protected $fillable = [
        'staff_name',
        'role',
        'contact_number'
    ];
}
