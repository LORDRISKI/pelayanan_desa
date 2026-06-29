<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pelayanan Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        /* Topbar Biru Utama */
        .topbar {
            background-color: #0d6efd; /* Biru Bootstrap */
            height: 70px;
        }
        /* Pembungkus Sidebar */
        .sidebar {
            width: 260px;
            min-height: calc(100vh - 70px);
            background-color: #212529; /* Gelap / Dark */
        }
        .search-input {
            background-color: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            border-radius: 4px;
            padding-left: 40px;
        }
        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .search-box {
            position: relative;
            width: 350px;
        }
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }
        .logout-btn {
            background: none;
            border: none;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            text-decoration: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            color: #ffc107;
        }
    </style>
</head>
<body class="bg-light">

    <div class="topbar d-flex align-items-center justify-content-between px-3 text-white shadow-sm">
        
        <div class="d-flex align-items-center gap-4">
            <h4 class="mb-0 fw-bold tracking-wide" style="width: 236px;">SIMPELDESA <span class="fs-5 ms-2">»</span></h4>
            
            <div class="search-box d-none d-md-block">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="form-control search-input py-2" placeholder="Cari Menu Surat...">
            </div>
        </div>

        <div class="d-flex align-items-center gap-4">
            <div class="small fw-normal">
                Welcome <span class="fw-bold">{{ Auth::user()->name ?? 'Pengguna' }}</span>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="logout-btn px-2">
                    <i class="fa-solid fa-power-off fs-4 mb-1"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <div class="d-flex">
        
        <div class="sidebar text-white p-3 shadow">
            <ul class="nav flex-column gap-1">
                <!-- Menu: Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ Request::is('dashboard') ? 'bg-primary rounded fw-bold' : '' }} px-3 py-2.5 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-chart-line text-secondary" style="width: 20px;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <!-- Menu: Master Data (Drop-down Collapse sesuai referensi image_a23b93.jpg) -->
                <li class="nav-item">
                    <a class="nav-link text-white px-3 py-2.5 d-flex align-items-center justify-content-between text-decoration-none" 
                    data-bs-toggle="collapse" 
                    href="#masterDataMenu" 
                    role="button" 
                    aria-expanded="{{ Request::is('residents*') || Request::is('structures*') || Request::is('staffs*') ? 'true' : 'false' }}" 
                    aria-controls="masterDataMenu">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-database text-secondary" style="width: 20px;"></i>
                            <span>Master Data</span>
                        </div>
                        <i class="fa-solid fa-chevron-down small text-secondary"></i>
                    </a>
                    
                    <!-- Submenu Container -->
                    <div class="collapse {{ Request::is('residents*') || Request::is('structures*') || Request::is('staffs*') ? 'show' : '' }} ps-3" id="masterDataMenu">
                        <ul class="nav flex-column list-unstyled small gap-1 pt-1">
                            <!-- 1. Data Penduduk -->
                            <li>
                                <a href="{{ route('residents.index') }}" class="nav-link text-white-50 {{ Request::is('residents*') ? 'text-white fw-bold' : '' }} py-2 d-flex align-items-center gap-2">
                                    <span class="text-secondary" style="font-size: 8px;">●</span> Data Penduduk
                                </a>
                            </li>
                            <!-- 2. Struktur Desa -->
                            <li>
                                <a href="{{ route('structures.index') }}" class="nav-link text-white-50 {{ Request::is('structures*') ? 'text-white fw-bold' : '' }} py-2 d-flex align-items-center gap-2">
                                    <span class="text-secondary" style="font-size: 8px;">●</span> Struktur Desa
                                </a>
                            </li>
                            <!-- 3. Perangkat Desa -->
                            <li>
                                <a href="{{ route('staffs.index') }}" class="nav-link text-white-50 {{ Request::is('staffs*') ? 'text-white fw-bold' : '' }} py-2 d-flex align-items-center gap-2">
                                    <span class="text-secondary" style="font-size: 8px;">●</span> Perangkat Desa
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Menu: Administrasi Surat -->
                <li class="nav-item">
                    <a href="{{ route('letters.index') }}" class="nav-link text-white {{ Request::is('letters*') ? 'bg-primary rounded fw-bold' : '' }} px-3 py-2.5 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-envelope text-secondary" style="width: 20px;"></i>
                            <span>Administrasi Surat</span>
                        </div>
                        <span class="badge bg-info text-white rounded-circle px-2 py-1" style="font-size: 11px;">9</span>
                    </a>
                </li>

                <!-- Menu: Pengguna -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ Request::is('users*') ? 'bg-primary rounded fw-bold' : '' }} px-3 py-2.5 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-users text-secondary" style="width: 20px;"></i>
                        <span>Pengguna</span>
                    </a>
                </li>

                <!-- Menu: Pengaturan -->
                <li class="nav-item">
                    <a href="{{ route('settings.edit') }}" class="nav-link text-white {{ Request::is('settings*') ? 'bg-primary rounded fw-bold' : '' }} px-3 py-2.5 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-gear text-secondary" style="width: 20px;"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow-1 p-4" style="min-height: calc(100vh - 70px); overflow-y: auto;">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>