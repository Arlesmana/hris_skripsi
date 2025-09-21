@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold">User Profile</h3>
                <p class="text-muted">View and manage your profile details.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-4 text-center">
                        <div class="mb-3">
                            <img src="{{ $user->profile_picture ?? asset('mazer/dist/assets/compiled/jpg/2.jpg') }}" 
                                 alt="Profile Picture" class="rounded-circle img-fluid" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <h5>{{ $user->name }}</h5>
                        <H5 class="text-muted">{{ $user->role->title }}</H5>
                    </div>

                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label fw-semibold">
                                    <i class="bi bi-person-fill"></i> Full Name
                                </label>
                                <p>{{ $user->name }}</p>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope-fill"></i> Email Address
                                </label>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    @if (in_array(session('role'), ['Admin']))  <!-- Enhanced Role Check -->
                        <a href="{{ route('users.create') }}" class="btn btn-primary" aria-label="Add new user">
                            <i class="bi bi-pencil-square"></i> Tambah User
                        </a>
                    @endif
                    
                    <a href="{{ url('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
