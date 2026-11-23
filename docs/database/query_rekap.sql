-- Query untuk halaman Dashboard dan Rekap (jalankan setelah fixfacility.sql)

-- Total laporan per status (kartu dashboard + "Komposisi Status Laporan")
SELECT s.nama AS status, COUNT(l.id) AS jumlah
FROM status_laporan s LEFT JOIN laporan l ON l.status_id = s.id
GROUP BY s.id, s.nama ORDER BY s.urutan;

-- Laporan per kategori pada satu periode (contoh: November 2026)
SELECT k.nama AS kategori, COUNT(l.id) AS jumlah
FROM kategori k
LEFT JOIN laporan l ON l.kategori_id = k.id
  AND l.created_at >= '2026-11-01' AND l.created_at < '2026-12-01'
GROUP BY k.id, k.nama ORDER BY jumlah DESC;

-- Tingkat penyelesaian (%) periode November 2026
SELECT ROUND(100 * SUM(s.nama = 'Selesai') / COUNT(*), 1) AS persen_selesai
FROM laporan l JOIN status_laporan s ON s.id = l.status_id
WHERE l.created_at >= '2026-11-01' AND l.created_at < '2026-12-01';

-- Daftar laporan admin (tabel "Semua Laporan") dengan filter
SELECT l.kode, l.judul, u.name AS pelapor, l.lokasi, l.created_at, s.nama AS status
FROM laporan l
JOIN users u ON u.id = l.user_id
JOIN status_laporan s ON s.id = l.status_id
JOIN kategori k ON k.id = l.kategori_id
WHERE (l.judul LIKE '%lampu%' OR l.kode LIKE '%lampu%' OR u.name LIKE '%lampu%')
  AND s.nama = 'Menunggu' AND k.nama = 'Kelistrikan'
ORDER BY l.created_at DESC;

-- Timeline satu laporan (halaman Detail)
SELECT r.created_at, s.nama AS status, r.keterangan
FROM riwayat_status r JOIN status_laporan s ON s.id = r.status_id
WHERE r.laporan_id = (SELECT id FROM laporan WHERE kode = 'FF-007')
ORDER BY r.created_at;
