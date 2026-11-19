@extends('layouts.app_admin')

@section('title', 'Data Customer - Admin BookStore')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-0">Daftar Customer Terdaftar</h5>
            <small class="text-muted">Total: <strong>{{ $users->count() }}</strong> customer</small>
        </div>
        <input type="text" id="userFilter" class="form-control form-control-sm" placeholder="Cari nama / email..." style="max-width: 220px;">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered mb-0 align-middle" id="tableCustomer">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama Lengkap</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 15%;">No. Telepon / HP</th>
                    <th style="width: 20%;">Alamat</th>
                    <th class="text-center" style="width: 10%;">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <strong class="text-dark">{{ $user->name }}</strong>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_hp ?: '-' }}</td>
                        <td class="small text-muted">{{ $user->alamat ?: '-' }}</td>
                        <td class="text-center small text-muted">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada customer terdaftar.
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
    document.getElementById('userFilter').addEventListener('keyup', function() {
        const val = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableCustomer tbody tr');
        rows.forEach(r => {
            r.style.display = r.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush
