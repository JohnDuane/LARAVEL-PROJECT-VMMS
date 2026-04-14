<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class JobOrderController extends Controller
{
    public function create()
    {
        $mechanics = Staff::where('role', 'mechanic')->get();
        return view('joborderform', compact('mechanics'));
    }
}
