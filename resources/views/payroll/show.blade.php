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
                <h3 class="fw-bold">Payroll Details</h3>
                <p class="text-subtitle text-muted">View detailed information of the Payroll</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Payrolls</li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-lg border-0 rounded-3 animate__animated animate__fadeIn animate__delay-1s">
            <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                <h5 class="card-title mb-0">Employee Payroll Information</h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div id="print-area">
                        <!-- Employee Information -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="employee" class="form-label fs-5 fw-bold text-dark">
                                    <i class="bi bi-person-circle"></i> Employee
                                </label>
                                <p class="fs-5 text-muted mb-0">{{ $payroll->employee->fullname }}</p>
                            </div>
                        </div>

                        <!-- Salary Information -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="salary" class="form-label fs-5 fw-bold text-dark">
                                    <i class="bi bi-currency-dollar"></i> Salary
                                </label>
                                <p class="fs-5 text-muted mb-0">{{ number_format($payroll->salary, 2) }}</p>
                            </div>
                        </div>

                        <!-- Bonus Information -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="bonus" class="form-label fs-5 fw-bold text-dark">
                                    <i class="bi bi-gift"></i> Bonus
                                </label>
                                <p class="fs-5 text-muted mb-0">{{ number_format($payroll->bonuses, 2) }}</p>
                            </div>
                        </div>

                        <!-- Deductions Information -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="deductions" class="form-label fs-5 fw-bold text-dark">
                                    <i class="bi bi-x-circle"></i> Potongan
                                </label>
                                <p class="fs-5 text-muted mb-0">{{ number_format($payroll->deductions, 2) }}</p>
                            </div>
                        </div>

                        <!-- Net Salary Information -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="net_salary" class="form-label fs-5 fw-bold text-dark">
                                    <i class="bi bi-currency-exchange"></i> Net Salary
                                </label>
                                <p class="fs-5 text-muted mb-0">{{ number_format($payroll->net_salary, 2) }}</p>
                            </div>
                        </div>

                        <!-- Pay Date Information -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="pay_date" class="form-label fs-5 fw-bold text-dark">
                                    <i class="bi bi-calendar-check"></i> Pay Date
                                </label>
                                <p class="fs-5 text-muted mb-0">{{ \Carbon\Carbon::parse($payroll->pay_date)->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-end mt-4">
                    <a href="{{ route('payrolls.index') }}" class="btn btn-outline-primary px-5 py-2 rounded-3 mb-2">
                        <i class="bi bi-arrow-left-circle-fill"></i> Back to payrolls List
                    </a>
                    <a href="" class="btn btn-success px-5 py-2 rounded-3 mb-2">
                        <i class="bi bi-download"></i> Export to PDF/Excel
                    </a>
                
                    <button type="button" id="btn-print" class="btn btn-primary px-5 py-2 rounded-3 mb-2">
                        <i class="bi bi-printer-fill"></i> Print Payroll
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.querySelector('#btn-print').addEventListener('click', function() {
        let printContent = document.getElementById('print-area').innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;

        window.print();

        document.body.innerHTML = originalContent;
    });
</script>


@endsection
