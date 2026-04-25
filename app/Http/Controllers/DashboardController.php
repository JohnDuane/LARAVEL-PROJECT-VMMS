<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\ViewJobOrder;
use App\Models\Reminder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalJobOrders = ViewJobOrder::count();
        $totalReminders = Reminder::where('status', 'pending')->count();

        $pendingCount = Reminder::where('status', 'pending')
            ->whereDate('due_date', '>=', Carbon::today())
            ->count();

        $overdueCount = Reminder::where('status', 'pending')
            ->whereDate('due_date', '<', Carbon::today())
            ->count();

        $totalAlerts = $pendingCount + $overdueCount;

        return view('userdash', compact(
            'totalVehicles', 
            'totalJobOrders', 
            'totalReminders', 
            'pendingCount',
            'overdueCount',
            'totalAlerts')
            );
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
