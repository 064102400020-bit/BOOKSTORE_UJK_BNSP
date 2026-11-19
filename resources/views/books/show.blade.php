@extends('layouts.app_user')

@section('title', ($book->judul ?? 'Detail Buku') . ' - BookStore')

@section('content')
<div class="mb-3">
    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
    </a>
</div>

<div class="card p-4 shadow-sm">
    <div class="row">
        <!-- Gambar Cover di Sebelah Kiri -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
            @if(isset($book) && $book->gambar && file_exists(public_path('storage/' . $book->gambar)))
                <img src="{{ asset('storage/' . $book->gambar) }}" class="img-fluid rounded border shadow-sm" alt="{{ $book->judul }}" style="max-height: 350px; object-fit: cover;">
            @else
                <div class="book-placeholder rounded border" style="height: 320px;">
                    <i class="bi bi-book fs-1"></i>
                    <h5 class="fw-semibold px-2 mt-2">{{ $book->judul ?? 'Judul Buku' }}</h5>
                    <p class="text-muted small mb-0">{{ $book->penulis ?? 'Penulis' }}</p>
                </div>
            @endif
        </div>

        <!-- Detail Buku di Sebelah Kanan -->
        <div class="col-md-8">
            <span class="badge badge-soft-primary mb-2">{{ $book->category->nama_kategori ?? 'Umum' }}</span>
            <h3 class="fw-bold text-dark mb-1">{{ $book->judul ?? 'Judul Buku' }}</h3>
            <p class="text-muted small mb-3">Penulis: <strong>{{ $book->penulis ?? '-' }}</strong></p>

            <table class="table table-bordered table-sm small mb-3">
                <tbody>
                    <tr>
                        <th class="bg-light" style="width: 25%;">Penerbit</th>
                        <td>{{ $book->penerbit ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Kategori</th>
                        <td>{{ $book->category->nama_kategori ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Harga Satuan</th>
                        <td class="fw-bold fs-5 text-primary-custom">Rp {{ number_format($book->harga ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status Stok</th>
                        <td>
                            @if(($book->stok ?? 0) > 0)
                                <span class="badge bg-success">Tersedia ({{ $book->stok }} eksemplar)</span>
                            @else
                                <span class="badge bg-danger">Stok Habis</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-4">
                <h6 class="fw-bold small mb-1">Deskripsi / Sinopsis Buku:</h6>
                <p class="text-muted small" style="line-height: 1.7;">
                    {{ $book->deskripsi ?: 'Belum ada ringkasan atau sinopsis untuk buku ini.' }}
                </p>
            </div>

            <!-- Form Tambah ke Keranjang -->
            @auth
                @if(auth()->user()->role === 'user')
                    <form action="{{ route('cart.store', $book->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary py-2 px-4" {{ ($book->stok ?? 0) < 1 ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus me-1"></i> Tambahkan ke Keranjang
                        </button>
                    </form>
                @else
                    <div class="alert alert-info py-2 small mb-0">
                        <i class="bi bi-info-circle me-1"></i> Anda login sebagai Administrator.
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Membeli
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection
