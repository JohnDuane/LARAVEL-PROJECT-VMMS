<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerVehicleController extends Controller
{
    public function index()
    {
        $vehicles = CustomerVehicle::all();

        return view('customer-vehicles', compact('vehicles'));
    }
}
