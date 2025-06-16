<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Employee;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string...$roles): Response
    {
        $employeeID = auth()->user()->employee_id; 
        
        $employee = Employee::find($employeeID);

        $request->session()->put('role', $employee->role->title);
        $request->session()->put('employee_id', $employee->id);


        // Cek role
        if (! in_array($employee->role->title, $roles)) {
        // Bisa pilih salah satu:
        // abort(403, 'Access denied for this role.!');
        // atau:
        return response()->view('403.403', [], 403);
    }

        return $next($request);
    }
}
