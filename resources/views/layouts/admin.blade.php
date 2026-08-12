<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') - SAAT 112</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

    <div class="d-flex">

        {{-- SIDEBAR --}}
        <aside class="sidebar d-flex flex-column">
            <div class="sidebar-brand d-flex align-items-center gap-2 px-3 py-3">
                <div class="brand-icon"><i class="bi bi-telephone-fill"></i></div>
                <div>
                    <div class="fw-bold text-white">SAAT 112</div>
                    <div class="small text-white-50">Panel Admin</div>
                </div>
            </div>

            <nav class="nav flex-column px-2 flex-grow-1">
                <a href="{{ route('admin.dashboard') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>

                <a href="{{ route('admin.statistik') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.statistik') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-fill"></i> Statistik
                </a>

                <a href="#" class="nav-link sidebar-link">
                    <i class="bi bi-file-earmark-text-fill"></i> Riwayat
                </a>

                <!-- UPDATE MENU KELOLA KONTEN DI SINI -->
                <a href="{{ route('admin.berita.index') }}" class="nav-link sidebar-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="bi bi-collection-fill"></i> Kelola Konten
                </a>

                <a href="#" class="nav-link sidebar-link">
                    <i class="bi bi-image-fill"></i> Galeri
                </a>
            </nav>

            <div class="sidebar-footer px-3 py-3">
                <div class="text-white small fw-semibold">Admin Diskominfo</div>
                <div class="text-white-50 small mb-2">{{ auth()->user()->email ?? 'admin@kutimkab.go.id' }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-white-50 p-0 small text-decoration-none">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="main-content flex-grow-1">
            @yield('content')
        </main>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>