@extends('layouts.dashboard')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="fw-bold">Detail Slip Gaji</h3>
                <p class="text-subtitle text-muted">Lihat informasi slip gaji karyawan yang terperinci.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Gaji</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Slip Gaji</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                <h4 class="card-title mb-0">Slip Gaji Bulanan</h4>
                <p class="mb-0">Periode: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('F Y') }}</p>
            </div>
            <div class="card-body p-4">
                <div class="row" id="print-area">
                    <!-- Employee Details -->
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-0">Nama Karyawan:</h6>
                                <p class="text-muted">{{ $payroll->employee->fullname }}</p>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Tanggal Pembayaran:</h6>
                                <p class="text-muted">{{ \Carbon\Carbon::parse($payroll->pay_date)->format('d M, Y') }}</p>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <!-- Earnings and Deductions Table -->
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr class="bg-light">
                                        <th colspan="2" class="text-center">Rincian Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Gaji Pokok</td>
                                        <td class="text-end">Rp {{ number_format($payroll->employee->salary, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Bonus</td>
                                        <td class="text-end">Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="fw-bold">Total Pendapatan</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($payroll->employee->salary + $payroll->bonuses, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Potongan</td>
                                        <td class="text-end text-danger">- {{ number_format($payroll->deductions, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-primary text-white">
                                        <td class="fw-bold text-danger">TOTAL GAJI BERSIH</td>
                                        <td class="text-end text-danger">Rp {{ number_format($payroll->employee->salary + $payroll->bonuses - $payroll->deductions, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-end mt-4 d-print-none">
                    <a href="{{ route('payrolls.index') }}" class="btn btn-outline-secondary px-5 py-2 rounded-3 me-2">
                        <i class="bi bi-arrow-left-circle-fill me-2"></i> Kembali
                    </a>
                    <button type="button" id="btn-print" class="btn btn-primary px-5 py-2 rounded-3">
                        <i class="bi bi-printer-fill me-2"></i> Cetak Slip Gaji
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('btn-print').addEventListener('click', function() {
        window.print();
    });
</script>

<style>
    @media print {
        body * {
            display: none;
        }
        #print-area, #print-area * {
            display: block;
        }
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
        }
        .d-print-none {
            display: none !important;
        }
        .page-heading, .card-header {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: none !important;
        }
        .table {
            border-collapse: collapse !important;
        }
        .table th, .table td {
            border: 1px solid #dee2e6 !important;
            padding: 8px !important;
        }
        .table th {
            background-color: #f8f9fa !important;
        }
    }
</style>

@endsection
