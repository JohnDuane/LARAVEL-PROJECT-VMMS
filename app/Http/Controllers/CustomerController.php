<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        Customer::create([
            'cust_name' => $request->cust_name,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ]);

        return redirect()->route('userdash')->with('success', 'Customer added!');
    }

    public function index()
{
    $customers = Customer::all(); // 🔥 GET DATA

    return view('addcustomer', compact('customers'));
}

public function update(Request $request)
{
    \App\Models\Customer::where('id', $request->id)->update([
        'cust_name' => $request->cust_name,
        'contact_number' => $request->contact_number,
        'address' => $request->address
    ]);

    return back();
}

public function delete(Request $request)
{
    \App\Models\Customer::where('id', $request->id)->delete();
    return back();
}
}