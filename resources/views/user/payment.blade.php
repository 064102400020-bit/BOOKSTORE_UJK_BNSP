@extends('layouts.app_user')

@section('title', 'Detail Pesanan & Simulasi Pembayaran - ' . $order->kode_invoice)

@section('content')
<div class="row justify-content-center py-3">
    <div class="col-md-8 col-lg-7">
        <div class="card p-4 shadow-sm">
            <!-- Header Status -->
            <div class="text-center mb-4">
                <i class="bi bi-receipt fs-1 text-primary-custom mb-1 d-block"></i>
                <h4 class="fw-bold text-dark mb-1">Detail Pesanan & Pembayaran</h4>
                <p class="text-muted small mb-0">Kode Invoice: <strong>{{ $order->kode_invoice }}</strong></p>
                <small class="text-muted">Tanggal: {{ $order->created_at->format('d M Y, H:i') }} WIB</small>
            </div>

            <!-- Banner Status Pembayaran -->
            <div class="p-3 rounded border text-center mb-4 {{ $order->status_pembayaran === 'paid' ? 'bg-success-subtle border-success' : 'bg-warning-subtle border-warning' }}">
                <small class="text-muted text-uppercase fw-semibold d-block mb-1">Status Pembayaran Saat Ini:</small>
                @if($order->status_pembayaran === 'paid')
                    <span class="badge bg-success fs-6 px-3 py-2">
                        <i class="bi bi-check-circle-fill me-1"></i> LUNAS / PAID
                    </span>
                    <p class="small text-success fw-semibold mt-2 mb-0">
                        <i class="bi bi-box2-heart me-1"></i> Pembayaran telah berhasil. Stok buku otomatis berkurang dan pesanan siap dikemas oleh Admin.
                    </p>
                @else
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                        <i class="bi bi-hourglass-split me-1"></i> PENDING (Menunggu Pembayaran)
                    </span>
                    <p class="small text-dark mt-2 mb-0">
                        Silakan lakukan simulasi konfirmasi pembayaran di bawah ini.
                    </p>
                @endif
            </div>

            <!-- Rincian Buku yang Dipesan -->
            <div class="card p-3 bg-light border mb-4">
                <h6 class="fw-bold text-dark mb-2">Rincian Buku yang Dipesan:</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered bg-white mb-0 align-middle">
                        <thead class="table-light small">
                            <tr>
                                <th>Judul Buku</th>
                                <th class="text-center" style="width: 15%;">Jumlah</th>
                                <th class="text-end" style="width: 25%;">Harga Satuan</th>
                                <th class="text-end" style="width: 25%;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <strong class="text-dark">{{ $item->book->judul }}</strong>
                                        <small class="text-muted d-block">{{ $item->book->penulis }}</small>
                                    </td>
                                    <td class="text-center">{{ $item->jumlah }}x</td>
                                    <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-end fw-semibold">
                                        Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <th colspan="3" class="text-end fw-bold">Total Pembayaran:</th>
                                <th class="text-end fw-bold text-primary-custom fs-6">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-3 small text-muted">
                    <strong>Alamat Pengiriman:</strong>
                    <div class="text-dark bg-white p-2 rounded border mt-1">{{ $order->alamat_pengiriman }}</div>
                </div>
            </div>

            <!-- Kotak Aksi Simulasi Pembayaran -->
            @if($order->status_pembayaran === 'pending')
                <div class="card p-3 border-primary mb-3 bg-white">
                    <h6 class="fw-bold text-primary-custom mb-1">
                        <i class="bi bi-wallet2 me-1"></i> Simulasi Pembayaran Internal
                    </h6>
                    <p class="small text-muted mb-3">
                        Klik tombol di bawah ini untuk mensimulasikan pembayaran lunas secara instan. Sistem akan otomatis mengubah status pesanan menjadi <strong>LUNAS / PAID</strong> dan mengurangi stok buku pada database.
                    </p>

                    <!-- Form POST Simulasi Bayar -->
                    <form action="{{ route('orders.pay', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold py-2 shadow-sm" onclick="return confirm('Konfirmasi simulasi pembayaran lunas untuk pesanan ini?')">
                            <i class="bi bi-check-circle-fill me-1"></i> Simulasi Bayar Sekarang (Lunas)
                        </button>
                    </form>
                </div>
            @endif

            <!-- Navigasi Bawah -->
            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                <a href="{{ route('orders.my') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-box-seam me-1"></i> Lihat Semua Pesanan Saya
                </a>
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-grid me-1"></i> Belanja Buku Lagi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
