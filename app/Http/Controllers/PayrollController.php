<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;



class PayrollController extends Controller
{
    public function index()
    {
        if (session('role')== 'Admin' || session('role') == 'HR')
        $payrolls = Payroll::all();
        else
        $payrolls = Payroll::where('employee_id', session('employee_id'))->get();
        $employees = Employee::all();
        return view('payroll.index', compact('payrolls', 'employees'));
    }
    
    
    public function create()
    {
        $employees = Employee::all();
        return view('payroll.create', compact('employees'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric', 
            'bonuses' => 'nullable|numeric', 
            'deductions' => 'nullable|numeric', 
            'pay_date' => 'required|date',
            
        ]);


        if (!$request->has('net_salary')) {
            $netSalary = $request->salary + ($request->bonuses ?? 0) - ($request->deductions ?? 0);
            $request->merge(['net_salary' => $netSalary]);
        }

        Payroll::create($request->all());

        return redirect()->route('payrolls.index')->with('success', 'payroll recorded successfully.');

    }
    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('payroll.edit', compact('payroll', 'employees'));
    }
    public function update(Request $request, Payroll $payroll)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric',
            'bonuses' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'pay_date' => 'required|date',
        ]);
        if (!$request->has('net_salary')) {
            $netSalary = $request->salary + ($request->bonuses ?? 0) - ($request->deductions ?? 0);
            $request->merge(['net_salary' => $netSalary]);
        }
        $payroll->update($request->all());
        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully.');   
    }
     public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('payrolls.index')->with('success', 'Payrolls deleted successfully.');
    }
    public function show(Payroll $payroll)
    {
        return view('payroll.show', compact('payroll'));

    }
    
}
