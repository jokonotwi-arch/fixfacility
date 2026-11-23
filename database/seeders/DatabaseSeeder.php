<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ReferensiSeeder::class,     // status, kategori, fasilitas
            UserDanLaporanContohSeeder::class, // akun + 4 laporan contoh
        ]);
    }
}
