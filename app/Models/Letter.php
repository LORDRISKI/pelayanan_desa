<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = ['letter_number', 'letter_type', 'resident_id', 'letter_date', 'purpose', 'user_id'];

    // Relasi balik: Satu surat dimiliki oleh satu penduduk
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}