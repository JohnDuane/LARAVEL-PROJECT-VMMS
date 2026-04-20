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
        Service::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->back();
    }
}
