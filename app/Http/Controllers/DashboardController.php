<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\ViewJobOrder;
use App\Models\Reminder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    // 🔢 Existing stats
    $totalVehicles = Vehicle::count();
    $totalJobOrders = DB::table('job_order')->count();
    $totalReminders = Reminder::where('status', 'pending')->count();

    $pendingCount = Reminder::where('status', 'pending')
        ->whereDate('due_date', '>', Carbon::today())
        ->count();

    $overdueCount = Reminder::where('status', 'pending')
        ->whereDate('due_date', '<', Carbon::today())
        ->count();

    $totalAlerts = $totalReminders;

    // 📊 ADD THIS (your chart logic)
    $jobOrders = DB::table('job_order')
        ->select(
            DB::raw('YEARWEEK(created_at, 1) as week'),
            DB::raw('COUNT(*) as total')
        )
        ->whereNotNull('created_at')
        ->groupBy('week')
        ->orderBy('week')
        ->get();

    $count = 1;


    $labels = [];
    $data = [];

    if ($jobOrders->isEmpty()) {
        $labels = ['No Data Yet'];
        $data = [0];
    } else {
        $count = 1;
        foreach ($jobOrders as $order) {
            $labels[] = 'Week ' . $count++;
            $data[] = $order->total;
        }
    }

    return view('dashboard', compact(
        'totalVehicles', 
        'totalJobOrders', 
        'totalReminders', 
        'pendingCount',
        'overdueCount',
        'totalAlerts',
        'labels',
        'data'
    ));
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
