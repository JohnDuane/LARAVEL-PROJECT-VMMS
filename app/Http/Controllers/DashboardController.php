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
    $totalJobOrders = ViewJobOrder::count();
    $totalReminders = Reminder::where('status', 'pending')->count();

    $pendingCount = Reminder::where('status', 'pending')
        ->whereDate('due_date', '>=', Carbon::today())
        ->count();

    $overdueCount = Reminder::where('status', 'pending')
        ->whereDate('due_date', '<', Carbon::today())
        ->count();

    $totalAlerts = $pendingCount + $overdueCount;

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

    $labels = [];
    $data = [];

    if ($jobOrders->isEmpty()) {
        $labels = ['No Data Yet'];
        $data = [0];
    }

    foreach ($jobOrders as $order) {
        $year = substr($order->week, 0, 4);
        $week = substr($order->week, 4);

        $labels[] = "Week $week";
        $data[] = $order->total;
    }

    return view('userdash', compact(
        'totalVehicles', 
        'totalJobOrders', 
        'totalReminders', 
        'pendingCount',
        'overdueCount',
        'totalAlerts',
        'labels',      // ✅ ADD THIS
        'data'         // ✅ ADD THIS
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
