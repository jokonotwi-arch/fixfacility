<?php

namespace App\Support;

class DummyData
{
    /**
     * Daftar laporan kerusakan fasilitas kampus.
     * Kode FF-005 sampai FF-008 sesuai spesifikasi prototipe dan desain.
     */
    public static function getLaporanList(): array
    {
        return [
            [
                'kode' => 'FF-008',
                'judul' => 'Lampu koridor mati',
                'pelapor' => 'Andi',
                'fasilitas' => 'Lampu koridor',
                'lokasi' => 'Gedung A, Lantai 2',
                'lokasi_singkat' => 'Gedung A',
                'kategori' => 'Kelistrikan',
                'deskripsi' => 'Lampu di koridor lantai 2 tidak menyala sejak pagi.',
                'tanggal' => '12 Nov 2026',
                'tanggal_lengkap' => '12 November 2026',
                'status' => 'Menunggu',
                'timeline' => [
                    [
                        'judul' => 'Laporan dikirim',
                        'keterangan' => '12 Nov 2026 • 09.30',
                        'aktif' => true,
                    ],
                    [
                        'judul' => 'Menunggu ditinjau',
                        'keterangan' => 'Admin belum memberikan pembaruan.',
                        'aktif' => false,
                    ],
                ],
            ],
            [
                'kode' => 'FF-007',
                'judul' => 'Kursi ruang kelas rusak',
                'pelapor' => 'Siti',
                'fasilitas' => 'Kursi kelas',
                'lokasi' => 'Ruang 203',
                'lokasi_singkat' => 'Ruang 203',
                'kategori' => 'Peralatan kelas',
                'deskripsi' => 'Dua kursi patah di bagian sandaran.',
                'tanggal' => '10 Nov 2026',
                'tanggal_lengkap' => '10 November 2026',
                'status' => 'Diproses',
                'timeline' => [
                    [
                        'judul' => 'Laporan dikirim',
                        'keterangan' => '10 Nov 2026 • 08.15',
                        'aktif' => true,
                    ],
                    [
                        'judul' => 'Laporan diproses',
                        'keterangan' => 'Sedang ditangani petugas',
                        'aktif' => true,
                    ],
                ],
            ],
            [
                'kode' => 'FF-006',
                'judul' => 'Keran wastafel bocor',
                'pelapor' => 'Budi',
                'fasilitas' => 'Keran wastafel',
                'lokasi' => 'Toilet Lt. 1',
                'lokasi_singkat' => 'Toilet Lt. 1',
                'kategori' => 'Sanitasi',
                'deskripsi' => 'Keran menetes terus dan lantai licin.',
                'tanggal' => '08 Nov 2026',
                'tanggal_lengkap' => '08 November 2026',
                'status' => 'Selesai',
                'timeline' => [
                    [
                        'judul' => 'Laporan dikirim',
                        'keterangan' => '08 Nov 2026 • 11.00',
                        'aktif' => true,
                    ],
                    [
                        'judul' => 'Laporan diproses',
                        'keterangan' => 'Petugas pipa ditugaskan',
                        'aktif' => true,
                    ],
                    [
                        'judul' => 'Selesai',
                        'keterangan' => 'Kerusakan telah ditindaklanjuti',
                        'aktif' => true,
                    ],
                ],
            ],
            [
                'kode' => 'FF-005',
                'judul' => 'AC tidak dingin',
                'pelapor' => 'Rina',
                'fasilitas' => 'AC',
                'lokasi' => 'Ruang 101',
                'lokasi_singkat' => 'Ruang 101',
                'kategori' => 'Peralatan kelas',
                'deskripsi' => 'AC menyala tetapi tidak mengeluarkan udara dingin.',
                'tanggal' => '05 Nov 2026',
                'tanggal_lengkap' => '05 November 2026',
                'status' => 'Selesai',
                'timeline' => [
                    [
                        'judul' => 'Laporan dikirim',
                        'keterangan' => '05 Nov 2026 • 13.45',
                        'aktif' => true,
                    ],
                    [
                        'judul' => 'Laporan diproses',
                        'keterangan' => 'Teknisi memeriksa unit pendingin',
                        'aktif' => true,
                    ],
                    [
                        'judul' => 'Selesai',
                        'keterangan' => 'Kerusakan telah ditindaklanjuti',
                        'aktif' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Ambil 1 laporan berdasarkan kodenya.
     */
    public static function findLaporan(string $kode): ?array
    {
        $normalized = strtoupper(trim($kode));
        foreach (self::getLaporanList() as $item) {
            if (strtoupper($item['kode']) === $normalized) {
                return $item;
            }
        }
        return self::getLaporanList()[0] ?? null;
    }

    /**
     * Statistik untuk Dashboard Pelapor.
     */
    public static function getPelaporStats(): array
    {
        return [
            [
                'label' => 'Total Laporan',
                'value' => '08',
                'subtext' => 'Semua laporan kamu',
            ],
            [
                'label' => 'Menunggu',
                'value' => '03',
                'subtext' => 'Belum ditinjau',
            ],
            [
                'label' => 'Diproses',
                'value' => '02',
                'subtext' => 'Sedang ditangani',
            ],
            [
                'label' => 'Selesai',
                'value' => '03',
                'subtext' => 'Telah ditindaklanjuti',
            ],
        ];
    }

    /**
     * Statistik untuk Dashboard Admin.
     */
    public static function getAdminStats(): array
    {
        return [
            [
                'label' => 'Total Laporan',
                'value' => 128,
                'subtext' => 'Seluruh laporan masuk',
            ],
            [
                'label' => 'Menunggu',
                'value' => 24,
                'subtext' => 'Perlu ditinjau',
            ],
            [
                'label' => 'Diproses',
                'value' => 36,
                'subtext' => 'Sedang ditangani',
            ],
            [
                'label' => 'Selesai',
                'value' => 68,
                'subtext' => 'Sudah ditindaklanjuti',
            ],
        ];
    }

    /**
     * Komposisi status untuk grafik progress/bar.
     */
    public static function getStatusBreakdown(): array
    {
        return [
            [
                'label' => 'Menunggu',
                'value' => 24,
                'color' => '#b8700a',
                'max' => 128,
                'percent' => '18,8%',
            ],
            [
                'label' => 'Diproses',
                'value' => 36,
                'color' => '#2563eb',
                'max' => 128,
                'percent' => '28,1%',
            ],
            [
                'label' => 'Selesai',
                'value' => 68,
                'color' => '#16905a',
                'max' => 128,
                'percent' => '53,1%',
            ],
        ];
    }

    /**
     * Statistik kategori untuk Rekap Laporan.
     */
    public static function getKategoriStats(): array
    {
        return [
            [
                'label' => 'Kelistrikan',
                'value' => 42,
                'color' => '#2563eb',
                'max' => 50,
            ],
            [
                'label' => 'Peralatan kelas',
                'value' => 35,
                'color' => '#2563eb',
                'max' => 50,
            ],
            [
                'label' => 'Sanitasi',
                'value' => 28,
                'color' => '#2563eb',
                'max' => 50,
            ],
            [
                'label' => 'Bangunan',
                'value' => 23,
                'color' => '#2563eb',
                'max' => 50,
            ],
        ];
    }

    /**
     * Ringkasan untuk halaman Rekap.
     */
    public static function getRekapSummary(): array
    {
        return [
            'periode' => 'November 2026',
            'periode_pilihan' => ['November 2026', 'Oktober 2026'],
            'tanggal_update' => '20 Nov 2026',
            'kategori_terbanyak' => 'Kelistrikan',
            'tingkat_penyelesaian' => '53,1%',
            'stats_cards' => [
                [
                    'label' => 'Total Laporan',
                    'value' => 128,
                    'subtext' => 'Semua laporan masuk',
                ],
                [
                    'label' => 'Menunggu',
                    'value' => 24,
                    'subtext' => '18,8% dari total',
                ],
                [
                    'label' => 'Diproses',
                    'value' => 36,
                    'subtext' => '28,1% dari total',
                ],
                [
                    'label' => 'Selesai',
                    'value' => 68,
                    'subtext' => '53,1% dari total',
                ],
            ],
        ];
    }

    /**
     * Opsi dropdown untuk fasilitas dan kategori pada form.
     */
    public static function getFormOptions(): array
    {
        return [
            'fasilitas' => [
                'Lampu',
                'Kursi / meja',
                'AC',
                'Keran / toilet',
                'Proyektor',
            ],
            'kategori' => [
                'Kelistrikan',
                'Peralatan kelas',
                'Sanitasi',
                'Bangunan',
            ],
            'status' => [
                'Menunggu',
                'Diproses',
                'Selesai',
            ],
        ];
    }
}
