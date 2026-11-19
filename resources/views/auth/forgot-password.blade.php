@extends('layouts.app_user')

@section('title', 'Lupa Password - BookStore')

@section('content')
<div class="row justify-content-center align-items-center py-4">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card-custom overflow-hidden shadow-lg border-0">
            <div class="p-4 text-center text-white" style="background: linear-gradient(135deg, #1B365D 0%, #203A63 100%); border-bottom: 3px solid var(--accent-gold);">
                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-circle mb-2" style="width: 58px; height: 58px;">
                    <i class="bi bi-key-fill fs-2" style="color: var(--accent-gold);"></i>
                </div>
                <h4 class="font-serif fw-bold mb-1">Pemulihan Akun</h4>
                <p class="small text-white-50 mb-0">Reset kata sandi akun BookStore Anda</p>
            </div>

            <div class="p-4 bg-white">
                <p class="small text-muted mb-3">
                    Masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                </p>

                @if (session('status'))
                    <div class="alert alert-success py-2 small mb-3 rounded-3">
                        {{ session('status') }}
                    </div>
                @endif

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger py-2 small mb-3 rounded-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold text-dark">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control border-start-0 ps-0" placeholder="nama@email.com" required autofocus>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        Kirim Tautan Reset Password
                    </button>
                </form>

                <div class="text-center mt-3 pt-3 border-top">
                    <a href="{{ route('login') }}" class="small text-muted text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
