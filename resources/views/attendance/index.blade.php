@extends('layouts.dashboard')

@section('content')
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
                    <a href="{{ route('attendances.create')}}" class="btn btn-primary mb-3 ms-auto">New Attendance</a>
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
                                    <span class="badge bg-success">Approved</span>
                                @elseif($attendance->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            
                            <td>
                            @if (session('role') == 'HR')
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                            <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                
                                <li>
                                    <a class="dropdown-item text-success" href="{{ route('attendances.approve', $attendance->id) }}">
                                        <i class="fas fa-check me-2"></i>Approve
                                    </a>
                                </li>
                                <li>
                                     <a class="dropdown-item text-danger" href="{{ route('attendances.reject', $attendance->id) }}">
                                        <i class="fas fa-times me-2"></i>Reject
                                     </a>
                                </li>
                            </ul>
                                <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif

                                <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-info btn-sm">Detail</a>
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