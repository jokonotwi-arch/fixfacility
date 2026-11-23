<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferensiSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach (['Menunggu', 'Diproses', 'Selesai'] as $i => $nama) {
            DB::table('status_laporan')->updateOrInsert(
                ['nama' => $nama],
                ['urutan' => $i + 1, 'created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['Kelistrikan', 'Peralatan kelas', 'Sanitasi', 'Bangunan'] as $nama) {
            DB::table('kategori')->updateOrInsert(
                ['nama' => $nama],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }

        foreach (['Lampu', 'Kursi / meja', 'AC', 'Keran / toilet', 'Proyektor'] as $nama) {
            DB::table('fasilitas')->updateOrInsert(
                ['nama' => $nama],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }
    }
}
