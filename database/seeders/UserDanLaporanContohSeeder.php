<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Data contoh untuk percobaan saja (sama seperti data dummy frontend).
 * Login: NIM F1G125017 atau admin, sandi 12345678.
 */
class UserDanLaporanContohSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $sandi = Hash::make('12345678');

        $adminId = DB::table('users')->insertGetId([
            'nim_nip' => 'admin', 'name' => 'Admin FixFacility', 'email' => null,
            'password' => $sandi, 'role' => 'admin', 'created_at' => $now, 'updated_at' => $now,
        ]);
        $pelaporId = DB::table('users')->insertGetId([
            'nim_nip' => 'F1G125017', 'name' => 'Raihan Contoh', 'email' => null,
            'password' => $sandi, 'role' => 'pelapor', 'created_at' => $now, 'updated_at' => $now,
        ]);

        // helper kecil: ambil id dari tabel referensi berdasarkan nama
        $id = fn (string $tabel, string $nama) => DB::table($tabel)->where('nama', $nama)->value('id');

        $contoh = [
            ['FF-005', 'AC tidak dingin', 'AC', 'Ruang 101', 'Peralatan kelas',
                'AC menyala tetapi tidak mengeluarkan udara dingin.', 'Selesai', '2026-11-05 09:30:00'],
            ['FF-006', 'Keran wastafel bocor', 'Keran / toilet', 'Toilet Lt. 1', 'Sanitasi',
                'Keran menetes terus dan lantai licin.', 'Selesai', '2026-11-08 09:30:00'],
            ['FF-007', 'Kursi ruang kelas rusak', 'Kursi / meja', 'Ruang 203', 'Peralatan kelas',
                'Dua kursi patah di bagian sandaran.', 'Diproses', '2026-11-10 09:30:00'],
            ['FF-008', 'Lampu koridor mati', 'Lampu', 'Gedung A, Lantai 2', 'Kelistrikan',
                'Lampu di koridor lantai 2 tidak menyala sejak pagi.', 'Menunggu', '2026-11-12 09:30:00'],
        ];

        $keterangan = [
            'Menunggu' => 'Laporan dikirim',
            'Diproses' => 'Sedang ditangani petugas',
            'Selesai'  => 'Kerusakan telah ditindaklanjuti',
        ];

        foreach ($contoh as [$kode, $judul, $fasilitas, $lokasi, $kategori, $deskripsi, $status, $tanggal]) {
            $laporanId = DB::table('laporan')->insertGetId([
                'kode' => $kode, 'user_id' => $pelaporId,
                'fasilitas_id' => $id('fasilitas', $fasilitas),
                'kategori_id' => $id('kategori', $kategori),
                'status_id' => $id('status_laporan', $status),
                'judul' => $judul, 'lokasi' => $lokasi, 'deskripsi' => $deskripsi,
                'foto' => 'laporan/contoh.jpg',
                'created_at' => $tanggal, 'updated_at' => $tanggal,
            ]);

            // riwayat: selalu mulai dari "Menunggu", lalu lanjut sampai status sekarang
            foreach (['Menunggu', 'Diproses', 'Selesai'] as $tahap) {
                DB::table('riwayat_status')->insert([
                    'laporan_id' => $laporanId,
                    'status_id' => $id('status_laporan', $tahap),
                    'diubah_oleh' => $tahap === 'Menunggu' ? null : $adminId,
                    'keterangan' => $keterangan[$tahap],
                    'created_at' => $tanggal,
                ]);
                if ($tahap === $status) {
                    break;
                }
            }
        }
    }
}
