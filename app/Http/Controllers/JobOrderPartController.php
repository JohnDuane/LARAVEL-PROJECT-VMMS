<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\JobOrderPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobOrderPartController extends Controller
{
    public function create($jobOrderId){
    $parts = Part::all();

    return view('job_order.parts', compact('parts', 'jobOrderId'));
    }

    public function store(Request $request){
    foreach ($request->parts as $index => $partId) {

        $qty = $request->qty[$index];
        $part = Part::find($partId);

        // ✅ STOCK CHECK
        $stock = DB::table('stockin')
            ->where('part_id', $partId)
            ->sum('quantity_recieved');

        if ($qty > $stock) {
            return back()->with('error', 'Not enough stock for ' . $part->part_name);
        }

        JobOrderPart::create([
            'job_order_id' => $request->job_order_id,
            'part_id' => $partId,
            'quantity' => $qty,
            'unit_cost' => $part->price,
            'amount' => $qty * $part->price
        ]);
    }

    return back()->with('success', 'Parts saved!');
}


public function showForm()
{
    $parts = Part::all(); // 🔥 GET DATA FROM DATABASE

    return view('joborderform', compact('parts'));
}


}
