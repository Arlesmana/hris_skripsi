@extends('layouts.dashboard')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="fw-bold">Employee Details</h3>
                    <p class="text-subtitle text-muted">View detailed information of the employee.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white text-center py-4">
                <h4 class="card-title mb-0 fs-5 fw-bold">
                    <i class="bi bi-person-badge-fill me-2"></i> Employee Profile
                </h4>
            </div>
            <div class="card-body p-5">
                <div class="row g-5">
                    <div class="col-12 col-md-6">
                        <h5 class="text-primary mb-4 fw-bold border-bottom pb-2">Personal Information</h5>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-person-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Full Name</h6>
                                <p class="fs-5 fw-bold mb-0">{{ $employee->fullname }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-envelope-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Email</h6>
                                <p class="fs-5 fw-bold mb-0">{{ $employee->email }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-telephone-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Phone Number</h6>
                                <p class="fs-5 fw-bold mb-0">{{ $employee->phone_number }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-house-door-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Address</h6>
                                <p class="fs-5 fw-bold mb-0">{{ $employee->address }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-calendar-date-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Birth Date</h6>
                                <p class="fs-5 fw-bold mb-0">{{ \Carbon\Carbon::parse($employee->birth_date)->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <h5 class="text-primary mb-4 fw-bold border-bottom pb-2">Employment Details</h5>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-building-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Department</h6>
                                <p class="fs-5 fw-bold mb-0">{{ $employee->department->name }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-briefcase-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Role</h6>
                                <p class="fs-5 fw-bold mb-0">{{ $employee->role->title }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-cash-stack fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Salary</h6>
                                <p class="fs-5 fw-bold mb-0">Rp{{ number_format($employee->salary, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-calendar-check-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Hire Date</h6>
                                <p class="fs-5 fw-bold mb-0">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d M, Y') }}</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-person-check-fill fs-3 text-secondary me-3"></i>
                            <div>
                                <h6 class="text-muted mb-0">Status</h6>
                                <p class="fs-5 fw-bold mb-0">
                                    @if($employee->status == 'active')
                                        <span class="badge rounded-pill bg-success text-white px-3 py-2">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger text-white px-3 py-2">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light border-0 text-end py-4">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                    <i class="bi bi-arrow-left me-2"></i> Back to Employee List
                </a>
            </div>
        </div>
    </section>

@endsection