@extends('layouts.dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
    <h3>Welcome back, {{ $userName }} 👌</h3>
</div> 

<div class="page-content"> 
    <section class="row">
        <!-- Tasks Section -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4>Tasks</h4>
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Total Tasks</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalTasks }}</h6>
                        </li>
                        <h6>Status</h6>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Done</h6>
                            <h6 class="font-extrabold mb-0">{{ $doneTasks }}</h6>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Pending</h6>
                            <h6 class="font-extrabold mb-0">{{ $pendingTasks }}</h6>
                        </li>  
                    </ul>
                </div>
            </div>
        </div>

        <!-- Employee Section -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                    <h4>Employees</h4>
                    <i class="bi bi-person-fill fs-4"></i>
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Total Employees</h6>
                    <h6 class="font-extrabold mb-0">{{ $totalEmployees }}</h6>
                    <h6 class="text-muted">Active Employees</h6>
                    <h6 class="font-extrabold mb-0">{{ $activeEmployees }}</h6>
                </div>
            </div>
        </div>

        <!-- Attendance Section -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-warning text-white">
                    <h4>Attendance</h4>
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Total Absent</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalAttendances }}</h6>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Pending</h6>
                            <h6 class="font-extrabold mb-0">{{ $pendingAttendances }}</h6>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Cuti</h6>
                            <h6 class="font-extrabold mb-0">{{ $cutiAttendances }}</h6>
                        </li>  
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Sakit</h6>
                            <h6 class="font-extrabold mb-0">{{ $sakitAttendances }}</h6>
                        </li><li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Replace Off</h6>
                            <h6 class="font-extrabold mb-0">{{ $replace_offAttendances }}</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Online Presence Section -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <h4>Rekap Presence</h4>
                    <i class="bi bi-globe fs-4"></i>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Total Presence</h6>
                            <h6 class="font-extrabold mb-0">{{ $totalPresences }}</h6>
                        </li>
                        <h6>Status</h6>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Hadir</h6>
                            <h6 class="font-extrabold mb-0">{{ $presentPresences }}</h6>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="text-muted">Tidak Hadir</h6>
                            <h6 class="font-extrabold mb-0">{{ $TidakHadirPresences }}</h6>
                        </li>  
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection