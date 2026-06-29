<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('village_staffs', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('role'); // Jabatan (Kepala Desa, Sekdes, Kasi, dll)
        $table->string('nip')->nullable(); // NIP jika PNS, kosongkan jika tidak
        $table->string('phone');
        $table->string('email')->nullable();
        $table->integer('sort_order')->default(1); // Untuk mengurutkan hierarki jabatan di tampilan
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_staff');
    }
};
