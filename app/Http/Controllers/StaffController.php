<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = \App\Models\Staff::all(); // fetch data
        return view('addmechanic', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $mechanics = Staff::where('role', 'mechanic')->get();
        // return view('joborderform', compact('mechanics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Staff::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, staff $staff)
    {
        Staff::where('staff_id', $request->staff_id)->update([
            'staff_name' => $request->staff_name,
            'role' => $request->role,
            'contact_number' => $request->contact_number
        ]);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Staff::where('staff_id', $request->staff_id)->delete();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(staff $staff)
    {
        //
    }
}
