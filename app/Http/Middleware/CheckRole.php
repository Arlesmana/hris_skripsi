<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Models\Employee; 

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Ambil role_id dari user yang sedang login
        $role_id = auth()->user()->role_id;
        employee::where('id', session('employee_id'))->get(); // Mengambil data employee berdasarkan session

        // Jika role_id tidak ada, return 403
        if (!$role_id) {
            return response()->view('403.403', [], 403);
        }   

        // Cari role berdasarkan role_id
        $role = Role::find($role_id);

        // Pastikan role ditemukan
        if (!$role) {
            // Jika role tidak ditemukan, return 403
            return response()->view('403.403', [], 403);
        }

        // Menyimpan data role dan role_id ke dalam session
        $request->session()->put('role', $role->title); // pastikan role ada
        $request->session()->put('role_id', $role->id);

        // Cek apakah role dari user ada di dalam array $roles
        if (! in_array($role->title, $roles)) {
            // Jika role tidak cocok, beri akses ditolak
            return response()->view('403.403', [], 403);
        }

        return $next($request);
    }
}
