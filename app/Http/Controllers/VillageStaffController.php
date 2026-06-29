<?php

namespace App\Http\Controllers;

use App\Models\VillageStaff;
use Illuminate\Http\Request;

class VillageStaffController extends Controller
{
    /**
     * Menampilkan Struktur Organisasi berdasarkan urutan jabatan (sort_order).
     */
    public function index()
    {
        // Ambil perangkat desa diurutkan dari jabatan tertinggi (sort_order terkecil)
        $staffs = VillageStaff::orderBy('sort_order', 'asc')->get();
        return view('staffs.index', compact('staffs'));
    }

    /**
     * Menyimpan data perangkat desa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'sort_order' => 'required|numeric',
        ]);

        VillageStaff::create($request->all());

        return redirect()->back()->with('success', 'Perangkat desa baru berhasil ditambahkan ke struktur!');
    }
}