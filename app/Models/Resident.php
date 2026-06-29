<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kk', 'nik', 'name', 'gender', 'birth_place', 
        'birth_date', 'marital_status', 'religion', 'profession', 'address'
    ];
}