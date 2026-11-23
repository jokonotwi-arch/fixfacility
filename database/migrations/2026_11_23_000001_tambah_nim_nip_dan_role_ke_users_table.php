<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Login FixFacility memakai NIM/NIP, bukan email
            $table->string('nim_nip', 30)->nullable()->unique()->after('id');
            // pelapor = mahasiswa/dosen yang melapor, admin = pengelola fasilitas
            $table->string('role', 20)->default('pelapor')->after('password');
            // email tidak lagi wajib
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nim_nip']);
            $table->dropColumn(['nim_nip', 'role']);
        });
    }
};
