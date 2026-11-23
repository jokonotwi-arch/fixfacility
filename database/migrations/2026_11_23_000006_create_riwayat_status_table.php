<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Setiap perubahan status dicatat di sini -> jadi "Riwayat Perkembangan" (timeline)
        Schema::create('riwayat_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->cascadeOnDelete(); // laporan dihapus -> riwayat ikut terhapus
            $table->foreignId('status_id')->constrained('status_laporan')->restrictOnDelete();
            $table->foreignId('diubah_oleh')->nullable()->constrained('users')->nullOnDelete(); // admin yang mengubah
            $table->string('keterangan')->nullable();       // contoh: "Sedang ditangani petugas"
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_status');
    }
};
