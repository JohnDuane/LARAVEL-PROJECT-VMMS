<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\ViewJobOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalJobOrders = ViewJobOrder::count();

        $totalReminders = 0;


        return view('userdash', compact('totalVehicles', 'totalJobOrders', 'totalReminders'));
    }
}
