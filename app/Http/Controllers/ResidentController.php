<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Imports\ResidentsImport; // Import class logic excel
use Maatwebsite\Excel\Facades\Excel; // Import facade Laravel Excel
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

    // 4. Memproses Import Data Penduduk dari Excel
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ResidentsImport, $request->file('file_excel'));

        return redirect()->route('residents.index')->with('success', 'Data penduduk berhasil di-import dari Excel!');
    }

    /**
     * Menghapus data penduduk dari database.
     */
    public function destroy($id)
    {
        // 1. Cari data penduduk berdasarkan ID-nya
        $resident = Resident::findOrFail($id);
        
        // 2. Jalankan perintah hapus
        $resident->delete();
        
        // 3. Kembali ke halaman utama data penduduk dengan pesan sukses
        return redirect()->route('residents.index')->with('success', 'Data penduduk berhasil dihapus.');
    }

    /**
     * Menampilkan formulir untuk mengubah data penduduk.
     */
    public function edit($id)
    {
        // 1. Cari data penduduk berdasarkan ID
        $resident = Resident::findOrFail($id);

        // 2. Tampilkan view edit dan oper data penduduknya
        return view('residents.edit', compact('resident'));
    }

    /**
     * Memperbarui data penduduk di database.
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi input dari form (sesuaikan dengan kolom kamu)
        $validatedData = $request->validate([
            'kk_number'      => 'nullable|string|max:16',
            'nik'            => 'required|string|max:16|unique:residents,nik,' . $id,
            'name'           => 'required|string|max:255',
            'gender'         => 'required|in:Laki-laki,Perempuan',
            'birth_date'     => 'required|date',
            'marital_status' => 'required|string',
        ]);

        // 2. Cari data dan update
        $resident = Resident::findOrFail($id);
        $resident->update($validatedData);

        // 3. Kembali ke halaman utama dengan notifikasi sukses
        return redirect()->route('residents.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

        /**
     * Menampilkan detail data dari satu orang penduduk.
     */
    public function show($id)
    {
        // 1. Cari data penduduk berdasarkan ID, jika tidak ada langsung error 404
        $resident = Resident::findOrFail($id);

        // 2. Oper data ke halaman view detail
        return view('residents.show', compact('resident'));
    }
}