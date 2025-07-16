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
                <h3 class="fw-bold">Employee Details</h3>
                <p class="text-subtitle text-muted">View detailed information of the employee</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Employees</li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-lg border-0 rounded-3 animate__animated animate__fadeIn animate__delay-1s">
            <div class="card-header bg-primary text-white text-center py-4">
                <h5 class="card-title mb-0">Employee Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column - Basic Info -->
                    <div class="col-12 col-md-6">
                        <div class="mb-4">
                            <label for="fullname" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-person-circle"></i> Full Name
                            </label>
                            <p class="fs-4 text-muted">{{ $employee->fullname }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <p class="fs-4 text-muted">{{ $employee->email }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-house-door"></i> Alamat
                            </label>
                            <p class="fs-4 text-muted">{{ $employee->address }}</p>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-telephone"></i> No Telepon
                            </label>
                            <p class="fs-4 text-muted">{{ $employee->phone_number }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-person-badge"></i> Role
                            </label>
                            <p class="fs-4 text-muted">{{ $employee->role->title }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="birth_date" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-calendar-date"></i> Birth Date
                            </label>
                            <p class="fs-4 text-muted">{{ \Carbon\Carbon::parse($employee->birth_date)->format('d M, Y') }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="hire_date" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-calendar-check"></i> Hire Date
                            </label>
                            <p class="fs-4 text-muted">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d M, Y') }}</p>
                        </div>
                    </div>

                    <!-- Right Column - Department, Status, Salary -->
                    <div class="col-12 col-md-6">
                        <div class="mb-4">
                            <label for="department" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-building"></i> Department
                            </label>
                            <p class="fs-4 text-muted">{{ $employee->department->name }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-person-check"></i> Status
                            </label>
                            <p class="fs-4">
                                @if($employee->status == 'active')
                                    <span class="badge bg-success text-white">{{ ucfirst($employee->status) }}</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ ucfirst($employee->status) }}</span>
                                @endif
                            </p>
                        </div>


                        <div class="mb-4">
                            <label for="salary" class="form-label fs-5 fw-bold text-dark">
                                <i class="bi bi-cash-stack"></i> Salary
                            </label>
                            <p class="fs-4 text-muted">{{ number_format($employee->salary, 0, ',', '.') }}</p>
                        </div>

                        
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-end mt-4">
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-primary px-4 py-2 rounded-3">
                        <i class="bi bi-arrow-left-circle-fill"></i> Back to Employee List
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection


