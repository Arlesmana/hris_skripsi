<?php

namespace App\Http\Controllers;
use App\Models\attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
    if (session('role')== 'Admin' || session('role') == 'HR')
    $attendances = Attendance::all();  // Ambil semua data kehadiran dari model Attendance
    else
    $attendances = Attendance::where('employee_id', session('employee_id'))->get(); 
    // Ambil data kehadiran berdasarkan employee_id dari session
    return view('attendance.index', compact('attendances'));  // Gunakan 'attendances' di sini
    }   
    public function create()

    {
        $employees = Employee::all();  // Ambil semua data karyawan dari model Employee

        return view('attendance.create', compact('employees'));  // Gunakan 'employees' di sini
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'deskripsi' => 'nullable|string',
            
        ]);

        $request->merge([
            'status' => 'pending',  // Set status default sebagai 'pending'
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }

    public function edit(Attendance $attendance)
    {
       
        $employees = Employee::all();  // Ambil semua data karyawan dari model Employee

        return view('attendance.edit', compact('attendance','employees'));  // Gunakan 'attendance' dan 'employees' di sini
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
    public function approve($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update(['status' => 'approved']);

        return redirect()->route('attendances.index')->with('success', 'Attendance approved successfully.');
    }
    public function reject($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update(['status' => 'rejected']);

        return redirect()->route('attendances.index')->with('success', 'Attendance rejected successfully.');
    }
    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

}
