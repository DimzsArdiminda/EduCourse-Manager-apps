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
        Schema::create('manajemen_data', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_kursus');
            $table->string('Deskripsi');
            $table->bigInteger('Harga');
            $table->enum('Status', ['Aktif', 'Tidak Aktif']);
            $table->bigInteger('jumlah_siswa_terdaftar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_data');
    }
};
