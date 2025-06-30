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

                <!-- Single User Profile Information -->
                <div class="row g-3">
                    <!-- Profile Picture Section -->
                    <div class="col-md-4 text-center">
                        <div class="mb-3">
                            <img src="{{ $user->profile_picture ?? asset('mazer/dist/assets/compiled/jpg/2.jpg') }}" 
                                 alt="Profile Picture" class="rounded-circle img-fluid" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->role }}</p>
                    </div>

                    <!-- User Details Section -->
                    <div class="col-md-8">
                        <div class="row g-3">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label for="fullname" class="form-label fw-semibold">
                                    <i class="bi bi-person-fill"></i> Full Name
                                </label>
                                <p>{{ $user->name }}</p>
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope-fill"></i> Email Address
                                </label>
                                <p>{{ $user->email }}</p>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label fw-semibold">
                                    <i class="bi bi-telephone-fill"></i> Phone Number
                                </label>
                                <p>{{ $user->phone_number ?? 'Not Available' }}</p>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <label for="address" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt-fill"></i> Address
                                </label>
                                <p>{{ $user->address ?? 'Not Available' }}</p>
                            </div>

                            <!-- Birth Date -->
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-event-fill"></i> Birth Date
                                </label>
                                <p>{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d-m-Y') : 'Not Available' }}</p>
                            </div>

                            <!-- About Me -->
                            <div class="col-12">
                                <label for="about_me" class="form-label fw-semibold">
                                    <i class="bi bi-info-circle"></i> About Me
                                </label>
                                <p>{{ $user->about_me ?? 'Not Available' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i> Tambah User
                    </a>
                    <a href="{{ url('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
