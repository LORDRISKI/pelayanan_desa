<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        // Ambil data pengaturan pertama, jika belum ada buat data kosong baru
        $setting = Setting::first() ?? Setting::create([
            'village_name' => 'Nama Desa',
            'district_name' => 'Kecamatan',
            'regency_name' => 'Kabupaten',
            'village_address' => 'Alamat Kantor',
        ]);
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'village_name' => 'required|string|max:255',
            'district_name' => 'required|string|max:255',
            'regency_name' => 'required|string|max:255',
            'village_address' => 'required|string',
            'letter_header_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['village_name', 'district_name', 'regency_name', 'village_address']);

        if ($request->hasFile('letter_header_logo')) {
            // Hapus logo lama jika ada
            if ($setting->letter_header_logo) {
                Storage::delete('public/' . $setting->letter_header_logo);
            }
            $data['letter_header_logo'] = $request->file('letter_header_logo')->store('assets/logo', 'public');
        }

        $setting->update($data);
        return redirect()->back()->with('success', 'Identitas desa berhasil diperbarui!');
    }
}