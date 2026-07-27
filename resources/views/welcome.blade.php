<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Layanan 112</title>

    <!-- Memanggil Asset Bootstrap via Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">LAYANAN 112</a>
        </div>
    </nav>

    <!-- Konten Utamna -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center p-5">
                        <span class="badge bg-success mb-3 fs-6">Bootstrap 5 Aktif</span>
                        <h2 class="card-title fw-bold">Selamat Datang di Portal Layanan 112</h2>
                        <p class="card-text text-muted mt-2">
                            Aset Vite & Bootstrap sudah ter-compile dengan sempurna.
                        </p>
                        <div class="mt-4">
                            <button class="btn btn-primary me-2">
                                <i class="bi bi-check-circle"></i> Tombol Primary
                            </button>
                            <button class="btn btn-outline-secondary">Tombol Secondary</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>