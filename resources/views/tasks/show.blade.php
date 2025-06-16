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
                <h3 class="fw-bold">Tugas Details</h3>
                <p class="text-muted">Lihat Detail Tugas</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tugas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Task: {{ $task->title }}</h5>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="fw-semibold text-muted">Title</label>
                        <p class="text-dark">{{ $task->title }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-semibold text-muted">Assigned Employee</label>
                        <p class="text-dark">{{ $task->employee->fullname }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-semibold text-muted">Due Date</label>
                        <p class="text-dark">{{ \Carbon\Carbon::parse($task->due_date)->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="fw-semibold text-muted">Status</label>
                        <span class="badge 
                            @if($task->status == 'pending') bg-warning 
                            @elseif($task->status == 'on progress') bg-info 
                            @elseif($task->status == 'done') bg-success 
                            @else bg-secondary @endif
                        ">
                            {{ ucfirst($task->status) }}
                        </span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-muted">Description</label>
                    <div class="p-3 bg-light rounded border">
                        <p class="mb-0 text-dark">{{ $task->description }}</p>
                    </div>
                </div>

                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary mt-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Tugas
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
