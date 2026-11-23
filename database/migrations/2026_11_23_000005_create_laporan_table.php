<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique();          // contoh: FF-008
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();       // pelapor
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->restrictOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori')->restrictOnDelete();
            $table->foreignId('status_id')->constrained('status_laporan')->restrictOnDelete();
            $table->string('judul', 150);
            $table->string('lokasi', 150);
            $table->text('deskripsi');
            $table->string('foto');                         // path file foto bukti (JPG/PNG, maks 5 MB)
            $table->timestamps();                           // created_at = tanggal laporan dikirim

            $table->index('created_at');                    // untuk rekap per periode
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
