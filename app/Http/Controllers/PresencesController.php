<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Employee;

class PresencesController extends Controller
{
    public function index()
    {
        if (session('role') == 'Admin' || session('role') == 'HR') {
            $presences = Presence::all();
        } else {
            $presences = Presence::where('employee_id', session('employee_id'))->get();
        }

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

    public function recap()
    {
        // Mengambil data presensi berdasarkan peran (Admin atau HR) atau hanya untuk karyawan yang login
        if (session('role') == 'Admin' || session('role') == 'HR') {
            $presencesQuery = Presence::with('employee');
        } else {
            $presencesQuery = Presence::with('employee')->where('employee_id', session('employee_id'));
        }

        $presences = $presencesQuery->get();

        // Mengelompokkan dan menghitung rekap presensi per karyawan
        $summary = $presences->groupBy('employee_id')->map(function ($items, $employeeId) {
            $employee = $items->first()->employee;
            return [
                'employee_name' => $employee->fullname,
                'present' => $items->where('status', 'present')->count(),
                'absent' => $items->where('status', 'Tidak Hadir')->count(), // Diperbaiki: Menggunakan 'Tidak Hadir'
                'sick' => $items->where('status', 'Sakit')->count(),
                'leave' => $items->where('status', 'Izin')->count(),
            ];
        });

        // Menghitung total keseluruhan untuk kartu di atas
        $total_present = $summary->sum('present');
        $total_absent = $summary->sum('absent');
        $total_sick = $summary->sum('sick');
        $total_leave = $summary->sum('leave');

        // Meneruskan semua variabel ke view
        return view('presences.recap', compact('summary', 'total_present', 'total_absent', 'total_sick', 'total_leave'));
    }
}
