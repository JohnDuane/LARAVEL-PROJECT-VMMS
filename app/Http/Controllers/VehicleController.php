<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Customer;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        $customers = Customer::all();

        return view('usermygarage', compact('vehicles', 'customers'));
    }

    public function store(Request $request)
    {
        
        Vehicle::create([
        'plate_number' => $request->plate_number,
        'make' => $request->make,
        'engine_model' => $request->engine_model,
        'customer_id' => $request->customer_id, // ✅ THIS MUST EXIST
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);

    $vehicle->update([
        'plate_number' => $request->plate_number,
        'make' => $request->make,
        'engine_model' => $request->engine_model,
        'customer_id' => $request->customer_id, // ✅ MUST ALSO EXIST
    ]);

    return redirect()->back();
}

    public function destroy($id)
    {
        Vehicle::find($id)->delete();
        return back();
    }
}