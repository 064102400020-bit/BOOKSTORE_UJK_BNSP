<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore - Toko Buku Online')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FAF7F2;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ====== TOP BAR ====== */
        .top-bar {
            background-color: #1E40AF;
            padding: 0.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .top-bar .brand {
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            letter-spacing: 0.5px;
        }

        .top-bar .top-links {
            display: flex;
            gap: 1.25rem;
            align-items: center;
        }

        .top-bar .top-links a {
            color: #BFDBFE;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .top-bar .top-links a:hover {
            color: #fff;
        }

        /* ====== ALERT AREA ====== */
        .landing-alerts {
            padding: 0.5rem 2rem 0;
        }

        /* ====== CONTENT AREA ====== */
        .landing-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Form inputs */
        .form-control {
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            font-size: 0.9rem;
            padding: 0.55rem 0.85rem;
        }

        .form-control:focus {
            border-color: #1E40AF;
            box-shadow: 0 0 0 0.15rem rgba(30, 64, 175, 0.15);
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.3rem;
        }

        .btn-primary {
            background-color: #1E40AF;
            border-color: #1E40AF;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #1D4ED8;
            border-color: #1D4ED8;
        }

        .btn-outline-primary {
            color: #1E40AF;
            border-color: #1E40AF;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: #1E40AF;
            border-color: #1E40AF;
            color: #fff;
        }

        .text-primary-custom { color: #1E40AF !important; }
        .link-primary-custom {
            color: #1E40AF;
            text-decoration: none;
            font-weight: 600;
        }
        .link-primary-custom:hover { color: #1D4ED8; text-decoration: underline; }

        /* ====== FOOTER ====== */
        .landing-footer {
            background-color: #fff;
            border-top: 1px solid #E2E8F0;
            padding: 0.9rem 2rem;
            text-align: center;
            font-size: 0.8rem;
            color: #94A3B8;
        }

        /* invalid-feedback color */
        .invalid-feedback { font-size: 0.8rem; }
    </style>

    @stack('styles')
</head>
<body>

    {{-- ===== TOP BAR ===== --}}
    <div class="top-bar">
        <a href="{{ route('home') }}" class="brand">📚 BookStore</a>
        <div class="top-links">
            <a href="{{ route('about') }}"><i class="bi bi-info-circle me-1"></i>About Us</a>
            <a href="{{ route('contact.index') }}"><i class="bi bi-envelope me-1"></i>Contact Admin</a>
        </div>
    </div>

    {{-- ===== FLASH ALERTS ===== --}}
    <div class="landing-alerts">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    {{-- ===== HALAMAN UTAMA ===== --}}
    <div class="landing-main">
        @yield('content')
    </div>

    {{-- ===== FOOTER ===== --}}
    <div class="landing-footer">
        &copy; {{ date('Y') }} BookStore &mdash; Toko Buku Online
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
