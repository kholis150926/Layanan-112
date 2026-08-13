<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin SAAT 112 - Login</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Panggil File CSS Khusus -->
    <link rel="stylesheet" href="{{ asset('css/admin-auth.css') }}">
</head>
<body>

    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100 py-4 px-3">
        
        <!-- Icon Gembok -->
        <div class="lock-icon-box mb-3">
            <i class="bi bi-lock"></i>
        </div>
        
        <!-- Judul -->
        <h2 class="text-white fw-bold mb-1 fs-3">Admin SAAT 112</h2>
        <p class="text-white-50 small mb-4">Kutai Timur</p>

        <!-- Kartu Login Putih -->
        <div class="login-card">
            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold text-navy small">Username</label>
                    <input type="text" name="username" id="username"
                           class="form-control custom-input"
                           placeholder="admin" value="{{ old('username') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold text-navy small">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-control custom-input"
                           placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-login w-100 mb-3">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        <!-- Tombol Kembali -->
        <a href="/" class="back-link mt-4">
            &larr; Kembali ke Halaman Utama
        </a>

    </div>

</body>
</html>