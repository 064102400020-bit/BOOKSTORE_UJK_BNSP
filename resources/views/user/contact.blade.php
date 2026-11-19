@extends('layouts.app_user')

@section('title', 'Hubungi Admin - BookStore')

@section('content')
<div class="row justify-content-center py-2">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm">
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-left-text text-primary-custom me-1"></i> Hubungi Admin
            </h4>
            <p class="text-muted small mb-4">
                Punya pertanyaan atau masukan seputar buku dan layanan BookStore? Silakan kirimkan pesan Anda melalui form di bawah ini.
            </p>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label small fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input id="nama" type="text" name="nama" class="form-control" 
                               value="{{ old('nama', auth()->user()->name ?? '') }}" placeholder="Nama Anda" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label small fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <input id="email" type="email" name="email" class="form-control" 
                               value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="subjek" class="form-label small fw-semibold">Subjek Pesan <span class="text-danger">*</span></label>
                    <input id="subjek" type="text" name="subjek" class="form-control" 
                           value="{{ old('subjek') }}" placeholder="Contoh: Pertanyaan stok buku pemrograman" required>
                </div>

                <div class="mb-4">
                    <label for="pesan" class="form-label small fw-semibold">Isi Pesan <span class="text-danger">*</span></label>
                    <textarea id="pesan" name="pesan" rows="4" class="form-control" 
                              placeholder="Tuliskan pesan Anda dengan lengkap..." required>{{ old('pesan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4 fw-semibold">
                    <i class="bi bi-send me-1"></i> Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
