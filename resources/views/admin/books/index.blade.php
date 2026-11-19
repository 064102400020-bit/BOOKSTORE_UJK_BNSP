@extends('layouts.app_admin')

@section('title', 'Data Buku - Admin BookStore')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold text-dark mb-0">Data Koleksi Buku</h4>
        <small class="text-muted">Total: <strong>{{ $books->count() }}</strong> judul buku terdaftar di sistem</small>
    </div>
    <div>
        <button class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="collapse" data-bs-target="#formTambahBuku">
            <i class="bi bi-plus-circle"></i> <span>+ Tambah Buku</span>
        </button>
    </div>
</div>

<!-- Form Tambah Buku (Collapsible) -->
<div class="collapse mb-4 {{ (isset($errors) && $errors->any()) ? 'show' : '' }}" id="formTambahBuku">
    <div class="card p-4 shadow-sm border-top border-3 border-primary">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-dark mb-0">Form Tambah Buku Baru</h6>
            <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#formTambahBuku"></button>
        </div>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="judul" class="form-label small fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="form-control" placeholder="Contoh: Clean Code" required>
                </div>

                <div class="col-md-3">
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

                <div class="col-md-3">
                    <label for="penulis" class="form-label small fw-semibold">Penulis <span class="text-danger">*</span></label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}" class="form-control" placeholder="Nama penulis" required>
                </div>

                <div class="col-md-4">
                    <label for="penerbit" class="form-label small fw-semibold">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" class="form-control" placeholder="Nama penerbit">
                </div>

                <div class="col-md-4">
                    <label for="harga" class="form-label small fw-semibold">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga') }}" class="form-control" placeholder="150000" min="0" required>
                </div>

                <div class="col-md-4">
                    <label for="stok" class="form-label small fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok', 10) }}" class="form-control" min="0" required>
                </div>

                <div class="col-md-6">
                    <label for="gambar" class="form-label small fw-semibold">Cover Buku (JPG / PNG, max 2MB)</label>
                    <input type="file" id="gambar" name="gambar" class="form-control" accept="image/png, image/jpeg, image/jpg">
                </div>

                <div class="col-md-6">
                    <label for="deskripsi" class="form-label small fw-semibold">Deskripsi / Sinopsis</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="2" placeholder="Ringkasan isi buku...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="col-12 text-end">
                    <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-toggle="collapse" data-bs-target="#formTambahBuku">Batal</button>
                    <button type="submit" class="btn btn-primary px-3">
                        <i class="bi bi-save me-1"></i> Simpan Buku
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Daftar Buku -->
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-dark">Daftar Buku</h6>
        <input type="text" id="filterInput" class="form-control form-control-sm" placeholder="Cari judul / penulis..." style="max-width: 220px;">
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle" id="tableBuku">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">Cover</th>
                    <th>Judul & Penulis</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td class="text-center">
                            @if($book->gambar && file_exists(public_path('storage/' . $book->gambar)))
                                <img src="{{ asset('storage/' . $book->gambar) }}" alt="{{ $book->judul }}" class="rounded border" style="width: 45px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted mx-auto" style="width: 45px; height: 60px;">
                                    <i class="bi bi-book"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $book->judul }}</strong>
                            <small class="text-muted">{{ $book->penulis }}</small>
                        </td>
                        <td>
                            <span class="badge badge-soft-primary">{{ $book->category->nama_kategori ?? '-' }}</span>
                        </td>
                        <td class="small text-muted">{{ $book->penerbit ?: '-' }}</td>
                        <td class="fw-bold">Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($book->stok > 0)
                                <span class="badge bg-light text-dark border">{{ $book->stok }} pcs</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <!-- Tombol Edit Modal -->
                                <button type="button" class="btn btn-sm btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#editBookModal{{ $book->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- Form Hapus -->
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku \'{{ $book->judul }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Modal Edit Buku -->
                            <div class="modal fade text-start" id="editBookModal{{ $book->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-light">
                                            <h6 class="modal-title fw-bold">Edit Buku: {{ $book->judul }}</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                                                    <input type="text" name="judul" value="{{ $book->judul }}" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Kategori <span class="text-danger">*</span></label>
                                                    <select name="category_id" class="form-select" required>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                                                {{ $cat->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Penulis <span class="text-danger">*</span></label>
                                                    <input type="text" name="penulis" value="{{ $book->penulis }}" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Penerbit</label>
                                                    <input type="text" name="penerbit" value="{{ $book->penerbit }}" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                                                    <input type="number" name="harga" value="{{ $book->harga }}" class="form-control" min="0" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Stok <span class="text-danger">*</span></label>
                                                    <input type="number" name="stok" value="{{ $book->stok }}" class="form-control" min="0" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-semibold">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="2">{{ $book->deskripsi }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-semibold">Cover Buku</label>
                                                    <div class="d-flex align-items-center gap-2">
                                                        @if($book->gambar && file_exists(public_path('storage/' . $book->gambar)))
                                                            <img src="{{ asset('storage/' . $book->gambar) }}" class="rounded border" style="width: 40px; height: 55px; object-fit: cover;">
                                                        @endif
                                                        <input type="file" name="gambar" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada data buku.
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
    document.getElementById('filterInput').addEventListener('keyup', function() {
        const val = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBuku tbody tr');
        rows.forEach(r => {
            r.style.display = r.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush
