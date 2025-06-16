@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold">Edit Employee</h3>
                <p class="text-muted">Update employee information carefully.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Employee</li>
                        <li class="breadcrumb-item active" aria-current="page">New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fullname" class="form-label fw-semibold">
                                <i class="bi bi-person-fill"></i> Fullname
                            </label>
                            <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" 
                                placeholder="Enter full name" value="{{ old('fullname', $employee->fullname) }}" required>
                            <div class="invalid-feedback">Please enter fullname.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill"></i> Email
                            </label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                placeholder="example@domain.com" value="{{ old('email', $employee->email) }}" required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="phone_number" class="form-label fw-semibold">
                                <i class="bi bi-telephone-fill"></i> Phone Number
                            </label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" 
                                placeholder="e.g. +628123456789" value="{{ old('phone_number', $employee->phone_number) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label fw-semibold">
                                <i class="bi bi-geo-alt-fill"></i> Address
                            </label>
                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" 
                                placeholder="Enter address" value="{{ old('address', $employee->address) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="birth_date" class="form-label fw-semibold">
                                <i class="bi bi-calendar-event-fill"></i> Birth Date
                            </label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                                value="{{ old('birth_date', $employee->birth_date) }}" required>
                            <div class="invalid-feedback">Please select birth date.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="hire_date" class="form-label fw-semibold">
                                <i class="bi bi-calendar-check-fill"></i> Hire Date
                            </label>
                            <input type="date" name="hire_date" id="hire_date" class="form-control @error('hire_date') is-invalid @enderror" 
                                value="{{ old('hire_date', $employee->hire_date) }}" required>
                            <div class="invalid-feedback">Please select hire date.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="department_id" class="form-label fw-semibold">
                                <i class="bi bi-building"></i> Department
                            </label>
                            <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ (old('department_id', $employee->department_id) == $department->id) ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select department.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label fw-semibold">
                                <i class="bi bi-person-badge-fill"></i> Role
                            </label>
                            <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ (old('role_id', $employee->role_id) == $role->id) ? 'selected' : '' }}>
                                        {{ $role->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select role.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label fw-semibold">
                                <i class="bi bi-toggle-on"></i> Status
                            </label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <div class="invalid-feedback">Please select status.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="salary" class="form-label fw-semibold">
                                <i class="bi bi-currency-dollar"></i> Salary
                            </label>
                            <input type="number" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" 
                                placeholder="Enter salary" value="{{ old('salary', $employee->salary) }}" required>
                            <div class="invalid-feedback">Please enter salary.</div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update Employee
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

@endsection
