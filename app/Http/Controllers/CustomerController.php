<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request)
{
    Customer::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'contact_number' => $request->contact_number,
        'address' => $request->address,
    ]);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'customer_id' => $customer->id
        ]);
    }

    // 🔁 fallback (your original behavior)
    return redirect()->route('userdash')->with('success', 'Customer added!');
}

    public function index()
{
    $customers = Customer::all();

    return view('addcustomer', compact('customers'));
}

public function update(Request $request)
{
    \App\Models\Customer::where('id', $request->id)->update([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'contact_number' => $request->contact_number,
        'address' => $request->address,
    ]);

    return back();
}

public function delete(Request $request)
{
    \App\Models\Customer::where('id', $request->id)->delete();
    return back();
}
}