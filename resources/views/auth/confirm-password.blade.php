@extends('layouts.app_user')

@section('title', 'Konfirmasi Password - BookStore')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-5">
        <div class="card shadow-sm p-4">
            <h5 class="fw-bold text-dark mb-2">Konfirmasi Password</h5>
            <p class="text-muted small mb-3">
                Ini adalah area aman. Harap konfirmasi password akun Anda sebelum melanjutkan.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
