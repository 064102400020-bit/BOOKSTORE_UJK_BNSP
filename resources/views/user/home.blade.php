@extends('layouts.app_user')

@section('title', 'Katalog Buku - BookStore')

@section('content')
<!-- Banner Selamat Datang Sederhana -->
<div class="card p-4 mb-4 shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-7">
            <h3 class="fw-bold text-dark mb-1">Selamat Datang di BookStore</h3>
            <p class="text-muted small mb-3">Temukan buku favorit Anda dengan harga terjangkau dan proses pemesanan yang mudah.</p>
        </div>
        <div class="col-md-5">
            <!-- Form Pencarian Buku -->
            <form action="{{ route('home') }}" method="GET">
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul buku atau penulis..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filter Kategori Buku -->
    <hr class="my-3">
    <div class="d-flex align-items-center flex-wrap gap-2">
        <span class="small fw-semibold text-muted me-2"><i class="bi bi-funnel me-1"></i> Kategori:</span>
        <a href="{{ route('home', array_merge(request()->except('category_id'), ['category_id' => ''])) }}" 
           class="btn btn-sm {{ !request('category_id') ? 'btn-primary' : 'btn-outline-primary' }}">
            Semua
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('home', array_merge(request()->except('category_id'), ['category_id' => $cat->id])) }}" 
               class="btn btn-sm {{ request('category_id') == $cat->id ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $cat->nama_kategori }}
            </a>
        @endforeach
        @if(request('search') || request('category_id'))
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary ms-auto">
                <i class="bi bi-x-circle me-1"></i> Reset
            </a>
        @endif
    </div>
</div>

<!-- Daftar Buku Grid (4 Kolom Desktop) -->
<div class="row">
    @forelse($books as $book)
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm d-flex flex-column">
                <!-- Cover Buku / Kotak Sederhana jika Kosong -->
                @if($book->gambar && file_exists(public_path('storage/' . $book->gambar)))
                    <img src="{{ asset('storage/' . $book->gambar) }}" class="card-img-top" alt="{{ $book->judul }}" style="height: 220px; object-fit: cover;">
                @else
                    <div class="book-placeholder">
                        <i class="bi bi-book"></i>
                        <span class="fw-semibold small text-truncate w-100 px-2">{{ $book->judul }}</span>
                        <small class="text-muted" style="font-size: 0.75rem;">{{ $book->penulis }}</small>
                    </div>
                @endif

                <div class="card-body p-3 d-flex flex-column">
                    <!-- Badge Kategori -->
                    <span class="badge badge-soft-primary align-self-start mb-2" style="font-size: 0.72rem;">
                        {{ $book->category->nama_kategori ?? 'Umum' }}
                    </span>

                    <!-- Judul Buku -->
                    <h6 class="card-title fw-bold text-dark mb-1 text-truncate" title="{{ $book->judul }}">
                        {{ $book->judul }}
                    </h6>

                    <!-- Penulis -->
                    <p class="text-muted small mb-2" style="font-size: 0.8rem;">
                        Penulis: {{ $book->penulis }}
                    </p>

                    <!-- Harga & Sisa Stok -->
                    <div class="mt-auto pt-2 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-primary-custom">
                                Rp {{ number_format($book->harga, 0, ',', '.') }}
                            </span>
                            <small class="text-muted" style="font-size: 0.75rem;">
                                Stok: <strong>{{ $book->stok }}</strong>
                            </small>
                        </div>

                        <!-- Tombol Aksi: Detail & + Keranjang -->
                        <div class="d-grid gap-1">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id }}">
                                <i class="bi bi-info-circle me-1"></i> Detail
                            </button>

                            @auth
                                @if(auth()->user()->role === 'user')
                                    <form action="{{ route('cart.store', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary w-100" {{ $book->stok < 1 ? 'disabled' : '' }}>
                                            <i class="bi bi-cart-plus me-1"></i> {{ $book->stok < 1 ? 'Habis' : '+ Keranjang' }}
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-light border text-primary-custom w-100">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Beli
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Buku Sederhana -->
        <div class="modal fade" id="detailModal{{ $book->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $book->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary-custom text-white py-2 px-3">
                        <h5 class="modal-title fs-6 fw-bold" id="detailLabel{{ $book->id }}">
                            <i class="bi bi-book me-1"></i> Detail Buku
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <!-- Cover Kiri -->
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                @if($book->gambar && file_exists(public_path('storage/' . $book->gambar)))
                                    <img src="{{ asset('storage/' . $book->gambar) }}" class="img-fluid rounded border shadow-sm" alt="{{ $book->judul }}" style="max-height: 280px; object-fit: cover;">
                                @else
                                    <div class="book-placeholder rounded border" style="height: 260px;">
                                        <i class="bi bi-book fs-1"></i>
                                        <span class="fw-semibold px-2">{{ $book->judul }}</span>
                                        <small class="text-muted">{{ $book->penulis }}</small>
                                    </div>
                                @endif
                            </div>

                            <!-- Info Kanan -->
                            <div class="col-md-8">
                                <span class="badge badge-soft-primary mb-2">{{ $book->category->nama_kategori ?? 'Umum' }}</span>
                                <h4 class="fw-bold text-dark mb-1">{{ $book->judul }}</h4>
                                <p class="text-muted small mb-3">Penulis: <strong>{{ $book->penulis }}</strong></p>

                                <table class="table table-sm table-bordered small mb-3">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light" style="width: 30%;">Penerbit</th>
                                            <td>{{ $book->penerbit ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Harga</th>
                                            <td class="fw-bold text-primary-custom">Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Status Stok</th>
                                            <td>
                                                @if($book->stok > 0)
                                                    <span class="badge bg-success">Tersedia ({{ $book->stok }} pcs)</span>
                                                @else
                                                    <span class="badge bg-danger">Stok Habis</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h6 class="fw-bold small mb-1">Sinopsis / Deskripsi:</h6>
                                <p class="small text-muted mb-3" style="line-height: 1.6;">
                                    {{ $book->deskripsi ?: 'Belum ada deskripsi untuk buku ini.' }}
                                </p>

                                @auth
                                    @if(auth()->user()->role === 'user')
                                        <form action="{{ route('cart.store', $book->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary w-100 py-2" {{ $book->stok < 1 ? 'disabled' : '' }}>
                                                <i class="bi bi-cart-plus me-1"></i> Tambahkan ke Keranjang
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Membeli
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="card p-5 bg-white shadow-sm mx-auto" style="max-width: 500px;">
                <i class="bi bi-journal-x fs-1 text-muted mb-2"></i>
                <h5 class="fw-bold text-dark">Buku Tidak Ditemukan</h5>
                <p class="text-muted small mb-3">Tidak ada buku yang sesuai dengan pencarian atau filter yang dipilih.</p>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Lihat Semua Buku</a>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection
