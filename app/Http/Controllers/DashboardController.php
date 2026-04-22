<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\ViewJobOrder;
use App\Models\Reminder;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalJobOrders = ViewJobOrder::count();
        $totalReminders = Reminder::where('status', 'pending')->count();

        return view('userdash', compact('totalVehicles', 'totalJobOrders', 'totalReminders'));
    }

    public function remindersPage()
    {
    $jobOrders = ViewJobOrder::get();

    return view('reminders', compact('jobOrders'));
    }

    public function storeReminder(Request $request)
    {
    Reminder::create([
        'job_order_id' => $request->job_order_id,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Reminder created!');
    }

    
}
