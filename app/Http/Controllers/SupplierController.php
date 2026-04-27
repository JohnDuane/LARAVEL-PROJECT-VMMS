<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('addsupplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        Supplier::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->back();
    }

    public function delete($id)
    {
        Supplier::destroy($id);
        return redirect()->back();
    }
}
