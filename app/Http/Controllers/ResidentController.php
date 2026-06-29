<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    // 1. Menampilkan Tabel Semua Penduduk
    public function index()
    {
        $residents = Resident::latest()->paginate(10);
        return view('residents.index', compact('residents'));
    }

    // 2. Menampilkan Form Tambah Penduduk
    public function create()
    {
        return view('residents.create');
    }

    // 3. Menyimpan Data Penduduk Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|numeric|digits:16',
            'nik' => 'required|numeric|digits:16|unique:residents,nik',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'marital_status' => 'required',
            'religion' => 'required|string',
            'profession' => 'required|string',
            'address' => 'required|string',
        ]);

        Resident::create($request->all());

        return redirect()->route('residents.index')->with('success', 'Data penduduk berhasil ditambahkan!');
    }
}