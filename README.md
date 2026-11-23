# FixFacility - Frontend Pelaporan Kerusakan Fasilitas Kampus

Aplikasi frontend pelaporan kerusakan fasilitas kampus berbasis Laravel dan Blade. Frontend ini dibangun dengan fidelitas tinggi sesuai acuan desain (15 layar PNG di `docs/design/`) dan prototipe interaktif `docs/prototipe/FixFacility.html`.

---

## 🚀 Cara Menjalankan Aplikasi

1. Pastikan dependensi PHP dan Laravel siap.
2. Jalankan development server:
   ```sh
   php artisan serve
   ```
3. Buka browser pada alamat:
   ```
   http://127.0.0.1:8000
   ```
   Aplikasi akan otomatis mengarahkan ke halaman login (`/login`).

### Akun Contoh (Demo Data)
- **Pelapor (Mahasiswa/Warga Kampus)**:
  - NIM: `F1G125017`
  - Kata Sandi: `12345678`
  - *Catatan*: NIM alphanumeric lainnya (min. 5 karakter) dengan sandi `12345678` juga diterima.
- **Admin**:
  - NIM/Username: `admin`
  - Kata Sandi: `12345678`

---

## 📌 Daftar Halaman & Rute (Named Routes)

Semua rute didefinisikan di `routes/web.php` dan memiliki nama rute terstandar agar tim backend mudah menyambungkan.

| No | Halaman | Path URL | Nama Route | Controller / Method |
|----|---------|----------|------------|---------------------|
| 1 | Login | `/login` | `login` | `AuthController@showLoginForm` |
| - | Proses Login | `/login` (POST) | `login.post` | `AuthController@login` |
| - | Keluar (Logout) | `/logout` (GET/POST) | `logout` | `AuthController@logout` |
| 2 | Dashboard Pelapor | `/pelapor/dashboard` | `pelapor.dashboard` | `PelaporController@dashboard` |
| 3 | Buat Laporan | `/pelapor/laporan/buat` | `pelapor.laporan.create` | `PelaporController@create` |
| - | Simpan Laporan | `/pelapor/laporan` (POST) | `pelapor.laporan.store` | `PelaporController@store` |
| 4 | Daftar Laporan Pelapor | `/pelapor/laporan` | `pelapor.laporan.index` | `PelaporController@index` |
| 5 | Detail Laporan Pelapor | `/pelapor/laporan/{kode}` | `pelapor.laporan.show` | `PelaporController@show` |
| 6 | Dashboard Admin | `/admin/dashboard` | `admin.dashboard` | `AdminController@dashboard` |
| 7 | Semua Laporan Admin | `/admin/laporan` | `admin.laporan.index` | `AdminController@laporanIndex` |
| 8 | Detail & Update Status Admin | `/admin/laporan/{kode}` | `admin.laporan.show` | `AdminController@laporanShow` |
| - | Update Status Laporan | `/admin/laporan/{kode}/status` (POST) | `admin.laporan.update` | `AdminController@laporanUpdate` |
| - | Hapus Laporan | `/admin/laporan/{kode}` (DELETE) | `admin.laporan.destroy` | `AdminController@laporanDestroy` |
| 9 | Rekap Laporan | `/admin/rekap` | `admin.rekap` | `AdminController@rekap` |

---

## 🧪 Pengujian State Visual (15 Layar Desain)

Setiap variasi state visual dari file desain di `docs/design/` dapat dilihat dan diuji langsung:

1. **Login - Normal**:  
   `GET /login`
2. **Login - NIM/NIP Salah atau Kosong** (`01 Login-Salah Email (2).png`):  
   `GET /login?state=nim_error`
3. **Login - Sandi Salah** (`01 Login - Password Salah (2).png`):  
   `GET /login?state=password_error`
4. **Dashboard Pelapor** (`02 Dashboard Pelapor (2).png`):  
   `GET /pelapor/dashboard`
5. **Formulir Buat Laporan - Normal** (`03 Formulir Buat Laporan (2).png`):  
   `GET /pelapor/laporan/buat`
6. **Formulir Buat Laporan - Data Belum Lengkap** (`03 Formulir Buat Laporan - Data Belum Lengkap (2).png`):  
   `GET /pelapor/laporan/buat?state=incomplete` (atau klik tombol Kirim saat form kosong)
7. **Formulir Buat Laporan - Pesan Foto Tidak Valid** (`03 Formulir Buat Laporan - Pesan Foto Tidak Valid (2).png`):  
   `GET /pelapor/laporan/buat?state=invalid_photo` (atau upload file bukan JPG/PNG / > 5MB)
8. **Daftar Laporan Pelapor - Berisi** (`04 Daftar Laporan Pelapor (2).png`):  
   `GET /pelapor/laporan`
9. **Daftar Laporan Pelapor - Belum Ada Laporan** (`04 Daftar Laporan Pelapor - Belum ada laporan (2).png`):  
   `GET /pelapor/laporan?empty=1`
10. **Detail Laporan Pelapor** (`05 Detail Laporan Pelapor (2).png`):  
    `GET /pelapor/laporan/FF-008`
11. **Dashboard Admin** (`06 Dashboard Admin (2).png`):  
    `GET /admin/dashboard`
12. **Semua Laporan Admin** (`07 Semua Laporan Admin (2).png`):  
    `GET /admin/laporan` (tersedia pencarian, filter status, filter kategori dinamis)
13. **Detail & Update Status Admin** (`08 Detail dan Update Status Admin (2).png`):  
    `GET /admin/laporan/FF-008` (pilih status via select atau chips)
14. **Detail Admin - Modal Konfirmasi Hapus** (`08 Detail dan Update Status Admin - Konfirmasi Hapus (2).png`):  
    `GET /admin/laporan/FF-008?state=modal_hapus` (atau klik tombol "Hapus Laporan")
15. **Rekap Laporan** (`09 Rekap Laporan (2).png`):  
    `GET /admin/rekap`

---

## 🧩 Komponen Blade (`resources/views/components/`)

Komponen yang berulang telah diekstrak ke Blade components agar modular dan tidak terjadi duplikasi:

1. `<x-status-badge :status="$status" />`:  
   Menampilkan label status dengan warna khusus:
   - `Menunggu` (kuning muda)
   - `Diproses` (biru muda)
   - `Selesai` (hijau muda)
2. `<x-stat-card :label="$label" :value="$value" :subtext="$subtext" />`:  
   Menampilkan kartu metrik statistik 4 kolom.
3. `<x-sidebar-item :route="$routeName" :active="$isActive">Label</x-sidebar-item>`:  
   Menampilkan item navigasi sidebar dengan state aktif.
4. `<x-progress-bar :label="$label" :value="$value" :max="$max" :color="$color" />`:  
   Menampilkan bilah progres/chart batang horizontal CSS.
5. `<x-empty-state :title="$title" :message="$msg" :actionText="$text" :actionUrl="$url" />`:  
   Menampilkan kartu state kosong dengan ilustrasi dokumen dan tombol aksi.
6. `<x-modal-konfirmasi :id="$id" :title="$title" :desc="$desc" :action="$actionUrl" />`:  
   Modal popup konfirmasi penghapusan dengan backdrop dan form `@csrf` + `@method('DELETE')`.

---

## 🔌 Panduan Titik Sambung untuk Tim Backend

Untuk menyambungkan logika backend dan database sesungguhnya:

1. **Sumber Data Dummy (`app/Support/DummyData.php`)**:
   - Seluruh data laporan, statistik, kategori, dan rekap berada di `app/Support/DummyData.php`.
   - Ganti pemanggilan method statis di `PelaporController` dan `AdminController` dengan query model Eloquent (misal `Laporan::query()`, `Laporan::where(...)`).

2. **Autentikasi (`app/Http/Controllers/AuthController.php`)**:
   - Hubungkan method `login()` dengan `Auth::attempt(['nim_nip' => $request->nim, 'password' => $request->password])`.
   - Sesuaikan pengalihan berdasarkan role pengguna (`Auth::user()->role === 'admin'`).

3. **Form Buat Laporan (`pelapor/laporan/create.blade.php`)**:
   - Atribut input `name` sudah disesuaikan:
     - `judul` (string)
     - `fasilitas` (string)
     - `lokasi` (string)
     - `kategori` (string)
     - `deskripsi` (text)
     - `foto` (file image, JPG/PNG, max 5MB)
   - Tangani penyimpanan file foto bukti kerusakan pada `PelaporController@store` (`$request->file('foto')->store(...)`).

4. **Pembaruan Status Laporan (`admin/laporan/show.blade.php`)**:
   - Form mengarah ke `route('admin.laporan.update', $kode)` dengan input `name="status"`.
   - Update field `status` pada model terkait di `AdminController@laporanUpdate`.

5. **Penghapusan Laporan (`admin/laporan/show.blade.php`)**:
   - Form modal konfirmasi mengirim request `DELETE` ke `route('admin.laporan.destroy', $kode)`.
   - Jalankan `Laporan::where('kode', $kode)->delete()` pada `AdminController@laporanDestroy`.

6. **Filter & Rekap (`admin/laporan/index.blade.php` & `admin/rekap.blade.php`)**:
   - Query parameters `q`, `status`, dan `kategori` sudah ditangkap di `AdminController@laporanIndex`.
   - Data rekap periode dapat dihubungkan dengan agregasi data SQL/Eloquent (misal `COUNT(*)` per status dan kategori).
