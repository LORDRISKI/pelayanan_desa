<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageStaff extends Model
{
    use HasFactory;

    protected $table = 'village_staffs';
    protected $fillable = ['name', 'role', 'nip', 'phone', 'email', 'sort_order'];
}