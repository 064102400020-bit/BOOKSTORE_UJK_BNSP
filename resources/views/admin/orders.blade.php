@extends('layouts.app_admin')

@section('title', 'Data Pesanan - Admin BookStore')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-0">Daftar Semua Pesanan Masuk</h5>
            <small class="text-muted">Total: <strong>{{ $orders->count() }}</strong> pesanan</small>
        </div>
        <input type="text" id="orderFilter" class="form-control form-control-sm" placeholder="Cari invoice / customer..." style="max-width: 220px;">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle" id="tableOrders">
            <thead class="table-light">
                <tr>
                    <th style="width: 18%;">Invoice & Tanggal</th>
                    <th style="width: 20%;">Customer</th>
                    <th style="width: 28%;">Buku Dipesan</th>
                    <th style="width: 14%;">Total Harga</th>
                    <th style="width: 12%;">Alamat Kirim</th>
                    <th class="text-center" style="width: 8%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <strong class="text-dark d-block">{{ $order->kode_invoice }}</strong>
                            <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </td>
                        <td>
                            <span class="d-block text-dark fw-semibold">{{ $order->user->name ?? 'User Terhapus' }}</span>
                            <small class="text-muted">{{ $order->user->email ?? '-' }}</small>
                        </td>
                        <td>
                            <ul class="mb-0 ps-3 small text-muted">
                                @foreach($order->items as $item)
                                    <li>
                                        {{ $item->book->judul ?? 'Buku' }} ({{ $item->jumlah }}x) 
                                        - Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="fw-bold text-primary-custom">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="small text-muted">{{ Str::limit($order->alamat_pengiriman, 35) }}</td>
                        <td class="text-center">
                            @if($order->status_pembayaran === 'paid')
                                <span class="badge bg-success">PAID</span>
                            @elseif($order->status_pembayaran === 'pending')
                                <span class="badge bg-warning text-dark">PENDING</span>
                            @else
                                <span class="badge bg-danger">{{ strtoupper($order->status_pembayaran) }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada pesanan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('orderFilter').addEventListener('keyup', function() {
        const val = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableOrders tbody tr');
        rows.forEach(r => {
            r.style.display = r.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush
