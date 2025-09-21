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

    .form-label {
        font-weight: 500;
        color: #4b5563;
        margin-bottom: 0.25rem;
    }

    .form-control-plaintext {
        padding-left: 0.5rem;
        font-weight: 400;
        color: #1f2937;
        padding-top: 0;
        padding-bottom: 0;
        border-bottom: 1px solid #e5e7eb; /* Subtle line below each data point */
        margin-bottom: 1rem;
        min-height: 2.5rem; /* Ensure consistent height for all fields */
        display: flex;
        align-items: center;
    }

    .form-control-plaintext:last-of-type {
        border-bottom: none;
    }

    .detail-container .col-md-6:first-child {
        border-right: 1px solid #e5e7eb;
    }
    
    .detail-container .col-md-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
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
    
    .badge {
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.5em 0.7em;
        border-radius: 0.5rem;
        vertical-align: middle;
    }

    /* New styles for a more polished look */
    .detail-item {
        padding: 0.5rem 0;
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
                
                <div class="row detail-container">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employee" class="form-label"><i class="bi bi-person-fill me-1"></i> Employee</label>
                            <p class="form-control-plaintext">{{ $attendance->employee->fullname }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="leave_type" class="form-label"><i class="bi bi-calendar-minus-fill me-1"></i> Leave Type</label>
                            <p class="form-control-plaintext">{{ ucfirst($attendance->leave_type) }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label"><i class="bi bi-check-circle-fill me-1"></i> Status</label>
                            <div class="form-control-plaintext">
                                @if($attendance->status == 'approved')
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                                @elseif($attendance->status == 'pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle me-1"></i> Pending</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Rejected</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label"><i class="bi bi-calendar-date-fill me-1"></i> Start Date</label>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($attendance->start_date)->format('d M Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label"><i class="bi bi-calendar-date-fill me-1"></i> End Date</label>
                            <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($attendance->end_date)->format('d M Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label"><i class="bi bi-file-text-fill me-1"></i> Description</label>
                            <p class="form-control-plaintext">{{ $attendance->deskripsi ?? 'No description provided' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Back Button -->
                <div class="text-end mt-4">
                    <a href="{{ route('attendances.index') }}" class="btn btn-primary px-4 py-2 rounded-3">
                        <i class="bi bi-arrow-left-circle-fill me-1"></i> Back to Attendance List
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
