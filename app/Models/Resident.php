<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kk', 
        'nik', 
        'name', 
        'gender', 
        'birth_place', 
        'birth_date', 
        'marital_status', 
        'religion', 
        'profession', 
        'address'
    ];

    /**
     * Relasi ke model Letter (Satu penduduk bisa memiliki banyak surat).
     */
    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    /**
    * Aksesor untuk menghitung umur secara otomatis dari birth_date.
    * Panggil di blade dengan: $resident->age
    */
    public function getAgeAttribute()
    {
    return \Carbon\Carbon::parse($this->birth_date)->age;
    }
}