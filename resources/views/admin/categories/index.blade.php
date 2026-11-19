@extends('layouts.app_admin')

@section('title', 'Kategori Buku - Admin BookStore')

@section('content')
<div class="row">
    <!-- Form Tambah Kategori -->
    <div class="col-md-4 mb-4">
        <div class="card p-3 shadow-sm">
            <h5 class="fw-bold text-dark mb-3">
                <i class="bi bi-tag text-primary-custom me-1"></i> Tambah Kategori Baru
            </h5>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label small fw-semibold">Nama Kategori / Genre <span class="text-danger">*</span></label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Contoh: Pemrograman & IT" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-plus-circle me-1"></i> Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Kategori -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0 text-dark">Daftar Kategori Buku (Total: {{ $categories->count() }})</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10%;">No</th>
                            <th style="width: 60%;">Nama Kategori</th>
                            <th class="text-center" style="width: 30%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $cat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $cat->nama_kategori }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <!-- Tombol Edit Modal -->
                                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#editModal{{ $cat->id }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>

                                        <!-- Form Hapus -->
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori \'{{ $cat->nama_kategori }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Modal Edit Kategori -->
                                    <div class="modal fade text-start" id="editModal{{ $cat->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST" class="modal-content">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-light">
                                                    <h6 class="modal-title fw-bold">Edit Kategori</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-semibold">Nama Kategori</label>
                                                        <input type="text" name="nama_kategori" value="{{ $cat->nama_kategori }}" class="form-control" required>
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
                                <td colspan="3" class="text-center py-4 text-muted">
                                    Belum ada kategori buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
