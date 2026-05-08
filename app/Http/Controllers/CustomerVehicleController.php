<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerVehicleController extends Controller
{
    public function index()
    {
        $customers = DB::table('customer')
            ->leftJoin('vehicle', 'customer.id', '=', 'vehicle.customer_id')
            ->select(
                'customer.id',
                DB::raw("CONCAT(customer.first_name, ' ', IFNULL(customer.middle_name, ''), ' ', customer.last_name) as cust_name"),
                'customer.contact_number',
                'vehicle.vehicle_id',
                'vehicle.plate_number',
                'vehicle.make',
                'vehicle.engine_model'
            )
            ->get()
            ->groupBy('id'); // 🔥 GROUP BY CUSTOMER

        return view('viewcustomervehicles', compact('customers'));
    }
}
