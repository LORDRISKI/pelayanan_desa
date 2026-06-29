<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data statistik dari database
        $totalResidents = Resident::count();
        $totalMale = Resident::where('gender', 'L')->count();
        $totalFemale = Resident::where('gender', 'P')->count();
        $totalUsers = User::count();

        // 2. Pembagian data status perkawinan untuk Chart.js
        $maritalData = [
            'Belum_Kawin' => Resident::where('marital_status', 'Belum Kawin')->count(),
            'Kawin' => Resident::where('marital_status', 'Kawin')->count(),
            'Cerai_Hidup' => Resident::where('marital_status', 'Cerai Hidup')->count(),
            'Cerai_Mati' => Resident::where('marital_status', 'Cerai Mati')->count(),
        ];

        // 3. Kirim data ke halaman dashboard view
        return view('dashboard', compact(
            'totalResidents', 
            'totalMale', 
            'totalFemale', 
            'totalUsers', 
            'maritalData'
        ));
    }
}