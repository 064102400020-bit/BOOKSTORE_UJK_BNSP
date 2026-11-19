<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - BookStore')</title>

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
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling (Kiri ke samping) */
        .sidebar {
            width: 250px;
            background-color: #1E3A8A;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            color: #fff;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            font-size: 1.15rem;
            font-weight: 700;
            color: #FFFFFF;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-menu .nav-item {
            margin: 0.2rem 0.8rem;
        }

        .sidebar-menu .nav-link {
            color: #BFDBFE;
            padding: 0.65rem 1rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-menu .nav-link:hover {
            color: #FFFFFF;
            background-color: rgba(255, 255, 255, 0.08);
        }

        .sidebar-menu .nav-link.active {
            color: #FFFFFF;
            background-color: #1D4ED8;
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* Content Area (Di kanan samping sidebar) */
        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 0.85rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-primary {
            background-color: #1E40AF;
            border-color: #1E40AF;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #1D4ED8;
            border-color: #1D4ED8;
        }

        .text-primary-custom {
            color: #1E40AF !important;
        }

        .badge-soft-primary {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .table th {
            background-color: #F8FAFC;
            font-weight: 600;
            color: #475569;
            font-size: 0.88rem;
        }

        .table td {
            font-size: 0.9rem;
            vertical-align: middle;
        }

        footer {
            margin-top: auto;
            background-color: #FFFFFF;
            border-top: 1px solid #E2E8F0;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: static;
                width: 100%;
                min-height: auto;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- SIDEBAR KIRI (LAYOUT KE SAMPING) -->
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span>📚 Admin BookStore</span>
        </a>

        <ul class="sidebar-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                    <i class="bi bi-book"></i>
                    <span>Data Buku</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                    <i class="bi bi-people"></i>
                    <span>Data Customer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
                    <i class="bi bi-bag-check"></i>
                    <span>Data Pesanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}" href="{{ route('admin.contacts') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Pesan Masuk</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="small text-truncate mb-2 text-white-50">
                <i class="bi bi-person-circle me-1"></i>
                <span class="text-white fw-semibold">{{ auth()->user()->name ?? 'Administrator' }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger w-100 d-flex align-items-center justify-content-center gap-1 py-1">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT WRAPPER DI SEBELAH KANAN -->
    <div class="main-wrapper">
        <!-- Top Header Info -->
        <header class="top-header">
            <div class="fw-semibold text-dark">
                <i class="bi bi-grid-fill text-primary-custom me-2"></i>Panel Kontrol Admin
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small"><i class="bi bi-shield-check text-success me-1"></i>Akses Administrator</span>
            </div>
        </header>

        <!-- Flash Alerts -->
        <div class="container-fluid px-4 mt-3">
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
                    <strong><i class="bi bi-exclamation-circle me-1"></i> Terjadi kesalahan input:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <!-- Main Content Area -->
        <main class="container-fluid px-4 my-3 flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-3 mt-auto">
            <div class="container-fluid px-4 text-center text-muted small">
                &copy; {{ date('Y') }} Admin BookStore - Panel Pengelolaan Data Buku & Pesanan.
            </div>
        </footer>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
