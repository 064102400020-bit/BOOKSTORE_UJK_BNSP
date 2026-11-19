@extends('layouts.app_landing')

@section('title', 'Daftar Akun - BookStore')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus fs-1 text-primary-custom"></i>
                <h3 class="fw-bold text-dark mt-2 mb-1">Daftar Akun</h3>
                <p class="text-muted small">Buat akun Customer untuk mulai memesan buku</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label for="name" class="form-label small fw-semibold">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Contoh: Budi Santoso" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="nama@email.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold">Password</label>
                    <input id="password" type="password" name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small fw-semibold">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" 
                           class="form-control" placeholder="Ulangi password" required autocomplete="new-password">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3">
                    <i class="bi bi-check2-circle me-1"></i> Daftar Sekarang
                </button>
            </form>

            <div class="text-center pt-3 border-top small text-muted">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="link-primary-custom">Login di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection
