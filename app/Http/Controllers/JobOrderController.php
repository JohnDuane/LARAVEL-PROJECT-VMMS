<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Customer;
use App\Models\Vehicle;
use Carbon\Carbon;
use App\Models\Reminder;
use App\Models\Service;

use App\Models\Staff;
use App\Models\Part;

class JobOrderController extends Controller
{
    public function create()
{
    $customers = Customer::all();
    $vehicles = Vehicle::all();
    $services = Service::all();
    $mechanics = Staff::where('role', 'mechanic')->get();
    $parts = Part::all();

    return view('joborderform', compact(
        'customers', 
        'vehicles', 
        'services', 
        'mechanics', 
        'parts'));
}

public function index(Request $request)
{
    $query = \App\Models\ViewJobOrder::query();

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->search) {
        $query->where('cust_name', 'like', "%{$request->search}%");
    }

    $data = $query->orderBy('job_order_id', 'desc')->get();

    return view('joborders.index', compact('data'));
}

public function store(Request $request)
{
    // TEMP DEBUG (optional)
    // dd($request->all());

    $request->validate([
        'customer_id' => 'required',
        'vehicle_id' => 'required',
        'staff_id' => 'required',
        'date_issued' => 'required|date',
    ]);

    $job = \App\Models\JobOrder::create([
        'customer_id' => $request->customer_id,
        'vehicle_id' => $request->vehicle_id,
        'staff_id' => $request->staff_id,
        'date_issued' => $request->date_issued,
        'status' => 'Pending',
        'total_cost' => $request->total_cost,
    ]);

    // SAVE SERVICES
if ($request->services) {
    foreach ($request->services as $serviceId) {
        $job->services()->attach($serviceId);
    }
}

// SAVE PARTS
// SAVE PARTS + DEDUCT STOCK
if ($request->parts) {
    foreach ($request->parts as $index => $partId) {

        $qty = $request->qty[$index];

        // 🔥 CHECK STOCK FIRST
        $stock = \DB::table('view_part_stock')
            ->where('part_id', $partId)
            ->value('stock');

        if ($qty > $stock) {
            return back()->with('error', 'Not enough stock for selected part');
        }

        // ✅ SAVE JOB ORDER PART
        \DB::table('job_order_parts')->insert([
            'job_order_id' => $job->job_order_id,
            'part_id' => $partId,
            'quantity' => $qty,
        ]);

        // ✅ 🔥 DEDUCT STOCK
        \DB::table('stockin')->insert([
            'part_id' => $partId,
            'quantity_received' => -$qty, // NEGATIVE = STOCK OUT
            'stock_in_arrived' => now()
        ]);
    }
}

// 🔥 AUTO CREATE REMINDERS
foreach ($job->services as $service) {

    if ($service->interval_value && $service->interval_unit) {

        $dueDate = \Carbon\Carbon::now()->add(
            $service->interval_unit,
            $service->interval_value
        );

        \App\Models\Reminder::create([
            'job_order_id' => $job->job_order_id,
            'service_id'   => $service->service_id,
            'description'  => $service->job_desc . ' maintenance',
            'due_date'     => $dueDate,
            'status'       => 'pending',
            'type'         => 'auto',
        ]);
    }
}

    return redirect()->back()
    ->with('success', 'Job order has been added!')
    ->with('job_order_id', $job->job_order_id);
    
}

public function servicesHistory()
{
    $data = \App\Models\ViewJobOrder::all();

    return view('serviceshistory', compact('data'));
}

public function generatePDF($id)
{
    $job = \App\Models\JobOrder::findOrFail($id);

// GET CUSTOMER + VEHICLE + MECHANIC (from view or joins)
$view = \App\Models\ViewJobOrder::where('job_order_id', $id)->first();

$services = \DB::table('job_order_services')
    ->join('services', 'job_order_services.service_id', '=', 'services.service_id')
    ->where('job_order_services.job_order_id', $id)
    ->select('services.job_desc as name', 'services.price')
    ->get();

$parts = \DB::table('job_order_parts')
    ->join('part', 'job_order_parts.part_id', '=', 'part.part_id')
    ->where('job_order_parts.job_order_id', $id) // ✅ IMPORTANT
    ->select(
        'part.part_name as name',
        'part.price',
        'job_order_parts.quantity as qty'
    )
    ->get();

// CALCULATE TOTALS
$services_total = $services->sum('price');

$parts_total = $parts->sum(function ($p) {
    return $p->price * $p->qty;
});

return Pdf::loadView('pdf.job-order', [
    'job' => $job,
    'view' => $view,
    'services' => $services,
    'parts' => $parts,
    'services_total' => $services_total,
    'parts_total' => $parts_total,
])->stream('job-order.pdf');

    $data = [
        'job' => $job
    ];

    $pdf = Pdf::loadView('pdf.job-order', $data);

    return $pdf->stream('job-order.pdf');
}

public function completeJob($id)
{
    $job = JobOrder::findOrFail($id);
    $job->status = 'completed';
    $job->save();

    // 🔥 DEBUG: check if services exist
    if ($job->services->isEmpty()) {
        dd('NO SERVICES FOUND FOR THIS JOB'); // REMOVE AFTER TEST
    }

    foreach ($job->services as $service) {

        if ($service->interval_value && $service->interval_unit) {

            $dueDate = Carbon::now()->add(
                $service->interval_unit,
                $service->interval_value
            );

            Reminder::create([
                'job_order_id' => $job->job_order_id,
                'service_id'   => $service->service_id, // ✅ FIXED
                'description'  => $service->job_desc . ' maintenance', // ✅ FIXED
                'due_date'     => $dueDate,
                'status'       => 'pending',
                'type'         => 'auto',
            ]);
        }
    }

    return back()->with('success', 'Job completed + reminders generated!');
}


}
