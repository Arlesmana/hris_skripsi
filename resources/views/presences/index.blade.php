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
                <h3>Presences</h3>
                
                <p class="text-subtitle text-muted">Presences</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Presences</li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Presences</h5>
            </div>
            
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('presences.create') }}" class="btn btn-success mb-3 ms-auto">New Presences</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($presences as $presence)  <!-- Mulai perulangan di sini -->
                            <tr>
                                <td>{{ $presence->employee->fullname }}</td>
                                <td>{{ $presence->check_in }}</td>   
                                <td>{{ $presence->check_out }}</td>
                                <td>{{ $presence->date }}</td>
                                <td>
                                    @if($presence->status == 'present')
                                        <span class="badge bg-success">Hadir</span>
                                    @elseif($presence->status == 'Izin')
                                        <span class="badge bg-warning">Izin</span>
                                    @elseif($presence->status == 'Sakit')
                                        <span class="badge bg-danger">Sakit</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Hadir</span>
                                    @endif
                                </td>   

                                <td>
                                    @if (session('role') == 'Admin')                            
                                    <!-- Tombol untuk menuju rekap presensi -->
                                   <a href="{{ route('presences.recap',$presence->id) }}" class="btn btn-info btn-sm">
                                    <!-- Ikon 'eye' diganti dengan ikon 'file-lines' untuk rekapitulasi atau laporan -->
                                    <i class="fa-solid fa-file-lines"></i> Rekap
                                   </a>
                                    
                                    <!-- Tombol edit dan hapus -->
                                    
                                    <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-warning btn-sm" title="Edit Tugas">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Tugas" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 
            </div>
        </div>
    </section>
</div>
@endsection
