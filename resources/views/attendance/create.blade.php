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
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.25rem rgba(79,70,229,.25);
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

    .btn-secondary {
        background-color: #6b7280;
        border-color: #6b7280;
        color: #fff;
        box-shadow: 0 2px 5px rgba(107,114,128,.2);
        transition: all 0.2s ease-in-out;
    }
    .btn-secondary:hover {
        background-color: #4b5563;
        border-color: #4b5563;
        transform: translateY(-1px);
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
                <p class="text-subtitle text-muted">Create Attendance data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Attendance</li>
                        <li class="breadcrumb-item active" aria-current="page">New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Create Attendance
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
                
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
        
                    <div class="mb-3">
                        <label for="employee" class="form-label"><i class="bi bi-person-fill me-1"></i> Employee</label>
                        <select class="form-control form-select @error('employee_id') is-invalid @enderror" name="employee_id" required>
                            <option value="" disabled selected>Select an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="leave_type" class="form-label"><i class="bi bi-calendar-minus-fill me-1"></i> Leave Type</label>
                         <select class="form-control form-select @error('leave_type') is-invalid @enderror" name="leave_type" required>
                             <option value="" disabled selected>Select Leave Type</option>
                             <option value="cuti" {{ old('leave_type') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                             <option value="sakit" {{ old('leave_type') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                             <option value="replace_off" {{ old('leave_type') == 'replace_off' ? 'selected' : '' }}>Replace Off</option>
                             <option value="nikah" {{ old('leave_type') == 'nikah' ? 'selected' : '' }}>Nikah</option>
                             <option value="melahirkan" {{ old('leave_type') == 'melahirkan' ? 'selected' : '' }}>Melahirkan</option>
                         </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label"><i class="bi bi-calendar-date me-1"></i> Start Date</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label"><i class="bi bi-calendar-date me-1"></i> End Date</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label"><i class="bi bi-file-text-fill me-1"></i> Description</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                                
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill me-1"></i> Submit Attendance</button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left-circle-fill me-1"></i> Back to attendance List</a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
