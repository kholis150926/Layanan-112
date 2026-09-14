<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - SAAT 112</title>

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

        /* ===== Detail Article Card ===== */
        .article-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            overflow: hidden;
            padding: 2.5rem;
        }

        .btn-back {
            color: #4b5563;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            color: var(--brand-blue);
            transform: translateX(-3px);
        }

        .article-badge {
            font-size: .75rem;
            font-weight: 700;
            padding: .4rem 1rem;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: .03em;
            display: inline-block;
        }
        .article-badge.pengumuman { background: #e0edff; color: var(--brand-blue); }
        .article-badge.kegiatan { background: #e5f7ec; color: #16a34a; }
        .article-badge.statistik { background: #fde8e8; color: var(--brand-red); }

        .article-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #111827;
            line-height: 1.3;
        }

        .article-meta {
            color: #6b7280;
            font-size: 0.88rem;
        }

        .article-img-wrapper {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            margin: 2rem 0;
            background: #f1f5f9;
        }

        .article-img-wrapper img {
            width: 100%;
            max-height: 480px;
            object-fit: cover;
        }

        .article-lead {
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            border-left: 4px solid var(--brand-blue);
            padding-left: 1rem;
            margin-bottom: 1.8rem;
            line-height: 1.6;
        }

        .article-body {
            font-size: 1.05rem;
            color: #374151;
            line-height: 1.85;
        }

        /* ===== Footer ===== */
        .footer-saat { background: #10182b; color: #cbd5e1; padding: 3rem 0 1rem; margin-top: 4rem; }
        .footer-saat h6 { color: #fff; font-weight: 700; }
        .footer-saat a { color: #9aa5b8; font-size: .88rem; }
        .footer-saat a:hover { color: #fff; }
        .footer-saat .footer-brand { display: flex; align-items: center; gap: .6rem; margin-bottom: .8rem; }
        .footer-saat p.small-text { font-size: .85rem; color: #9aa5b8; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 2rem; padding-top: 1.2rem; font-size: .78rem; color: #6b7280; text-align: center; }
        .footer-emergency-icon { width: 36px; height: 36px; border-radius: 50%; background: var(--brand-red); display: flex; align-items: center; justify-content: center; color: #fff; }

        @media (max-width: 768px) {
            .article-card { padding: 1.5rem; }
            .article-title { font-size: 1.6rem; }
        }
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

<!-- ===== Konten Baca Berita ===== -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ route('berita.index') }}" class="btn-back d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Berita
                </a>
            </div>

            <!-- Kartu Artikel Utama -->
            <article class="article-card">

                <!-- Badge Kategori -->
                <span class="article-badge {{ strtolower($berita->kategori ?? 'pengumuman') }} mb-3">
                    {{ $berita->kategori ?? 'Pengumuman' }}
                </span>

                <!-- Judul Utama -->
                <h1 class="article-title mb-3">{{ $berita->judul }}</h1>

                <!-- Waktu & Penulis -->
                <div class="article-meta d-flex align-items-center gap-3 mb-2">
                    <span><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y, H:i') }} WITA</span>
                    <span>•</span>
                    <span><i class="bi bi-person-fill me-1"></i> Admin SAAT 112</span>
                </div>

                <!-- Gambar Utama -->
                @if($berita->gambar_url)
                    <div class="article-img-wrapper">
                        <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}">
                    </div>
                @endif

                <!-- Ringkasan / Highlight -->
                @if($berita->ringkasan)
                    <div class="article-lead">
                        {{ $berita->ringkasan }}
                    </div>
                @endif

                <!-- Isi Konten Lengkap -->
                <div class="article-body">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

            </article>

        </div>
    </div>
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