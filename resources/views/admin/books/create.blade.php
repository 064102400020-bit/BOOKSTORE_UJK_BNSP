@extends('layouts.app_admin')

@section('title', 'Tambah Buku Baru - Admin BookStore')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Buku
    </a>
</div>

<div class="card p-4 shadow-sm">
    <h5 class="fw-bold text-dark mb-1">Form Tambah Buku Baru</h5>
    <p class="text-muted small mb-3">Isi formulir berikut untuk menambahkan buku baru ke katalog.</p>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="judul" class="form-label small fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="form-control" placeholder="Contoh: Clean Code" required>
            </div>

            <div class="col-md-6">
                <label for="category_id" class="form-label small fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="penulis" class="form-label small fw-semibold">Penulis <span class="text-danger">*</span></label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}" class="form-control" placeholder="Nama penulis" required>
            </div>

            <div class="col-md-6">
                <label for="penerbit" class="form-label small fw-semibold">Penerbit</label>
                <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" class="form-control" placeholder="Nama penerbit">
            </div>

            <div class="col-md-6">
                <label for="harga" class="form-label small fw-semibold">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                <input type="number" id="harga" name="harga" value="{{ old('harga') }}" class="form-control" placeholder="150000" min="0" required>
            </div>

            <div class="col-md-6">
                <label for="stok" class="form-label small fw-semibold">Stok <span class="text-danger">*</span></label>
                <input type="number" id="stok" name="stok" value="{{ old('stok', 10) }}" class="form-control" min="0" required>
            </div>

            <div class="col-12">
                <label for="deskripsi" class="form-label small fw-semibold">Deskripsi / Sinopsis</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Ringkasan isi buku...">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="col-12">
                <label for="gambar" class="form-label small fw-semibold">Cover Buku (JPG / PNG, max 2MB)</label>
                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/png, image/jpeg, image/jpg">
            </div>

            <div class="col-12 text-end pt-2">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-1">Batal</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Simpan Buku
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
