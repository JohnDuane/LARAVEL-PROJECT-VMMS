<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('addservices', compact('services'));
    }

    public function store(Request $request)
{
    $request->validate([
        'job_desc' => 'required|string|max:255',
        'price' => 'required|numeric',
        'interval_value' => 'nullable|integer',
        'interval_unit' => 'nullable|string|max:20',
    ]);

    Service::create([
        'job_desc' => $request->job_desc,
        'price' => $request->price,
        'interval_value' => $request->interval_value,
        'interval_unit' => $request->interval_unit,
    ]);

    return back();
}

    public function update(Request $request, $id)
{
    $request->validate([
        'job_desc' => 'required|string|max:255',
        'price' => 'required|numeric',
        'interval_value' => 'nullable|integer',
        'interval_unit' => 'nullable|string|max:20',
    ]);

    $service = Service::findOrFail($id);

    $service->update([
        'job_desc' => $request->job_desc,
        'price' => $request->price,
        'interval_value' => $request->interval_value,
        'interval_unit' => $request->interval_unit,
    ]);

    return back();
}

    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->back();
    }
}
