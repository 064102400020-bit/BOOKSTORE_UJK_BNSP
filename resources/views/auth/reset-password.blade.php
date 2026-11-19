@extends('layouts.app_user')

@section('title', 'Atur Ulang Password - BookStore')

@section('content')
<div class="row justify-content-center align-items-center py-4">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card-custom overflow-hidden shadow-lg border-0">
            <div class="p-4 text-center text-white" style="background: linear-gradient(135deg, #1B365D 0%, #203A63 100%); border-bottom: 3px solid var(--accent-gold);">
                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-circle mb-2" style="width: 58px; height: 58px;">
                    <i class="bi bi-shield-lock-fill fs-2" style="color: var(--accent-gold);"></i>
                </div>
                <h4 class="font-serif fw-bold mb-1">Password Baru</h4>
                <p class="small text-white-50 mb-0">Tentukan kata sandi baru untuk akun Anda</p>
            </div>

            <div class="p-4 bg-white">
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger py-2 small mb-3 rounded-3">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold text-dark">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label small fw-bold text-dark">Password Baru</label>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-bold text-dark">Konfirmasi Password Baru</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                        Simpan Password Baru
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
