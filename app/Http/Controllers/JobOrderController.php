<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Part; // 🔥 ADD THIS

class JobOrderController extends Controller
{
    public function create()
{
    $mechanics = Staff::where('role', 'mechanic')->get();
    $parts = Part::all(); // 🔥 ADD THIS

    return view('joborderform', compact('mechanics', 'parts'));
}

public function store(Request $request)
{
    // TEMPORARY just to prevent error
    dd($request->all());
}
}
