<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Informasi - SAAT 112</title>

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
            color: #fff; font-weight: 600; background: var(--brand-blue);
            border-radius: 50px;
        }

        .page-title { color: #9ca3af; font-weight: 500; margin: 1.5rem 0 1rem; }

        /* ===== Header Berita ===== */
        .berita-header h4 { font-weight: 700; color: #111827; }

        .filter-pill {
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
            font-size: .85rem;
            font-weight: 500;
            padding: .45rem 1.1rem;
            border-radius: 50px;
        }
        .filter-pill.active {
            background: var(--brand-blue);
            border-color: var(--brand-blue);
            color: #fff;
        }
        .filter-pill:hover { color: inherit; text-decoration: none; }

        /* ===== Berita Cards ===== */
        .news-card { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,.05); height: 100%; }
        .news-card img { height: 170px; object-fit: cover; width: 100%; }
        .news-card .card-body { padding: 1.1rem; }
        .news-badge { font-size: .68rem; font-weight: 600; padding: .3rem .7rem; border-radius: 50px; text-transform: uppercase; letter-spacing: .02em; }
        .news-badge.pengumuman { background: #e0edff; color: var(--brand-blue); }
        .news-badge.kegiatan { background: #e5f7ec; color: #16a34a; }
        .news-badge.statistik { background: #fde8e8; color: var(--brand-red); }
        .news-card h6 { font-weight: 700; margin-top: .7rem; font-size: .95rem; line-height: 1.35; }
        .news-card p { font-size: .82rem; color: #6b7280; }
        .news-footer { display: flex; align-items: center; justify-content: space-between; margin-top: .6rem; }
        .news-date { font-size: .75rem; color: #9ca3af; }
        .news-read { font-size: .8rem; font-weight: 600; color: var(--brand-blue); }

        /* ===== Footer ===== */
        .footer-saat { background: #10182b; color: #cbd5e1; padding: 3rem 0 1rem; margin-top: 3rem; }
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('galery') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kritik-saran') }}">Kritik & Saran</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="page-title">Berita</div>

    <!-- ===== Header + Filter ===== -->
    <div class="berita-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <h4 class="mb-0">Berita & Informasi</h4>
        <div class="d-flex gap-2 flex-wrap">
            @php
                $filterAktif = request('kategori', 'Semua');
                $filters = ['Semua', 'Pengumuman', 'Kegiatan', 'Statistik'];
            @endphp
            @foreach($filters as $filter)
                <a href="{{ route('berita.index', $filter === 'Semua' ? [] : ['kategori' => $filter]) }}"
                   class="filter-pill {{ $filterAktif === $filter ? 'active' : '' }}">
                    {{ $filter }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- ===== Grid Berita (Dinamis Database) ===== -->
    <div class="row g-4 mb-5">
        @forelse($beritaList as $berita)
            <div class="col-md-6 col-lg-4">
                <div class="card news-card">
                    <!-- Memanggil gambar_url dari database -->
                    <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                    <div class="card-body">
                        <!-- Badge Kategori -->
                        <span class="news-badge {{ strtolower($berita->kategori ?? 'pengumuman') }}">
                            {{ $berita->kategori ?? 'Pengumuman' }}
                        </span>
                        <h6>{{ $berita->judul }}</h6>
                        <p class="mb-0">{{ Str::limit($berita->ringkasan ?? $berita->konten, 90) }}</p>
                        <div class="news-footer">
                            <span class="news-date">
                                {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                            </span>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="news-read">Baca &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- ===== Footer ===== -->
<footer class="footer-saat">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-brand">
                    <span class="footer-emergency-icon"><i class="bi bi-shield-fill-check"></i></span>
                    <h6 class="mb-0">SAAT 112</h6>
                </div>
                <p class="small-text">
                    Layanan darurat terpadu untuk masyarakat Kabupaten Kutai Timur, Kalimantan Timur.
                </p>
                <p class="small-text mb-0">&copy; Diskominfo Kabupaten Kutai Timur 2026</p>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-4">
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
                    <span class="small-text">saat112@kutaitimurkab.go.id</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="small-text">Jl. Soekarno-Hatta, Sangatta</span>
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