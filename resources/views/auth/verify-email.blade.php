@extends('layouts.app_user')

@section('title', 'Verifikasi Email - BookStore')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h5 class="fw-bold text-dark mb-2">Verifikasi Alamat Email</h5>
            <p class="text-muted small mb-3">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success py-2 small mb-3">
                    Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
