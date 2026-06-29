<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pelayanan Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="d-flex">
        
        <div class="bg-dark text-white p-3 shadow position-relative" style="width: 260px; min-height: 100vh;">
            <h5 class="text-center mb-4 pb-2 border-bottom font-weight-bold text-primary">Pelayanan Desa</h5>
            
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ Request::is('dashboard') ? 'bg-primary rounded fw-bold' : '' }} px-3">
                        Dashboard
                    </a>
                </li>
                
                <li class="nav-item text-secondary px-3 pt-2 small">MASTER DATA</li>
                <li class="nav-item">
                    <a href="{{ route('residents.index') }}" class="nav-link text-white {{ Request::is('residents*') ? 'bg-primary rounded fw-bold' : '' }} px-3">
                        Data Penduduk
                    </a>
                </li>
                
                <li class="nav-item text-secondary px-3 pt-2 small">PELAYANAN</li>
                <li class="nav-item">
                    <a href="{{ route('letters.index') }}" class="nav-link text-white {{ Request::is('letters*') ? 'bg-primary rounded fw-bold' : '' }} px-3">
                        Cetak Surat
                    </a>
                </li>
            </ul>
            
            <div class="position-absolute bottom-0 mb-3" style="width: 228px;">
                <hr class="text-secondary">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">Keluar Sistem</button>
                </form>
            </div>
        </div>

        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>