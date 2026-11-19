<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookStore - Toko Buku Online')</title>

    <!-- Google Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CDN & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FAF7F2;
            font-family: 'Poppins', sans-serif;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar & Button Custom Styling */
        .bg-navbar-user {
            background-color: #1E40AF !important;
        }

        .btn-primary {
            background-color: #1E40AF;
            border-color: #1E40AF;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #1D4ED8;
            border-color: #1D4ED8;
        }

        .btn-outline-primary {
            color: #1E40AF;
            border-color: #1E40AF;
        }

        .btn-outline-primary:hover {
            background-color: #1E40AF;
            border-color: #1E40AF;
            color: #FFFFFF;
        }

        .text-primary-custom {
            color: #1E40AF !important;
        }

        .badge-soft-primary {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .card {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            background-color: #FFFFFF;
        }

        .navbar-dark .navbar-nav .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: #E2E8F0 !important;
            padding: 0.5rem 0.85rem !important;
        }

        .navbar-dark .navbar-nav .nav-link:hover, 
        .navbar-dark .navbar-nav .nav-link.active {
            color: #FFFFFF !important;
        }

        /* Simple Book Cover Placeholder */
        .book-placeholder {
            height: 220px;
            background-color: #EFF6FF;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #1E40AF;
            padding: 1rem;
            text-align: center;
        }

        .book-placeholder i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: #3B82F6;
        }

        footer {
            margin-top: auto;
            background-color: #FFFFFF;
            border-top: 1px solid #E2E8F0;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- ============================================================ -->
    <!-- NAVBAR PENGUNJUNG & CUSTOMER (Biru #1E40AF, Sticky, Responsif) -->
    <!-- ============================================================ -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar-user shadow-sm sticky-top">
        <div class="container">
            <!-- Brand / Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span>📚 BookStore</span>
            </a>

            <!-- Tombol Hamburger (Layar Kecil) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUserCollapse" aria-controls="navUserCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Isi Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navUserCollapse">
                <!-- Sisi Kiri: Menu Publik -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-grid me-1"></i> Katalog Buku
                        </a>
                    </li>
                </ul>

                <!-- Sisi Kanan: Auth & Menu Pengguna -->
                <div class="d-flex align-items-center flex-wrap gap-2">
                    @guest
                        <!-- Jika Belum Login -->
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-light text-primary fw-bold">
                            <i class="bi bi-person-plus me-1"></i> Register
                        </a>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <!-- Jika Login sebagai Admin -->
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-warning fw-bold">
                                <i class="bi bi-speedometer2 me-1"></i> Panel Admin
                            </a>
                            <span class="text-white small ms-1 me-1">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        @elseif(auth()->user()->role === 'user')
                            <!-- Jika Login sebagai Customer -->
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('jumlah');
                            @endphp
                            <a class="nav-link text-white position-relative px-2 me-1 {{ request()->routeIs('cart.*') ? 'active fw-bold' : '' }}" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart3 fs-5 me-1"></i> Keranjang
                                @if($cartCount > 0)
                                    <span class="badge bg-danger rounded-pill ms-1" style="font-size: 0.72rem;">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                            <a class="nav-link text-white px-2 me-2 {{ request()->routeIs('orders.*') ? 'active fw-bold' : '' }}" href="{{ route('orders.my') }}">
                                <i class="bi bi-box-seam me-1"></i> Pesanan Saya
                            </a>
                            <span class="text-white fw-semibold small me-2 d-none d-md-inline">
                                <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Notifikasi Alert Flash -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-circle me-1"></i> Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-1 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Konten Halaman -->
    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer Sederhana -->
    <footer class="py-4 mt-auto">
        <div class="container text-center text-muted small">
            <p class="mb-1 fw-semibold text-dark">📚 BookStore - Toko Buku Online</p>
            <p class="mb-1">Platform Pemesanan Buku Sederhana & Simulasi Pembayaran Internal</p>
            <p class="mb-0">&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
