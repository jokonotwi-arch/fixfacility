<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Status: Menunggu -> Diproses -> Selesai
        Schema::create('status_laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30)->unique();
            $table->unsignedTinyInteger('urutan')->unique(); // urutan tahapan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_laporan');
    }
};
