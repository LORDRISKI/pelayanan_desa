<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System - Aplikasi Pelayanan Desa</title>
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
        /* Sisi Kiri: Form Login */
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
        .btn-login {
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            background-color: #007bff;
            border: none;
        }
        .btn-login:hover {
            background-color: #0056b3;
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

                    <h4 class="text-secondary fw-normal mb-1">Aplikasi Pelayanan Desa</h4>
                    <h4 class="text-secondary fw-normal mb-1">Sungai Itik</h4>
                    <h5 class="text-muted fw-bold mb-5">Kecamatan Sadu</h5>

                    <p class="text-secondary mb-4">Silahkan Login</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3 text-start">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            <label for="floatingInput" class="text-muted">Username / Email</label>
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

                        <div class="d-flex justify-content-between align-items-center mb-4 small">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-input-label text-muted" for="remember_me">
                                    Ingat Saya
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Lupa Password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-login w-100 text-white shadow-sm">LOGIN</button>
                    </form>

                </div>
            </div>

            <div class="col-lg-8 col-md-7 d-none d-md-block bg-image"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>