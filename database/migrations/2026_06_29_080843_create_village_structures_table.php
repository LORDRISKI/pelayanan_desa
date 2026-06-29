<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // Harus menggunakan Facade Schema

return new class extends Migration
{
    public function up(): void
    {
        // PASTIKAN MENGGUNAKAN Schema::create, BUKAN Route::create
        Schema::create('village_structures', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_structures');
    }
};