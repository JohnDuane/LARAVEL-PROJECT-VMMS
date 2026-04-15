<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Service;

use App\Models\Staff;
use App\Models\Part;

class JobOrderController extends Controller
{
    public function create()
{
    $customers = Customer::all();
    $vehicles = Vehicle::all();
    $services = Service::all();
    $mechanics = Staff::where('role', 'mechanic')->get();
    $parts = Part::all();

    return view('joborderform', compact(
        'customers', 
        'vehicles', 
        'services', 
        'mechanics', 
        'parts'));
}

public function store(Request $request)
{
    dd($request->all());
}
}
