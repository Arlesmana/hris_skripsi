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
                <h3>Edit Presence</h3>
                <p class="text-subtitle text-muted">Manage Presence data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Presence</li>
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
                    Edit Presence
                </h5>
            </div>
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>  
                @endif
                
                <form action="{{ route('presences.update', $presence->id ) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <!-- Employee -->
                    <div class="mb-3">
                        <label for="employee" class="form-label">Employee</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" required>
                            <option value="" disabled selected>Select an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id', $presence->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Masuk -->
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Masuk</label>
                        <input type="time" class="form-control @error('check_in') is-invalid @enderror" name="check_in" value="{{ old('check_in', $presence->check_in) }}" required>
                        @error('check_in')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Keluar -->
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Keluar</label>
                        <input type="time" class="form-control @error('check_out') is-invalid @enderror" name="check_out" value="{{ old('check_out', $presence->check_out) }}" required>
                        @error('check_out')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $presence->date) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="present" {{ old('status', $presence->status) == 'present' ? 'selected' : '' }}>Hadir</option>
                            <option value="Izin" {{ old('status', $presence->status) == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Sakit" {{ old('status', $presence->status) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Tidak Hadir" {{ old('status', $presence->status) == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Presence</button>
                    <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to Presence List</a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
