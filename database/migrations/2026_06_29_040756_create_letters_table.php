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
    Schema::create('letters', function (Blueprint $table) {
        $table->id();
        $table->string('letter_number'); // Nomor Surat (contoh: 140/05/SKD/2026)
        $table->string('letter_type');   // Jenis Surat: SKD, SKU, SKTM
        $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade'); // Terhubung ke data penduduk
        $table->date('letter_date');     // Tanggal dikeluarkan
        $table->text('purpose');         // Keperluan pembuatan surat
        $table->foreignId('user_id')->constrained('users'); // Perangkat desa yang memproses
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
