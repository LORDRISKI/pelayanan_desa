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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('village_name');   // Contoh: Desa Sungai Itik
        $table->string('district_name');  // Kecamatan
        $table->string('regency_name');   // Kabupaten (misal: Tanjung Jabung Timur)
        $table->text('village_address');  // Alamat Kantor Desa
        $table->string('letter_header_logo')->nullable(); // File Logo Desa
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
