@extends('layouts.app_admin')

@section('title', 'Dashboard Admin - BookStore')

@section('content')
@php
    $totalPendapatan = \App\Models\Order::where('status_pembayaran', 'paid')->sum('total_harga');
    $recentOrders = \App\Models\Order::with(['user', 'items.book'])->latest()->take(5)->get();
@endphp

<!-- Header Dashboard -->
<div class="mb-4">
    <h4 class="fw-bold text-dark mb-1">Dashboard Admin</h4>
    <p class="text-muted small mb-0">Ringkasan data toko buku BookStore.</p>
</div>

<!-- 4 Card Statistik Sederhana -->
<div class="row g-3 mb-4">
    <!-- Total Buku -->
    <div class="col-sm-6 col-md-3">
        <div class="card p-3 shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold d-block">Total Buku</small>
                    <h3 class="fw-bold text-primary-custom mb-0 mt-1">{{ number_format($totalBuku) }}</h3>
                </div>
                <div class="fs-2 text-primary-custom">
                    <i class="bi bi-book"></i>
                </div>
            </div>
            <hr class="my-2">
            <a href="{{ route('admin.books.index') }}" class="small text-decoration-none text-muted">
                Lihat data buku <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-sm-6 col-md-3">
        <div class="card p-3 shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold d-block">Total Kategori</small>
                    <h3 class="fw-bold text-primary-custom mb-0 mt-1">{{ number_format($totalKategori) }}</h3>
                </div>
                <div class="fs-2 text-primary-custom">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <hr class="my-2">
            <a href="{{ route('admin.categories.index') }}" class="small text-decoration-none text-muted">
                Kelola kategori <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Customer -->
    <div class="col-sm-6 col-md-3">
        <div class="card p-3 shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold d-block">Total Customer</small>
                    <h3 class="fw-bold text-primary-custom mb-0 mt-1">{{ number_format($totalUser) }}</h3>
                </div>
                <div class="fs-2 text-primary-custom">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <hr class="my-2">
            <a href="{{ route('admin.users') }}" class="small text-decoration-none text-muted">
                Lihat customer <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Pesanan -->
    <div class="col-sm-6 col-md-3">
        <div class="card p-3 shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted fw-semibold d-block">Total Pesanan</small>
                    <h3 class="fw-bold text-primary-custom mb-0 mt-1">{{ number_format($totalOrder) }}</h3>
                </div>
                <div class="fs-2 text-primary-custom">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
            <hr class="my-2">
            <a href="{{ route('admin.orders') }}" class="small text-decoration-none text-muted">
                Lihat pesanan <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Ringkasan Total Pendapatan -->
<div class="card p-4 shadow-sm mb-4 bg-white border-start border-4 border-primary">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <span class="badge badge-soft-primary mb-1">Total Pendapatan Terverifikasi (PAID)</span>
            <h2 class="fw-bold text-primary-custom mb-0">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </h2>
            <small class="text-muted">Total transaksi lunas yang tercatat melalui sistem pembayaran toko.</small>
        </div>
        <div>
            <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-receipt me-1"></i> Kelola Semua Pesanan
            </a>
        </div>
    </div>
</div>

<!-- Tabel 5 Pesanan Terbaru -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-dark">5 Pesanan Terbaru Masuk</h6>
        <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-secondary">
            Lihat Semua Pesanan
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Item Buku</th>
                    <th>Total Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td><strong>{{ $order->kode_invoice }}</strong></td>
                        <td>
                            <span class="d-block text-dark fw-semibold">{{ $order->user->name ?? 'User Terhapus' }}</span>
                            <small class="text-muted">{{ $order->user->email ?? '-' }}</small>
                        </td>
                        <td>
                            <ul class="mb-0 ps-3 small text-muted">
                                @foreach($order->items as $item)
                                    <li>{{ $item->book->judul ?? 'Buku' }} ({{ $item->jumlah }}x)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="fw-bold text-primary-custom">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($order->status_pembayaran === 'paid')
                                <span class="badge bg-success">PAID</span>
                            @elseif($order->status_pembayaran === 'pending')
                                <span class="badge bg-warning text-dark">PENDING</span>
                            @else
                                <span class="badge bg-danger">{{ strtoupper($order->status_pembayaran) }}</span>
                            @endif
                        </td>
                        <td class="text-end small text-muted">
                            {{ $order->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada riwayat transaksi pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
