<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Alfamart</title>

    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/compiled/png/logo_title.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/auth-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/mazer.css') }}">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <!-- Left Side: Login Form -->
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html">
                            <img src="{{ asset('mazer/dist/assets/compiled/png/logo_alfamart.png') }}" alt="Logo">
                        </a>
                    </div>
                    <h6 class="auth-title">Login</h6>
                    <p class="auth-subtitle mb-5">Welcome back!</p>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Field -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="position-relative">
                                <input type="email" id="email" class="form-control form-control-xl" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                <div class="form-control-icon position-absolute top-50 start-0 translate-middle-y ms-3">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password Field -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <div class="position-relative">
                                <input type="password" id="password" class="form-control form-control-xl" name="password" required autocomplete="current-password">
                                <div class="form-control-icon position-absolute top-50 start-0 translate-middle-y ms-3">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>


                        <!-- Remember Me Checkbox -->
                        <div class="form-check form-check-lg d-flex align-items-end mb-4">
                            <input class="form-check-input me-2" type="checkbox" value="" id="remember_me" name="remember">
                            <label class="form-check-label text-gray-600" for="remember_me">
                                {{ __('Keep me logged in') }}
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            {{ __('Log in') }}
                        </button>
                    </form>

                    <!-- Forgot Password & Signup Links -->
                    <div class="text-center mt-5 text-lg fs-4">
                        @if (Route::has('password.request'))
                            <p>
                                <a class="font-bold" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>.
                            </p>
                        @endif
                        <p class="text-gray-600">Don't have an account? <a href="{{ url('/register') }}" class="font-bold">Sign up</a>.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: You can add extra content here -->
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <!-- Additional content like images can go here -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
