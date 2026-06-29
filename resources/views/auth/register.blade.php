<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register System - Aplikasi Pelayanan Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Sisi Kanan: Gambar Background Penuh */
        .bg-image {
            background-image: url('{{ asset("assets/images/bg-desa.jpg") }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        /* Sisi Kiri: Form Register */
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
        }
        .login-form-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        .form-control {
            padding: 12px;
            border-radius: 8px;
        }
        .btn-register {
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            background-color: #28a745;
            border: none;
        }
        .btn-register:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-lg-4 col-md-5 login-container shadow-lg">
                <div class="login-form-box text-center">
                    
                    <div class="mb-3">
                    <img src="{{ asset('assets/images/logo-desa.png') }}" alt="Logo Desa" style="max-height: 90px; width: auto; object-fit: contain;">
                    </div>

                    <h4 class="text-secondary fw-normal mb-1">Pendaftaran Akun</h4>
                    <h5 class="text-muted fw-bold mb-4">Desa Sungai Itik - Sadu</h5>

                    <p class="text-secondary mb-4">Silahkan Isi Data Akun Baru</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-floating mb-3 text-start">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                            <label for="floatingName" class="text-muted">Nama Lengkap</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3 text-start">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingEmail" placeholder="name@example.com" value="{{ old('email') }}" required>
                            <label for="floatingEmail" class="text-muted">Email / Username</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3 text-start">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword" class="text-muted">Password</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 text-start">
                            <input type="password" name="password_confirmation" class="form-control" id="floatingPasswordConfirm" placeholder="Ulangi Password" required>
                            <label for="floatingPasswordConfirm" class="text-muted">Konfirmasi Password</label>
                        </div>

                        <button type="submit" class="btn btn-success btn-register w-100 text-white shadow-sm mb-3">DAFTAR AKUN</button>

                        <div class="text-center small">
                            <span class="text-muted">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">Login di sini</a>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-lg-8 col-md-7 d-none d-md-block bg-image"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>