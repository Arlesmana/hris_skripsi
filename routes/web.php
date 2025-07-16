<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PresencesController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect()->route('login'); // Arahkan ke halaman login jika belum login
})->name('welcome');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['role:HR,IT,Developer']);

    //handle employee
    Route::resource('/employees', EmployeeController::class)->middleware(['role:HR,IT,Developer']);

    //handle Users
    Route::resource('/users', UserController::class)->middleware(['role:HR,IT,Developer']);
   
    //handle depatments
    Route::resource('/departments', DepartmentController::class)->middleware(['role:HR']);

    //handle Role
    Route::resource('/roles', RoleController::class)->middleware(['role:HR']);

    //handle presence
    Route::resource('/presences', presencesController::class)->middleware(['role:HR,IT,Developer']);

    //handle payroll
    Route::resource('/payrolls', payrollController::class)->middleware(['role:HR,IT,Developer']);

    //handle attendance
    Route::resource('attendances', AttendanceController::class)->middleware(['role:HR,Developer,IT']);
    Route::get('attendances/approve/{id}', [AttendanceController::class, 'approve'])->name('attendances.approve')->middleware(['role:HR']);
    Route::get('attendances/reject/{id}', [AttendanceController::class, 'reject'])->name('attendances.reject')->middleware(['role:HR']);

    //handle task 
    Route::resource('/tasks', TaskController::class)->middleware(['role:HR,IT,Developer']);
    Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done')->middleware(['role:HR']);
    Route::get('tasks/pending/{id}', [TaskController::class, 'done'])->name('tasks.pending')->middleware(['role:HR']);  



});

    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
