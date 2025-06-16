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
                <h3>Attendance Details</h3>
                <p class="text-subtitle text-muted">View attendance data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Attendance</li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Attendance Information
                </h5>
            </div>
            
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Attendance Details -->
                <div class="mb-3">
                    <label for="employee" class="form-label">Employee</label>
                    <p class="form-control-plaintext">{{ $attendance->employee->fullname }}</p>
                </div>

                <div class="mb-3">
                    <label for="leave_type" class="form-label">Leave Type</label>
                    <p class="form-control-plaintext">{{ ucfirst($attendance->leave_type) }}</p>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($attendance->start_date)->format('d M Y') }}</p>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($attendance->end_date)->format('d M Y') }}</p>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Description</label>
                    <p class="form-control-plaintext">{{ $attendance->deskripsi ?? 'No description provided' }}</p>
                </div>
                
                <!-- Back Button -->
                <div class="text-end mt-4">
                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-primary px-4 py-2 rounded-3">
                        <i class="bi bi-arrow-left-circle-fill"></i> Back to Attendance List
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
