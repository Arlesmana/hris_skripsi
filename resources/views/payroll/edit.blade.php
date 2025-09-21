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
                <h3>Edit Payroll</h3>
                <p class="text-subtitle text-muted">Manage Payroll data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Payroll</li>
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
                    Edit Payroll
                </h5>
            </div>
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>  
                @endif
                
                <form action="{{ route('payrolls.update', $payroll->id ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select class="form-control form-select @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" required>
                            <option value="" disabled>Select an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" data-salary="{{ $employee->salary }}" {{ old('employee_id', $payroll->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="salary_display" class="form-label">Salary</label>
                        <input type="text" class="form-control" id="salary_display" disabled placeholder="Salary will be displayed here">
                        <input type="hidden" name="salary" id="salary_input" value="{{ old('salary', $payroll->employee->salary) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="bonuses" class="form-label">Bonus</label>
                        <input type="number" class="form-control @error('bonuses') is-invalid @enderror" name="bonuses" value="{{ old('bonuses', $payroll->bonuses) }}" required>
                        @error('bonuses')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="deductions" class="form-label">Potongan</label>
                        <input type="number" class="form-control @error('deductions') is-invalid @enderror" name="deductions" value="{{ old('deductions', $payroll->deductions) }}" required>
                        @error('deductions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pay_date" class="form-label">Pay Date</label>
                        <input type="date" class="form-control date @error('pay_date') is-invalid @enderror" name="pay_date" value="{{ old('pay_date', $payroll->pay_date) }}" required>
                        @error('pay_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Update Payroll</button>
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Back to Payroll List</a>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const employeeSelect = document.getElementById('employee_id');
        const salaryDisplay = document.getElementById('salary_display');
        const salaryInput = document.getElementById('salary_input');

        // Function to format number as currency
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        // Event listener for employee selection change
        employeeSelect.addEventListener('change', function() {
            const selectedOption = employeeSelect.options[employeeSelect.selectedIndex];
            const salary = selectedOption.dataset.salary;
            
            if (salary) {
                // Set the display input value with formatted currency
                salaryDisplay.value = formatRupiah(salary);
                // Set the hidden input value with the raw number for form submission
                salaryInput.value = salary;
            } else {
                salaryDisplay.value = '';
                salaryInput.value = '';
            }
        });
        
        // Trigger change event on page load to populate initial salary
        if (employeeSelect.value) {
            const selectedOption = employeeSelect.options[employeeSelect.selectedIndex];
            const salary = selectedOption.dataset.salary;
            if (salary) {
                salaryDisplay.value = formatRupiah(salary);
                salaryInput.value = salary;
            }
        }
        
    });
</script>

@endsection
