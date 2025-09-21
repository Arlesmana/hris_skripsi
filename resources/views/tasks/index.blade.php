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
                <h3>Tugas</h3>
                <p class="text-subtitle text-muted">Kelola tugas karyawan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tugas</li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                <h5 class="card-title mb-0 fs-5 fw-bold">
                    <i class="bi bi-list-task me-2"></i> Data Tugas
                </h5>
            </div>
            <div class="card-body p-4">

                <div class="d-flex mb-3">
                    @if (session('role') == 'Admin') 
                        <a href="{{ route('tasks.create')}}" class="btn btn-primary ms-auto">
                            <i class="bi bi-plus-lg me-1"></i> Buat Tugas
                        </a>
                    @endif
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Assigned Employee</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->employee?->fullname ?? 'No Employee Assigned' }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    @if($task->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($task->status == 'done')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-info">{{ ucfirst($task->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('tasks.show', $task->id)}}" class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="bi bi-eye-fill me-1"></i> Lihat
                                        </a>

                                        @if($task->status == 'pending')
                                            <a href="{{ route('tasks.done', $task->id) }}" class="btn btn-success btn-sm" title="Tandai Selesai">
                                                <i class="bi bi-check-circle-fill me-1"></i> Selesai
                                            </a>
                                        @else
                                            <a href="{{ route('tasks.pending', $task->id) }}" class="btn btn-warning btn-sm" title="Tandai Belum Selesai">
                                                <i class="bi bi-arrow-clockwise me-1"></i> Pending
                                            </a>
                                        @endif

                                        @if (session('role') == 'Admin')
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm" title="Edit Tugas">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Tugas" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                                <i class="bi bi-trash-fill me-1"></i> Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
