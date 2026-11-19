@extends('layouts.app_landing')

@section('title', 'Login - BookStore')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <i class="bi bi-book-half fs-1 text-primary-custom"></i>
                <h3 class="fw-bold text-dark mt-2 mb-1">Login BookStore</h3>
                <p class="text-muted small">Silakan masuk menggunakan akun Anda</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success py-2 small mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="nama@email.com" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label small fw-semibold mb-0">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small link-primary-custom">Lupa password?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="••••••••" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                </button>
            </form>

            <div class="text-center pt-3 border-top small text-muted">
                Belum punya akun? <a href="{{ route('register') }}" class="link-primary-custom">Daftar Akun Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection
