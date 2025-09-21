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
                <h3>Rekap Presensi</h3>
                <p class="text-subtitle text-muted">Ringkasan Data Presensi Karyawan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item">Presences</li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <!-- Bagian baru: Ringkasan data dalam bentuk kartu -->
        <div class="row">
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-person-check-fill d-flex align-items-center justify-content-center"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Hadir</h6>
                                <h6 class="font-extrabold mb-0">{{ $total_present ?? '0' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="bi bi-person-x-fill d-flex align-items-center justify-content-center"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Tidak Hadir</h6>
                                <h6 class="font-extrabold mb-0">{{ $total_absent ?? '0' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                    <i class="bi bi-prescription d-flex align-items-center justify-content-center"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Sakit</h6>
                                <h6 class="font-extrabold mb-0">{{ $total_sick ?? '0' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon green mb-2">
                                    <i class="bi bi-file-earmark-text d-flex align-items-center justify-content-center"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Izin</h6>
                                <h6 class="font-extrabold mb-0">{{ $total_leave ?? '0' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Rekap Presensi Per Karyawan</h5>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="rekap-presensi-table">
                    <thead>
                        <tr>
                            <th><i class="bi bi-person-fill"></i> Employee</th>
                            <th><i class="bi bi-person-check-fill"></i> Total Hadir</th>
                            <th><i class="bi bi-person-x-fill"></i> Total Tidak Hadir</th>
                            <th><i class="bi bi-prescription"></i> Total Sakit</th>
                            <th><i class="bi bi-file-earmark-text"></i> Total Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($summary as $employeeId => $data)
                            <tr>
                                <td>{{ $data['employee_name'] }}</td>
                                <td>{{ $data['present'] }}</td>
                                <td>{{ $data['absent'] }}</td>
                                <td>{{ $data['sick'] }}</td>
                                <td>{{ $data['leave'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex">
                    <a href="{{ route('presences.index') }}" class="btn btn-outline-primary mb-3 ms-auto">
                        <i class="bi bi-arrow-left-circle-fill"></i> Kembali ke Daftar Presensi
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
