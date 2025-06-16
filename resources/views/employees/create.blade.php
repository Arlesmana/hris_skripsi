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
                <h3>Employee</h3>
                <p class="text-subtitle text-muted">Create data Employee</p>
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
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Create Employee
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
                
                <form action="{{ route('employees.store') }}" method="POST">
                    
                    @csrf
        
                    <!-- Task Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Fullname</label>
                        <input type="text" class="form-control" name="fullname" required>
                        @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Phone number</label>
                        <input type="text" class="form-control" name="phone_number" required>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="mb-3">
                        <label for="title" class="form-label">Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Birth Date</label>
                        <input type="date" class="form-control date" name="birth_date" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  

                    <div class="mb-3">
                        <label for="title" class="form-label">Hire Date</label>
                        <input type="date" class="form-control date" name="hire_date" required>
                        @error('hire_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>  
        
        
                    <!-- Assigned To (Employee) Dropdown -->
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select @error('department_id') is-invalid @enderror" name="department_id" required>
                            <option value="">Select an Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" 
                                    @if(old('department_id') == $department->id) selected @endif>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-select @error('role_id') is-invalid @enderror" name="role_id" required>
                            <option value="">Select an Roles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" 
                                    @if(old('role_id') == $role->id) selected @endif>
                                    {{ $role->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="form-control @error('status')is-invalid @enderror">
                            <option value="">Select</option>
                            <option value="inactive">Inactive</option>
                            <option value="active">Active</option>
                            <option value="on leave">On Leave</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Salary</label>
                        <input type="number" class="form-control" name="salary" required>
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="bi bi-person-plus-fill"></i> Create Employee
                    </button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary shadow-sm">
                        <i class="bi bi-arrow-left-circle-fill"></i> Back to Employee List
                    </a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
