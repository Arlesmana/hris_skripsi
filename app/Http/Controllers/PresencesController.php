<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Employee;



class PresencesController extends Controller
{
    public function index()
    {
        
        if (session('role')== 'HR')
        $presences = presence::all();
        else
        $presences = Presence::where('employee_id', session('employee_id'))->get();
       
        return view('presences.index', compact('presences'));
    }
    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',   
            'check_out' => 'nullable|date_format:H:i',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        Presence::create($request->all());

        return redirect()->route('presences.index')->with('success', 'Presence recorded successfully.');

    }
    public function edit(Presence $presence)
    {
        $employees = Employee::all();

        return view('presences.edit', compact('presence', 'employees'));
    }
    public function update(Request $request, Presence $presence)
    {
        $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',   
            'check_out' => 'required',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        $presence->update($request->all());

        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }
    
    
    public function destroy($id)
    {
        $presence = Presence::findOrFail($id);
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }

}
