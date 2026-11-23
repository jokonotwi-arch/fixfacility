-- =====================================================
-- FixFacility - Database (MySQL / MariaDB)
-- Cara pakai: buka phpMyAdmin > tab SQL > tempel semua isi file ini > Go
-- =====================================================
DROP DATABASE IF EXISTS fixfacility;
CREATE DATABASE fixfacility CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fixfacility;

-- 1. Pengguna (pelapor dan admin). Login memakai NIM/NIP
CREATE TABLE users (
  id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nim_nip     VARCHAR(30)  NOT NULL UNIQUE,
  name        VARCHAR(255) NOT NULL,
  email       VARCHAR(255) NULL UNIQUE,
  password    VARCHAR(255) NOT NULL,
  role        ENUM('pelapor','admin') NOT NULL DEFAULT 'pelapor',
  created_at  TIMESTAMP NULL,
  updated_at  TIMESTAMP NULL
) ENGINE=InnoDB;

-- 2. Tabel referensi (isi pilihan dropdown)
CREATE TABLE kategori (
  id    BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama  VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE fasilitas (
  id    BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama  VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE status_laporan (
  id      BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama    VARCHAR(30) NOT NULL UNIQUE,
  urutan  TINYINT UNSIGNED NOT NULL UNIQUE
) ENGINE=InnoDB;

-- 3. Laporan kerusakan
CREATE TABLE laporan (
  id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  kode          VARCHAR(20)  NOT NULL UNIQUE,          -- contoh: FF-008
  user_id       BIGINT UNSIGNED NOT NULL,              -- pelapor
  fasilitas_id  BIGINT UNSIGNED NOT NULL,
  kategori_id   BIGINT UNSIGNED NOT NULL,
  status_id     BIGINT UNSIGNED NOT NULL,
  judul         VARCHAR(150) NOT NULL,
  lokasi        VARCHAR(150) NOT NULL,
  deskripsi     TEXT NOT NULL,
  foto          VARCHAR(255) NOT NULL,                 -- path foto bukti
  created_at    TIMESTAMP NULL,
  updated_at    TIMESTAMP NULL,
  INDEX idx_laporan_created_at (created_at),
  CONSTRAINT fk_laporan_user      FOREIGN KEY (user_id)      REFERENCES users(id)          ON DELETE RESTRICT,
  CONSTRAINT fk_laporan_fasilitas FOREIGN KEY (fasilitas_id) REFERENCES fasilitas(id)      ON DELETE RESTRICT,
  CONSTRAINT fk_laporan_kategori  FOREIGN KEY (kategori_id)  REFERENCES kategori(id)       ON DELETE RESTRICT,
  CONSTRAINT fk_laporan_status    FOREIGN KEY (status_id)    REFERENCES status_laporan(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 4. Riwayat perubahan status (untuk timeline "Riwayat Perkembangan")
CREATE TABLE riwayat_status (
  id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  laporan_id   BIGINT UNSIGNED NOT NULL,
  status_id    BIGINT UNSIGNED NOT NULL,
  diubah_oleh  BIGINT UNSIGNED NULL,
  keterangan   VARCHAR(255) NULL,
  created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_riwayat_laporan FOREIGN KEY (laporan_id)  REFERENCES laporan(id)        ON DELETE CASCADE,
  CONSTRAINT fk_riwayat_status  FOREIGN KEY (status_id)   REFERENCES status_laporan(id) ON DELETE RESTRICT,
  CONSTRAINT fk_riwayat_admin   FOREIGN KEY (diubah_oleh) REFERENCES users(id)          ON DELETE SET NULL
) ENGINE=InnoDB;

-- =====================================================
-- DATA AWAL
-- =====================================================
INSERT INTO status_laporan (nama, urutan) VALUES ('Menunggu',1),('Diproses',2),('Selesai',3);
INSERT INTO kategori (nama) VALUES ('Kelistrikan'),('Peralatan kelas'),('Sanitasi'),('Bangunan');
INSERT INTO fasilitas (nama) VALUES ('Lampu'),('Kursi / meja'),('AC'),('Keran / toilet'),('Proyektor');

-- Akun contoh (sandi keduanya: 12345678)
INSERT INTO users (nim_nip, name, email, password, role, created_at, updated_at) VALUES
('admin',     'Admin FixFacility', NULL, '$2y$10$6lfwPw1Q9ufFHnIB5EXSnuS0geLBYEJYAUPfdptv6NciiQKw4osHO', 'admin',   NOW(), NOW()),
('F1G125017', 'Raihan Contoh',     NULL, '$2y$10$6lfwPw1Q9ufFHnIB5EXSnuS0geLBYEJYAUPfdptv6NciiQKw4osHO', 'pelapor', NOW(), NOW());

-- Laporan contoh (sama seperti data dummy frontend)
INSERT INTO laporan (kode,user_id,fasilitas_id,kategori_id,status_id,judul,lokasi,deskripsi,foto,created_at,updated_at) VALUES
('FF-005',2,3,2,3,'AC tidak dingin','Ruang 101','AC menyala tetapi tidak mengeluarkan udara dingin.','laporan/contoh.jpg','2026-11-05 09:30:00','2026-11-05 09:30:00'),
('FF-006',2,4,3,3,'Keran wastafel bocor','Toilet Lt. 1','Keran menetes terus dan lantai licin.','laporan/contoh.jpg','2026-11-08 09:30:00','2026-11-08 09:30:00'),
('FF-007',2,2,2,2,'Kursi ruang kelas rusak','Ruang 203','Dua kursi patah di bagian sandaran.','laporan/contoh.jpg','2026-11-10 09:30:00','2026-11-10 09:30:00'),
('FF-008',2,1,1,1,'Lampu koridor mati','Gedung A, Lantai 2','Lampu di koridor lantai 2 tidak menyala sejak pagi.','laporan/contoh.jpg','2026-11-12 09:30:00','2026-11-12 09:30:00');

INSERT INTO riwayat_status (laporan_id,status_id,diubah_oleh,keterangan,created_at) VALUES
(1,1,NULL,'Laporan dikirim','2026-11-05 09:30:00'),(1,2,1,'Sedang ditangani petugas','2026-11-06 10:00:00'),(1,3,1,'Kerusakan telah ditindaklanjuti','2026-11-07 14:00:00'),
(2,1,NULL,'Laporan dikirim','2026-11-08 09:30:00'),(2,2,1,'Sedang ditangani petugas','2026-11-09 10:00:00'),(2,3,1,'Kerusakan telah ditindaklanjuti','2026-11-09 15:00:00'),
(3,1,NULL,'Laporan dikirim','2026-11-10 09:30:00'),(3,2,1,'Sedang ditangani petugas','2026-11-11 10:00:00'),
(4,1,NULL,'Laporan dikirim','2026-11-12 09:30:00');
