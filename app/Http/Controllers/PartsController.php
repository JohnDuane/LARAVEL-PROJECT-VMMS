<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Supplier;
use App\Models\StockIn;
use App\Models\ViewPartStock;
use Illuminate\Support\Facades\DB;

class PartsController extends Controller
{
    // LOAD PAGE

public function index()
{
    $parts = ViewPartStock::all(); // 👈 now pulling from VIEW
    $suppliers = Supplier::all();

    return view('stockin', compact('parts', 'suppliers'));
}

    // STORE PART + STOCKIN
    public function store(Request $request)
{
    // ✅ VALIDATION
    $request->validate([
        'part_name' => 'required|string|max:100',
        'price' => 'nullable|numeric',
        'quantity_received' => 'nullable|integer|min:1',
        'cost_per_unit' => 'nullable|numeric'
    ]);

    // ✅ CREATE PART
    $part = Part::create([
        'part_name' => $request->part_name,
        'description' => $request->description,
        'price' => $request->price
    ]);

    // ✅ ONLY INSERT STOCK IF FILLED
    if ($request->quantity_received) {
        StockIn::create([
            'part_id' => $part->part_id,
            'supplier_id' => $request->supplier_id,
            'stock_in_arrived' => $request->stock_in_arrived,
            'quantity_received' => $request->quantity_received,
            'cost_per_unit' => $request->cost_per_unit
        ]);
    }

    return redirect()->back()->with('success', 'Part added successfully');
}


public function stockIn(Request $request, $id)
{
    $request->validate([
        'quantity_received' => 'required|integer|min:1',
        'cost_per_unit' => 'required|numeric'
    ]);

    StockIn::create([
        'part_id' => $id,
        'supplier_id' => $request->supplier_id,
        'stock_in_arrived' => $request->stock_in_arrived,
        'quantity_received' => $request->quantity_received,
        'cost_per_unit' => $request->cost_per_unit
    ]);

    return redirect()->back()->with('success', 'Stock added');
}

    // UPDATE PART
    public function update(Request $request, $id)
{
    $request->validate([
        'part_name' => 'required|string|max:100',
        'price' => 'nullable|numeric'
    ]);

    $part = Part::findOrFail($id);

    $part->update([
        'part_name' => $request->part_name,
        'description' => $request->description,
        'price' => $request->price
    ]);

    return redirect()->back()->with('success', 'Part updated');
}

    // DELETE PART
   public function delete($id)
{
    // ❗ Check if used in job orders
    $used = DB::table('job_order_parts')
        ->where('part_id', $id)
        ->exists();

    if ($used) {
        return redirect()->back()->with('error', 'Cannot delete: Part is already used in job orders');
    }

    DB::transaction(function () use ($id) {
        StockIn::where('part_id', $id)->delete();
        Part::destroy($id);
    });

    return redirect()->back()->with('success', 'Part deleted');
}

public function adjustStock(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer'
    ]);

    StockIn::create([
        'part_id' => $id,
        'quantity_received' => $request->quantity, // 🔥 can be + or -
        'stock_in_arrived' => now()
    ]);

    return redirect()->back()->with('success', 'Stock adjusted successfully');
}
}