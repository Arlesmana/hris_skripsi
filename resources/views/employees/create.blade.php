@extends('layouts.dashboard')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="fw-bold">Create Employee</h3>
                <p class="text-subtitle text-muted">Fill in the details to add a new employee to the system.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
            <h5 class="card-title mb-0 fs-5">
                <i class="bi bi-person-plus-fill me-2"></i> New Employee Data
            </h5>
        </div>
        
        <div class="card-body p-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    <!-- Left Column - Personal Information -->
                    <div class="col-12 col-md-6">
                        <h6 class="text-primary fw-bold mb-3">Personal Information</h6>

                        <div class="mb-3">
                            <label for="fullname" class="form-label"><i class="bi bi-person-fill"></i> Fullname</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required>
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label"><i class="bi bi-telephone-fill"></i> Phone Number</label>
                            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label"><i class="bi bi-house-door-fill"></i> Address</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="birth_date" class="form-label"><i class="bi bi-calendar-date-fill"></i> Birth Date</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column - Employment Details -->
                    <div class="col-12 col-md-6">
                        <h6 class="text-primary fw-bold mb-3">Employment Details</h6>

                        <div class="mb-3">
                            <label for="department_id" class="form-label"><i class="bi bi-building-fill"></i> Department</label>
                            <select class="form-select @error('department_id') is-invalid @enderror" name="department_id" required>
                                <option value="">Select a Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role_id" class="form-label"><i class="bi bi-briefcase-fill"></i> Role</label>
                            <select class="form-select @error('role_id') is-invalid @enderror" name="role_id" required>
                                <option value="">Select a Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label"><i class="bi bi-person-check-fill"></i> Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Select a Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="on leave" {{ old('status') == 'on leave' ? 'selected' : '' }}>On Leave</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="salary" class="form-label"><i class="bi bi-cash-stack"></i> Salary</label>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" required>
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2 px-4 py-2">
                        <i class="bi bi-arrow-left-circle me-2"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-save me-2"></i> Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
