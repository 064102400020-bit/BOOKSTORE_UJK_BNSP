@extends('layouts.app_landing')

@section('title', 'Selamat Datang di BookStore')

@section('content')
<div class="container py-4">
    <div class="row align-items-center justify-content-center g-5">
        <!-- Kolom Kiri: Branding & Info Ringkas -->
        <div class="col-lg-5 text-center text-lg-start">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm p-3 mb-3 text-primary-custom" style="width: 70px; height: 70px;">
                <i class="bi bi-book-half fs-1"></i>
            </div>
            <h1 class="fw-bold text-dark display-6 mb-2">BookStore</h1>
            <p class="text-secondary mb-4" style="line-height: 1.6;">
                Platform toko buku digital modern untuk kemudahan pencarian, pemesanan, dan transaksi buku secara praktis & cepat.
            </p>

            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start">
                <a href="{{ route('about') }}" class="btn btn-sm btn-outline-secondary px-3 py-2">
                    <i class="bi bi-info-circle me-1"></i> Tentang Kami
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-sm btn-outline-secondary px-3 py-2">
                    <i class="bi bi-chat-dots me-1"></i> Hubungi Admin
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Pilihan Masuk / Daftar di Tengah Halaman -->
        <div class="col-lg-5 col-md-8">
            <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border border-light-subtle text-center">
                <h4 class="fw-bold text-dark mb-2">Selamat Datang</h4>
                <p class="text-muted small mb-4">Silakan masuk ke akun Anda atau buat akun baru untuk mulai berbelanja.</p>

                <div class="d-grid gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Masuk (Login)</span>
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-outline-primary py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-person-plus"></i>
                        <span>Daftar Akun Baru (Register)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
