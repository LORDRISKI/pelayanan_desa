<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung menggunakan query LIKE (Case-Insensitive) agar format apapun di database tetap terbaca
        $lakiLaki = Resident::where('gender', 'LIKE', '%laki%')->count();
        $perempuan = Resident::where('gender', 'LIKE', '%perempuan%')->count();

        // Hitung Berdasarkan Status Perkawinan (Gunakan LIKE juga agar lebih aman)
        $kawin = Resident::where('marital_status', 'LIKE', '%Kawin%')->where('marital_status', 'NOT LIKE', '%Belum%')->count();
        $belumKawin = Resident::where('marital_status', 'LIKE', '%Belum%')->count();
        $janda = Resident::where('marital_status', 'LIKE', '%Janda%')->count();
        $duda = Resident::where('marital_status', 'LIKE', '%Duda%')->count();

        return view('dashboard', compact(
            'lakiLaki', 'perempuan', 
            'kawin', 'belumKawin', 'janda', 'duda'
        ));
    }
}