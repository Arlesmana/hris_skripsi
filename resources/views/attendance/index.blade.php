@extends('layouts.dashboard')

@section('content')
<style>
    /* Styling for a more elegant look */
    .card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        border: none;
    }
    
    .card-header h5 {
        font-weight: 600;
        color: #4b5563;
    }

    .table {
        border-collapse: separate;
        border-spacing: 0 0.5rem; /* Space between rows */
    }

    .table th {
        background-color: #f3f4f6; /* Tailwind's gray-100 */
        color: #1f2937; /* Tailwind's gray-800 */
        border-bottom: none;
        padding: 1rem;
    }

    .table td {
        background-color: #ffffff;
        border-top: none;
        padding: 1rem;
    }
    
    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }

    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
    }

    /* Styling for buttons with better visuals */
    .btn-primary {
        background-color: #4f46e5;
        border-color: #4f46e5;
        box-shadow: 0 2px 5px rgba(79,70,229,.2);
        transition: all 0.2s ease-in-out;
    }
    .btn-primary:hover {
        background-color: #4338ca;
        border-color: #4338ca;
        transform: translateY(-1px);
    }
    
    .btn-light {
        background-color: #f3f4f6;
        border-color: #f3f4f6;
        box-shadow: 0 2px 5px rgba(0,0,0,.05);
    }
    .btn-light:hover {
        background-color: #e5e7eb;
    }

    .btn-info {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: #fff;
        box-shadow: 0 2px 5px rgba(59,130,246,.2);
    }
    .btn-info:hover {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-warning {
        background-color: #f59e0b;
        border-color: #f59e0b;
        color: #fff;
        box-shadow: 0 2px 5px rgba(245,158,11,.2);
    }
    .btn-warning:hover {
        background-color: #d97706;
        border-color: #d97706;
    }

    .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
        box-shadow: 0 2px 5px rgba(239,68,68,.2);
    }
    .btn-danger:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .btn-sm {
      font-size: 0.8rem;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,.08);
    }
    .dropdown-item i {
        width: 1.25rem;
    }
</style>

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Attendance</h3>
                <p class="text-subtitle text-muted">Attendance</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Attendance</li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Data Attendance
                </h5>
            </div>
            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route('attendances.create')}}" class="btn btn-primary mb-3 ms-auto"><i class="bi bi-plus-lg me-1"></i> New Attendance</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Pengajuan</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->employee?->fullname ?? 'No Employee Assigned' }}</td>
                            <td>{{ $attendance->leave_type }}</td>
                            <td>{{ $attendance->start_date }}</td>
                            <td>{{ $attendance->end_date }}</td>
                            <td>
                                @if($attendance->status == 'approved')
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                                @elseif($attendance->status == 'pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle me-1"></i> Pending</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Rejected</span>
                                @endif
                            </td>
                            
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-info btn-sm"><i class="bi bi-file-earmark-text"></i></a>
                                    @if (session('role') == 'Admin')
                                    <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endif
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $attendance->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear-fill me-1"></i> Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $attendance->id }}">
                                            @if (session('role')== 'Admin' || session('role') == 'HR' ) 
                                                <li>
                                                    <a class="dropdown-item text-success" href="{{ route('attendances.approve', $attendance->id) }}">
                                                        <i class="bi bi-check-circle me-2"></i>Approve
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{ route('attendances.reject', $attendance->id) }}">
                                                        <i class="bi bi-x-circle me-2"></i>Reject
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
