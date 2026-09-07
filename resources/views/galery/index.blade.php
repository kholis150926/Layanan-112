<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SAAT 112</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-blue: #2f6fed;
            --brand-blue-dark: #1e2a5c;
            --brand-red: #e53935;
            --bg-soft: #f4f6fb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-soft);
            color: #1f2937;
        }

        a { text-decoration: none; }

        /* ===== Navbar ===== */
        .navbar-saat {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: .75rem 0;
        }
        .navbar-saat .brand-icon {
            width: 38px; height: 38px;
            background: var(--brand-blue);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.1rem;
        }
        .navbar-saat .brand-title { font-weight: 700; font-size: 1.05rem; line-height: 1.1; color: #111827; }
        .navbar-saat .brand-sub { font-size: .72rem; color: #9ca3af; }
        .navbar-saat .nav-link {
            color: #374151; font-weight: 500; font-size: .92rem; padding: .4rem .9rem;
        }
        .navbar-saat .nav-link.active {
            color: #fff;
            font-weight: 600;
            background: var(--brand-blue);
            border-radius: 50px;
        }
        .btn-darurat-nav {
            background: var(--brand-red);
            color: #fff; font-weight: 600; font-size: .88rem;
            border-radius: 50px; padding: .5rem 1.2rem;
            border: none;
        }
        .btn-darurat-nav:hover { color: #fff; opacity: .92; }
        .admin-link { color: #9ca3af; font-size: .88rem; }

        .page-title { color: #9ca3af; font-weight: 500; margin: 1.5rem 0 1rem; }

        /* ===== Header ===== */
        .ks-header { text-align: center; margin-bottom: 2rem; }
        .ks-header h2 { color: var(--brand-blue); font-weight: 700; font-size: 1.6rem; }
        .ks-header p { color: #6b7280; font-size: .9rem; max-width: 520px; margin: .4rem auto 0; }

        /* ===== Galeri Card Styles ===== */
        .galeri-card {
            background: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 2px 14px rgba(0,0,0,.04);
            transition: all 0.25s ease;
        }

        .galeri-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .galeri-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .galeri-body {
            padding: 16px;
        }

        .galeri-title {
            color: #111827;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .galeri-date {
            color: #9ca3af;
            font-size: 12px;
            margin-bottom: 0;
        }

        .galeri-empty {
            background: white;
            padding: 40px;
            border-radius: 16px;
            color: #888;
            text-align: center;
            box-shadow: 0 2px 14px rgba(0,0,0,.04);
        }

        /* ===== Footer ===== */
        .footer-saat { background: #10182b; color: #cbd5e1; padding: 3rem 0 1rem; margin-top: 9rem; }
        .footer-saat h6 { color: #fff; font-weight: 700; }
        .footer-saat a { color: #9aa5b8; font-size: .88rem; }
        .footer-saat a:hover { color: #fff; }
        .footer-saat .footer-brand { display: flex; align-items: center; gap: .6rem; margin-bottom: .8rem; }
        .footer-saat p.small-text { font-size: .85rem; color: #9aa5b8; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 2rem; padding-top: 1.2rem; font-size: .78rem; color: #6b7280; text-align: center; }
        .footer-emergency-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--brand-red); display: flex; align-items: center; justify-content: center; color: #fff; }
    </style>
</head>
<body>

<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg navbar-saat sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('beranda') }}">
            <span class="brand-icon"><i class="bi bi-shield-fill-check"></i></span>
            <span>
                <span class="d-block brand-title">SAAT 112</span>
                <span class="d-block brand-sub">Kutai Timur</span>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navSaat">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navSaat">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('galery') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="page-title">Galeri</div>

    <!-- ===== Header ===== -->
    <div class="ks-header">
        <h2>Galeri Kegiatan</h2>
        <p>Dokumentasi kegiatan dan operasi layanan 112 Kutai Timur.</p>
    </div>

    <!-- ===== Content Galeri ===== -->
    <div class="row g-4 mb-5">
        @forelse ($galeries as $galeri)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="galeri-card">
                    <img
                        src="{{ str_starts_with($galeri->gambar, 'galery/') || str_contains($galeri->gambar, '/') ? asset('storage/' . $galeri->gambar) : asset('storage/galery/' . $galeri->gambar) }}"
                        alt="{{ $galeri->judul }}"
                        class="galeri-image"
                    >
                    <div class="galeri-body">
                        <h5 class="galeri-title">{{ $galeri->judul }}</h5>
                        <p class="galeri-date">
                            {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="galeri-empty">
                    Belum ada dokumentasi kegiatan yang ditambahkan.
                </div>
            </div>
        @endforelse
    </div>

    <!-- ===== Pagination ===== -->
    @if (isset($galeries) && $galeries instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="mt-4 d-flex justify-content-center">
            {{ $galeries->links() }}
        </div>
    @endif
</div>

<!-- ===== Footer ===== -->
<footer class="footer-saat">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="footer-brand">
                    <span class="footer-emergency-icon"><i class="bi bi-shield-fill-check"></i></span>
                    <h6 class="mb-0">SAAT 112</h6>
                </div>
                <p class="small-text">
                    Layanan darurat terpadu untuk masyarakat Kabupaten Kutai Timur, Kalimantan Timur.
                </p>
                <p class="small-text mb-0">&copy; Diskominfo Kabupaten Kutai Timur 2026</p>
            </div>
            <div class="col-md-3">
                <h6>Navigasi Cepat</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mt-3">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('profil') }}">Profil</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('laporan.index') }}">Tentang</a></li>
                    <li><a href="{{ route('galery') }}">Galeri</a></li>
                    <li><a href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Kontak Darurat</h6>
                <div class="d-flex align-items-center gap-2 mt-3 mb-2">
                    <i class="bi bi-telephone-fill text-danger"></i>
                    <div>
                        <div class="fw-semibold text-white">112</div>
                        <div class="small-text">Bebas Pulsa 24 Jam</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-envelope-fill"></i>
                    <span class="small-text">112@kutaitimurkab.go.id</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="small-text">Jl. Soekarno-Hatta, Sangatta</span>
                </div>
            </div>
            <div class="col-md-3">
                <h6>Media Sosial</h6>
                <div class="d-flex align-items-center gap-2 mt-3 mb-2">
                    <i class="bi bi-whatsapp"></i>
                    <span class="small-text">081210007112</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-instagram"></i>
                    <span class="small-text">@kutimsiaga112</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-telegram"></i>
                    <span class="small-text">kutimsiaga112_bot</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-facebook"></i>
                    <span class="small-text">kutimsiaga112</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            Diskominfo Kabupaten Kutai Timur &mdash; Sistem Informasi Darurat Kabupaten Kutai Timur
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>