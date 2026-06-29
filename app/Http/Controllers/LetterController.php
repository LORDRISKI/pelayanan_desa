<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function index()
    {
        $letters = Letter::with('resident')->latest()->paginate(10);
        return view('letters.index', compact('letters'));
    }

    public function create()
    {
        $residents = Resident::orderBy('name', 'asc')->get();
        return view('letters.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_number' => 'required|string|unique:letters,letter_number',
            'letter_type' => 'required|in:SKD,SKU,SKTM',
            'resident_id' => 'required|exists:residents,id',
            'letter_date' => 'required|date',
            'purpose' => 'required|string',
        ]);

        Letter::create([
            'letter_number' => $request->letter_number,
            'letter_type' => $request->letter_type,
            'resident_id' => $request->resident_id,
            'letter_date' => $request->letter_date,
            'purpose' => $request->purpose,
            'user_id' => Auth::id(), // Mengambil ID admin yang sedang login
        ]);

        return redirect()->route('letters.index')->with('success', 'Arsip surat berhasil dibuat!');
    }
}