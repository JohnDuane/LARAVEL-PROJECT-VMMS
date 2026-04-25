<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $table = 'stockin';
    protected $primaryKey = 'stock_in_id';

    protected $fillable = [
        'supplier_id',
        'part_id',
        'stock_in_arrived',
        'quantity_received',
        'cost_per_unit'
    ];
}
