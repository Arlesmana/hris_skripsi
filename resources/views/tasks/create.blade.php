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
                <h3 class="fw-bold">Create Task</h3>
                <p class="text-subtitle text-muted">Fill in the details to create a new task.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tugas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                <h5 class="card-title mb-0 fs-5">
                    <i class="bi bi-list-task me-2"></i> Create Task
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
                
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
        
                    <div class="row g-4">
                        <!-- Left Column - Task Information -->
                        <div class="col-12 col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Task Information</h6>

                            <div class="mb-3">
                                <label for="title" class="form-label"><i class="bi bi-card-heading me-1"></i> Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="assigned_to" class="form-label"><i class="bi bi-person-fill me-1"></i> Assigned To</label>
                                <select class="form-select @error('assigned_to') is-invalid @enderror" name="assigned_to" required>
                                    <option value="">Select an Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('assigned_to') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label"><i class="bi bi-calendar-date-fill me-1"></i> Due Date</label>
                                <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Right Column - Other Details -->
                        <div class="col-12 col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Other Details</h6>

                            <div class="mb-3">
                                <label for="status" class="form-label"><i class="bi bi-check-circle-fill me-1"></i> Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="on progress" {{ old('status') == 'on progress' ? 'selected' : '' }}>On Progress</option>
                                    <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><i class="bi bi-file-text-fill me-1"></i> Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary me-2 px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-plus-lg me-2"></i> Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
