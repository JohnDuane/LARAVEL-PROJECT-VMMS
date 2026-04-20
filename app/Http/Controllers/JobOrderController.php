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
    // TEMP DEBUG (optional)
    // dd($request->all());

    $request->validate([
        'customer_id' => 'required',
        'vehicle_id' => 'required',
        'staff_id' => 'required',
        'date_issued' => 'required|date',
        'status' => 'required',
    ]);

    $job = \App\Models\JobOrder::create([
        'customer_id' => $request->customer_id,
        'vehicle_id' => $request->vehicle_id,
        'staff_id' => $request->staff_id,
        'date_issued' => $request->date_issued,
        'status' => $request->status,
        'total_cost' => $request->total_cost,
    ]);

    return redirect()->back()->with('success', 'Saved!');
}
}
