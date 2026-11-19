@extends('layouts.app_user')

@section('title', 'Keranjang Belanja - BookStore')

@section('content')
<div class="card p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark mb-0">
            <i class="bi bi-cart3 text-primary-custom me-1"></i> Keranjang Belanja
        </h4>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
        </a>
    </div>

    @if($carts->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted mb-2 d-block"></i>
            <h5 class="fw-semibold text-dark">Keranjang Belanja Anda Kosong</h5>
            <p class="text-muted small mb-3">Anda belum menambahkan buku ke keranjang belanja.</p>
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Mulai Belanja Sekarang</a>
        </div>
    @else
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50%;">Buku</th>
                        <th class="text-center" style="width: 15%;">Harga</th>
                        <th class="text-center" style="width: 15%;">Jumlah</th>
                        <th class="text-end" style="width: 15%;">Subtotal</th>
                        <th class="text-center" style="width: 5%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($carts as $cart)
                        @php 
                            $subtotal = $cart->book->harga * $cart->jumlah; 
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 50px; height: 65px;" class="rounded border overflow-hidden flex-shrink-0 bg-light d-flex align-items-center justify-content-center">
                                        @if($cart->book->gambar && file_exists(public_path('storage/' . $cart->book->gambar)))
                                            <img src="{{ asset('storage/' . $cart->book->gambar) }}" alt="{{ $cart->book->judul }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <i class="bi bi-book text-muted"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold text-dark text-truncate" style="max-width: 320px;">{{ $cart->book->judul }}</h6>
                                        <small class="text-muted">{{ $cart->book->penulis }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">Rp {{ number_format($cart->book->harga, 0, ',', '.') }}</td>
                            <td class="text-center fw-bold">{{ $cart->jumlah }}</td>
                            <td class="text-end fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <th colspan="3" class="text-end fw-bold">Total Pembayaran:</th>
                        <th class="text-end fw-bold fs-6 text-primary-custom">
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Form Alamat Pengiriman & Checkout -->
        <div class="card p-3 bg-light border">
            <h6 class="fw-bold text-dark mb-2">Formulir Checkout & Pembayaran</h6>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="alamat_pengiriman" class="form-label small fw-semibold">Alamat Lengkap Pengiriman Buku <span class="text-danger">*</span></label>
                    <textarea id="alamat_pengiriman" name="alamat_pengiriman" class="form-control" rows="2" 
                              placeholder="Masukkan alamat lengkap (Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos)" 
                              required>{{ old('alamat_pengiriman', auth()->user()->alamat ?? '') }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                        <i class="bi bi-shield-check text-success me-1"></i> Simulasi Pembayaran Internal
                    </div>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="bi bi-credit-card me-1"></i> Checkout Sekarang
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection
