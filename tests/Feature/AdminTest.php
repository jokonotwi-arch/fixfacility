<?php

namespace Tests\Feature;

use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\StatusLaporan;
use App\Models\User;
use Database\Seeders\ReferensiSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $pelapor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ReferensiSeeder::class);

        $this->admin = User::create([
            'nim_nip' => 'admin',
            'name' => 'Admin FixFacility',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $this->pelapor = User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Pelapor',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);
    }

    public function test_admin_dashboard_renders_stats_and_breakdown(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        Laporan::create([
            'kode' => 'FF-001',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Lampu Koridor Rusak',
            'lokasi' => 'Lantai 2',
            'deskripsi' => 'Padam',
            'foto' => 'laporan/contoh.jpg',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard Admin');
        $response->assertSee('Total Laporan');
        $response->assertSee('Ringkasan Status Laporan');
    }

    public function test_admin_can_view_all_reports(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        Laporan::create([
            'kode' => 'FF-001',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Kerusakan Satu',
            'lokasi' => 'Ruang 1',
            'deskripsi' => 'Desc 1',
            'foto' => 'laporan/contoh.jpg',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.laporan.index'));

        $response->assertStatus(200);
        $response->assertSee('Semua Laporan');
        $response->assertSee('Kerusakan Satu');
        $response->assertSee('FF-001');
    }

    public function test_admin_can_search_and_filter_reports(): void
    {
        $fasilitasLampu = Fasilitas::where('nama', 'Lampu')->first();
        $fasilitasAC = Fasilitas::where('nama', 'AC')->first();
        $kategoriListrik = Kategori::where('nama', 'Kelistrikan')->first();
        $kategoriKelas = Kategori::where('nama', 'Peralatan kelas')->first();
        $statusMenunggu = StatusLaporan::where('nama', 'Menunggu')->first();
        $statusSelesai = StatusLaporan::where('nama', 'Selesai')->first();

        Laporan::create([
            'kode' => 'FF-001',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitasLampu->id,
            'kategori_id' => $kategoriListrik->id,
            'status_id' => $statusMenunggu->id,
            'judul' => 'Lampu Koridor Padam',
            'lokasi' => 'Gedung A',
            'deskripsi' => 'Gelap gulita',
            'foto' => 'laporan/contoh.jpg',
        ]);

        Laporan::create([
            'kode' => 'FF-002',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitasAC->id,
            'kategori_id' => $kategoriKelas->id,
            'status_id' => $statusSelesai->id,
            'judul' => 'AC Ruang 101 Panas',
            'lokasi' => 'Ruang 101',
            'deskripsi' => 'Freon habis',
            'foto' => 'laporan/contoh.jpg',
        ]);

        // Search by query
        $resQuery = $this->actingAs($this->admin)->get(route('admin.laporan.index', ['q' => 'Koridor']));
        $resQuery->assertStatus(200);
        $resQuery->assertSee('Lampu Koridor Padam');
        $resQuery->assertDontSee('AC Ruang 101 Panas');

        // Filter by status & category
        $resFilter = $this->actingAs($this->admin)->get(route('admin.laporan.index', [
            'status' => 'Selesai',
            'kategori' => 'Peralatan kelas',
        ]));
        $resFilter->assertStatus(200);
        $resFilter->assertSee('AC Ruang 101 Panas');
        $resFilter->assertDontSee('Lampu Koridor Padam');

        // No match
        $resNone = $this->actingAs($this->admin)->get(route('admin.laporan.index', ['q' => 'TidakAdaDiManaMana']));
        $resNone->assertStatus(200);
        $resNone->assertSee('Tidak ada laporan yang cocok.');
    }

    public function test_admin_can_view_report_detail(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        Laporan::create([
            'kode' => 'FF-008',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Lampu koridor mati',
            'lokasi' => 'Gedung A, Lantai 2',
            'deskripsi' => 'Lampu tidak menyala',
            'foto' => 'laporan/contoh.jpg',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.laporan.show', 'FF-008'));

        $response->assertStatus(200);
        $response->assertSee('Detail Laporan');
        $response->assertSee('Pembaruan Status');
        $response->assertSee('Hapus Laporan');
    }

    public function test_admin_can_update_report_status_and_riwayat_is_recorded(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        $laporan = Laporan::create([
            'kode' => 'FF-008',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Lampu koridor mati',
            'lokasi' => 'Gedung A, Lantai 2',
            'deskripsi' => 'Lampu tidak menyala',
            'foto' => 'laporan/contoh.jpg',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.laporan.update', 'FF-008'), [
            'status' => 'Diproses',
        ]);

        $response->assertRedirect(route('admin.laporan.show', 'FF-008'));
        $response->assertSessionHas('success', 'Status laporan berhasil diperbarui!');

        $laporan->refresh();
        $this->assertEquals('Diproses', $laporan->status->nama);

        $this->assertDatabaseHas('riwayat_status', [
            'laporan_id' => $laporan->id,
            'diubah_oleh' => $this->admin->id,
            'keterangan' => 'Sedang ditangani petugas',
        ]);
    }

    public function test_admin_status_update_fails_with_invalid_value(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        Laporan::create([
            'kode' => 'FF-008',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Lampu koridor mati',
            'lokasi' => 'Gedung A, Lantai 2',
            'deskripsi' => 'Lampu tidak menyala',
            'foto' => 'laporan/contoh.jpg',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.laporan.update', 'FF-008'), [
            'status' => 'StatusPalsu',
        ]);

        $response->assertSessionHasErrors(['status']);
    }

    public function test_admin_can_delete_report_and_associated_photo_is_deleted(): void
    {
        Storage::fake('public');

        $filePath = Storage::disk('public')->putFile('laporan', UploadedFile::fake()->create('foto.jpg', 500, 'image/jpeg'));

        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        $laporan = Laporan::create([
            'kode' => 'FF-008',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Lampu koridor mati',
            'lokasi' => 'Gedung A, Lantai 2',
            'deskripsi' => 'Lampu tidak menyala',
            'foto' => $filePath,
        ]);

        Storage::disk('public')->assertExists($filePath);

        $response = $this->actingAs($this->admin)->delete(route('admin.laporan.destroy', 'FF-008'));

        $response->assertRedirect(route('admin.laporan.index'));
        $response->assertSessionHas('success', 'Laporan FF-008 berhasil dihapus!');

        $this->assertDatabaseMissing('laporan', ['id' => $laporan->id]);
        Storage::disk('public')->assertMissing($filePath);
    }

    public function test_admin_rekap_page_renders_successfully(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.rekap'));

        $response->assertStatus(200);
        $response->assertSee('Rekap Laporan');
        $response->assertSee('Komposisi Status Laporan');
        $response->assertSee('Laporan per Kategori');
    }
}
