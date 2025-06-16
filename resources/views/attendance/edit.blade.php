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
                <h3>Edit Attendance</h3>
                <p class="text-subtitle text-muted">Attendance data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Attendance</li>
                        <li class="breadcrumb-item active" aria-current="page">edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Edit Attendance
                </h5>
            </div>
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>  
                @endif
                
                <form action="{{ route('attendances.update', $attendance->id ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Employee -->
                    <div class="mb-3">
                        <label for="employee" class="form-label">Employee</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" required>
                            <option value="" disabled selected>Select an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id', $attendance->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type</label>
                         <select class="form-control @error('leave_type') is-invalid @enderror" name="leave_type" required>
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
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control date @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control date @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Description</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi', $attendance->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Back to Attendance List</a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
