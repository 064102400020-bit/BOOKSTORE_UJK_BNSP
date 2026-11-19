@extends('layouts.app_admin')

@section('title', 'Edit Buku - Admin BookStore')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Buku
    </a>
</div>

<div class="card p-4 shadow-sm">
    <h5 class="fw-bold text-dark mb-1">Edit Data Buku</h5>
    <p class="text-muted small mb-3">Perbarui data buku <strong>{{ $book->judul ?? '' }}</strong>.</p>

    <form action="{{ route('admin.books.update', $book->id ?? 1) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label for="judul" class="form-label small fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $book->judul ?? '') }}" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="category_id" class="form-label small fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (isset($book) && $book->category_id == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="penulis" class="form-label small fw-semibold">Penulis <span class="text-danger">*</span></label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $book->penulis ?? '') }}" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="penerbit" class="form-label small fw-semibold">Penerbit</label>
                <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $book->penerbit ?? '') }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="harga" class="form-label small fw-semibold">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                <input type="number" id="harga" name="harga" value="{{ old('harga', $book->harga ?? 0) }}" class="form-control" min="0" required>
            </div>

            <div class="col-md-6">
                <label for="stok" class="form-label small fw-semibold">Stok <span class="text-danger">*</span></label>
                <input type="number" id="stok" name="stok" value="{{ old('stok', $book->stok ?? 0) }}" class="form-control" min="0" required>
            </div>

            <div class="col-12">
                <label for="deskripsi" class="form-label small fw-semibold">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $book->deskripsi ?? '') }}</textarea>
            </div>

            <div class="col-12">
                <label for="gambar" class="form-label small fw-semibold">Cover Buku</label>
                <div class="d-flex align-items-center gap-2">
                    @if(isset($book) && $book->gambar && file_exists(public_path('storage/' . $book->gambar)))
                        <img src="{{ asset('storage/' . $book->gambar) }}" class="rounded border" style="width: 50px; height: 70px; object-fit: cover;">
                    @endif
                    <input type="file" id="gambar" name="gambar" class="form-control" accept="image/png, image/jpeg, image/jpg">
                </div>
            </div>

            <div class="col-12 text-end pt-2">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-1">Batal</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Perbarui Buku
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
