@extends('layouts.app_user')

@section('title', 'Riwayat Pesanan Saya - BookStore')

@section('content')
<div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark mb-0">
            <i class="bi bi-box-seam text-primary-custom me-1"></i> Riwayat Pesanan Saya
        </h4>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-plus-lg me-1"></i> Pesan Buku Lain
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-receipt fs-1 text-muted mb-2 d-block"></i>
            <h5 class="fw-semibold text-dark">Belum Ada Pesanan</h5>
            <p class="text-muted small mb-3">Anda belum pernah melakukan pemesanan buku.</p>
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Mulai Belanja</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 22%;">Invoice & Tanggal</th>
                        <th style="width: 33%;">Detail Buku</th>
                        <th style="width: 15%;">Total Harga</th>
                        <th class="text-center" style="width: 15%;">Status Pembayaran</th>
                        <th class="text-center" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong class="text-dark d-block">{{ $order->kode_invoice }}</strong>
                                <small class="text-muted d-block">{{ $order->created_at->format('d M Y, H:i') }} WIB</small>
                                <small class="text-muted" style="font-size: 0.75rem;">Alamat: {{ Str::limit($order->alamat_pengiriman, 28) }}</small>
                            </td>
                            <td>
                                <ul class="mb-0 ps-3 small text-muted">
                                    @foreach($order->items as $item)
                                        <li>
                                            <span class="text-dark fw-semibold">{{ $item->book->judul }}</span> 
                                            ({{ $item->jumlah }}x) - Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold text-primary-custom">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                @if($order->status_pembayaran === 'paid')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> LUNAS / PAID
                                    </span>
                                @elseif($order->status_pembayaran === 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-hourglass-split me-1"></i> PENDING
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        {{ strtoupper($order->status_pembayaran) }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($order->status_pembayaran === 'pending')
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-wallet2 me-1"></i> Bayar Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye me-1"></i> Lihat Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
