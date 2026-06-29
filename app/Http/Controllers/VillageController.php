<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\VillageStructure; // Pastikan model ini sudah dibuat atau sesuaikan namanya

class VillageController extends Controller
{
    /**
     * Menampilkan halaman Struktur Desa
     */
    public function structure()
    {
        // Mengambil data baris pertama dari tabel struktur
        $villageStructure = VillageStructure::first();
        
        // Membuka view di folder resources/views/villages/structure.blade.php
        return view('villages.structure', compact('villageStructure'));
    }

    /**
     * Memproses upload berkas gambar struktur baru
     */
    public function uploadStructure(Request $request)
    {
        // 1. Validasi keaslian berkas gambar
        $request->validate([
            'structure_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil data record yang sudah ada atau buat baru jika kosong
        $structure = VillageStructure::first() ?? new VillageStructure();

        if ($request->hasFile('structure_image')) {
            // Hapus file gambar lama dari storage jika ada agar menghemat ruang berkas
            if ($structure->image_path) {
                Storage::disk('public')->delete($structure->image_path);
            }

            // Simpan file baru ke folder storage/app/public/structure
            $path = $request->file('structure_image')->store('structure', 'public');
            $structure->image_path = $path;
            $structure->save();
        }

        return redirect()->back()->with('success', 'Bagan struktur organisasi berhasil diperbarui!');
    }
}