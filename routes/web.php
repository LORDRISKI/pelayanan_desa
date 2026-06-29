<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VillageStaffController; // Controller perangkat desa bawaanmu
use App\Http\Controllers\VillageController;      // IMPORT CONTROLLER BARU UNTUK STRUKTUR (BARU)
use Illuminate\Support\Facades\Route;

// Halaman Utama / Landing Page Bawaan
Route::get('/', function () {
    return view('welcome');
});

// Grup Route yang Wajib Login (Auth & Verified)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard (Mengambil Data dari DashboardController)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ==========================================
    // 1. MASTER DATA ROUTES
    // ==========================================
    
    // CRUD Data Penduduk & Import Excel
    Route::resource('residents', ResidentController::class);
    Route::post('/residents/import', [ResidentController::class, 'import'])->name('residents.import');

    // Perangkat Desa (Menggunakan VillageStaffController bawaan proyekmu)
    Route::resource('staffs', VillageStaffController::class);

    // Struktur Desa (Sudah terhubung ke VillageController & disesuaikan namanya agar pas dengan Sidebar)
    Route::get('/structures', [VillageController::class, 'structure'])->name('structures.index');
    Route::post('/structures/upload', [VillageController::class, 'uploadStructure'])->name('village.structure.upload');


    // ==========================================
    // 2. PELAYANAN & MANAJEMEN PENGGUNA
    // ==========================================
    
    // Pelayanan - Administrasi & Cetak Surat
    Route::resource('letters', LetterController::class);

    // Pengguna / Staff System (Route Dummy Sementara agar menu Pengguna tidak error)
    Route::get('/users', function () {
        return 'Halaman Manajemen Pengguna (Siap dikoneksikan ke UserController)';
    })->name('users.index');


    // ==========================================
    // 3. PENGATURAN SISTEM & PROFIL
    // ==========================================
    
    // Pengaturan Sistem & Identitas Desa
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');

    // Manajemen Profil Pengguna/Perangkat Desa yang sedang login
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';