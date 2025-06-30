<?php


namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Attendance;
use App\Models\Presence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
{

    $loggedInUser = Auth::user();
    $userName = $loggedInUser ? $loggedInUser->name : 'Guest';

    // Penghitungan jumlah karyawan
    $totalEmployees = Employee::count();
    $activeEmployees = Employee::where('status', 'active')->count();

    // Penghitungan jumlah tugas
    $totalTasks = Task::count();
    $doneTasks = Task::where('status', 'done')->count();
    $pendingTasks = Task::where('status', 'pending')->count();

    // Penghitungan jumlah absensi dan cuti
    $totalAttendances = Attendance::count(); // Menggunakan status 'absent' jika ada
    $pendingAttendances = Attendance::where('status', 'pending')->count();
    $cutiAttendances = Attendance::where('leave_type', 'cuti')->count();
    $sakitAttendances = Attendance::where('leave_type', 'sakit')->count();
    $replace_offAttendances = Attendance::where('leave_type', 'replace_off')->count();

    // Penghitungan jumlah presensi
    $totalPresences = Presence::count();
    $presentPresences = Presence::where('status', 'present')->count();
    $TidakHadirPresences = Presence::where('status', 'Tidak Hadir')->count();
   

    // Mengambil data karyawan untuk ditampilkan di view
    $employees = Employee::all();

    return view('dashboard.index', compact(
        'totalEmployees', 
        'activeEmployees', 
        'totalTasks', 
        'doneTasks', 
        'pendingTasks', 
        'totalAttendances',
        'pendingAttendances',
        'cutiAttendances', 
        'sakitAttendances', 
        'replace_offAttendances', 
        'totalPresences', 
        'presentPresences', 
        'TidakHadirPresences',
        'employees',
        'userName'
    ));
    }
    

}