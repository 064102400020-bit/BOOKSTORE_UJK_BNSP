@extends('layouts.app_user')

@section('title', 'About Us - BookStore')

@section('content')
<div class="card p-4 shadow-sm mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold text-dark mb-2">Tentang BookStore</h3>
            <p class="text-muted" style="line-height: 1.7;">
                BookStore adalah aplikasi toko buku online yang dirancang untuk memudahkan mahasiswa, akademisi, dan pembaca umum dalam mencari dan membeli buku berkualitas. Dengan dukungan sistem pemesanan modern, transaksi buku menjadi lebih cepat, aman, dan praktis.
            </p>
        </div>
        <div class="col-md-4 text-center">
            <div class="p-4 bg-light rounded border">
                <i class="bi bi-book-half fs-1 text-primary-custom mb-2 d-block"></i>
                <h6 class="fw-bold mb-0">BookStore App</h6>
                <small class="text-muted">Proyek Web Laravel 12 & Bootstrap 5</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card p-4 h-100 shadow-sm">
            <h5 class="fw-bold text-dark mb-2"><i class="bi bi-bullseye text-primary-custom me-1"></i> Visi Kami</h5>
            <p class="text-muted small mb-0" style="line-height: 1.7;">
                Menjadi sarana penyedia buku terpercaya yang mendukung peningkatan minat baca dan literasi di lingkungan kampus dan masyarakat luas.
            </p>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card p-4 h-100 shadow-sm">
            <h5 class="fw-bold text-dark mb-2"><i class="bi bi-rocket text-primary-custom me-1"></i> Misi Kami</h5>
            <ul class="text-muted small mb-0 ps-3" style="line-height: 1.7;">
                <li>Menyediakan koleksi buku yang lengkap, mutakhir, dan berkualitas.</li>
                <li>Memberikan kemudahan transaksi melalui integrasi payment gateway.</li>
                <li>Memberikan pelayanan terbaik dan pengiriman tepat waktu.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
