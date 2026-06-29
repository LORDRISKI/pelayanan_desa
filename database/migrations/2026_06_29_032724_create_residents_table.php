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
    Schema::create('residents', function (Blueprint $table) {
        $table->id();
        $table->string('no_kk', 16);
        $table->string('nik', 16)->unique();
        $table->string('name');
        $table->enum('gender', ['L', 'P']);
        $table->string('birth_place');
        $table->date('birth_date');
        $table->enum('marital_status', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
        $table->string('religion');
        $table->string('profession');
        $table->text('address');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
