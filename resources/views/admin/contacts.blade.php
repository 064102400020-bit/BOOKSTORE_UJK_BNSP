@extends('layouts.app_admin')

@section('title', 'Pesan Masuk - Admin BookStore')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-0">Pesan Masuk (Contact to Admin)</h5>
            <small class="text-muted">Total: <strong>{{ $contacts->count() }}</strong> pesan</small>
        </div>
        <input type="text" id="contactFilter" class="form-control form-control-sm" placeholder="Cari nama / subjek..." style="max-width: 220px;">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle" id="tableContacts">
            <thead class="table-light">
                <tr>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 20%;">Pengirim</th>
                    <th style="width: 25%;">Subjek</th>
                    <th style="width: 30%;">Isi Pesan</th>
                    <th class="text-center" style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $c)
                    <tr>
                        <td class="small text-muted">{{ $c->created_at ? $c->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>
                            <strong class="text-dark d-block">{{ $c->nama }}</strong>
                            <small class="text-muted">{{ $c->email }}</small>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">{{ $c->subjek }}</span>
                        </td>
                        <td>
                            <span class="small text-muted text-truncate d-block" style="max-width: 320px;">
                                {{ $c->pesan }}
                            </span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalPesan{{ $c->id }}">
                                <i class="bi bi-eye"></i> Baca
                            </button>

                            <!-- Modal Baca Pesan Sederhana -->
                            <div class="modal fade text-start" id="modalPesan{{ $c->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light py-2 px-3">
                                            <h6 class="modal-title fw-bold">Detail Pesan Masuk</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-3">
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Dari:</small>
                                                <strong>{{ $c->nama }}</strong> ({{ $c->email }})
                                            </div>
                                            <div class="mb-2">
                                                <small class="text-muted d-block">Subjek:</small>
                                                <strong>{{ $c->subjek }}</strong>
                                            </div>
                                            <div class="p-3 bg-light rounded border mb-2">
                                                <small class="text-muted d-block mb-1">Pesan:</small>
                                                <p class="mb-0 text-dark small" style="white-space: pre-wrap;">{{ $c->pesan }}</p>
                                            </div>
                                            <small class="text-muted">Diterima: {{ $c->created_at ? $c->created_at->format('d F Y, H:i') : '-' }} WIB</small>
                                        </div>
                                        <div class="modal-footer py-2 px-3">
                                            <a href="mailto:{{ $c->email }}?subject=Balasan: {{ rawurlencode($c->subjek) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-reply me-1"></i> Balas Email
                                            </a>
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Belum ada pesan masuk.
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
    document.getElementById('contactFilter').addEventListener('keyup', function() {
        const val = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableContacts tbody tr');
        rows.forEach(r => {
            r.style.display = r.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush
