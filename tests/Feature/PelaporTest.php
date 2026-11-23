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

class PelaporTest extends TestCase
{
    use RefreshDatabase;

    protected User $pelapor;
    protected User $otherPelapor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ReferensiSeeder::class);

        $this->pelapor = User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Pelapor',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);

        $this->otherPelapor = User::create([
            'nim_nip' => 'F1G125099',
            'name' => 'Budi Lainnya',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);
    }

    public function test_pelapor_dashboard_displays_stats_and_latest_reports(): void
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
            'deskripsi' => 'Lampu padam',
            'foto' => 'laporan/dummy.jpg',
        ]);

        $response = $this->actingAs($this->pelapor)->get(route('pelapor.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard Pelapor');
        $response->assertSee('Lampu Koridor Rusak');
        $response->assertSee('FF-001');
    }

    public function test_pelapor_index_shows_own_reports_only(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        Laporan::create([
            'kode' => 'FF-010',
            'user_id' => $this->pelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Laporan Milik Sendiri',
            'lokasi' => 'Gedung A',
            'deskripsi' => 'Deskripsi',
            'foto' => 'laporan/dummy.jpg',
        ]);

        Laporan::create([
            'kode' => 'FF-011',
            'user_id' => $this->otherPelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Laporan Rahasia Pelapor Lain',
            'lokasi' => 'Gedung B',
            'deskripsi' => 'Deskripsi',
            'foto' => 'laporan/dummy.jpg',
        ]);

        $response = $this->actingAs($this->pelapor)->get(route('pelapor.laporan.index'));

        $response->assertStatus(200);
        $response->assertSee('Laporan Milik Sendiri');
        $response->assertDontSee('Laporan Rahasia Pelapor Lain');
    }

    public function test_pelapor_create_page_renders_form_options(): void
    {
        $response = $this->actingAs($this->pelapor)->get(route('pelapor.laporan.create'));

        $response->assertStatus(200);
        $response->assertSee('Buat Laporan Kerusakan');
        $response->assertSee('Kelistrikan');
        $response->assertSee('Lampu');
    }

    public function test_pelapor_can_create_laporan_with_valid_data(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('kerusakan.jpg', 1024, 'image/jpeg');

        $response = $this->actingAs($this->pelapor)->post(route('pelapor.laporan.store'), [
            'judul' => 'AC Bocor Menetes',
            'fasilitas' => 'AC',
            'lokasi' => 'Ruang 301',
            'kategori' => 'Peralatan kelas',
            'deskripsi' => 'AC meneteskan air ke lantai.',
            'foto' => $file,
        ]);

        $response->assertRedirect(route('pelapor.laporan.index'));
        $response->assertSessionHas('success', 'Laporan berhasil dikirim!');

        $laporan = Laporan::where('judul', 'AC Bocor Menetes')->first();
        $this->assertNotNull($laporan);
        $this->assertEquals($this->pelapor->id, $laporan->user_id);
        $this->assertMatchesRegularExpression('/^FF-\d{3}$/', $laporan->kode);

        Storage::disk('public')->assertExists($laporan->foto);

        $this->assertDatabaseHas('riwayat_status', [
            'laporan_id' => $laporan->id,
            'keterangan' => 'Laporan dikirim',
        ]);
    }

    public function test_pelapor_cannot_create_laporan_with_empty_fields(): void
    {
        $response = $this->actingAs($this->pelapor)->post(route('pelapor.laporan.store'), [
            'judul' => '',
            'fasilitas' => '',
            'lokasi' => '',
            'kategori' => '',
            'deskripsi' => '',
        ]);

        $response->assertSessionHasErrors([
            'judul' => 'Judul laporan wajib diisi.',
            'fasilitas' => 'Fasilitas wajib dipilih.',
            'lokasi' => 'Lokasi wajib diisi.',
            'kategori' => 'Kategori kerusakan wajib dipilih.',
            'deskripsi' => 'Deskripsi kerusakan wajib diisi.',
            'foto' => 'Foto bukti kerusakan wajib diunggah.',
        ]);
    }

    public function test_pelapor_cannot_create_laporan_with_invalid_file_type(): void
    {
        $file = UploadedFile::fake()->create('dokumen.pdf', 500);

        $response = $this->actingAs($this->pelapor)->post(route('pelapor.laporan.store'), [
            'judul' => 'AC Rusak',
            'fasilitas' => 'AC',
            'lokasi' => 'Ruang 101',
            'kategori' => 'Peralatan kelas',
            'deskripsi' => 'AC tidak dingin.',
            'foto' => $file,
        ]);

        $response->assertSessionHasErrors(['foto']);
    }

    public function test_pelapor_can_view_own_laporan_detail(): void
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
            'deskripsi' => 'Lampu padam sejak pagi',
            'foto' => 'laporan/dummy.jpg',
        ]);

        $response = $this->actingAs($this->pelapor)->get(route('pelapor.laporan.show', 'FF-008'));

        $response->assertStatus(200);
        $response->assertSee('Detail Laporan');
        $response->assertSee('Lampu koridor mati');
        $response->assertSee('Kembali');
    }

    public function test_pelapor_cannot_view_other_users_laporan_detail(): void
    {
        $fasilitas = Fasilitas::first();
        $kategori = Kategori::first();
        $status = StatusLaporan::where('nama', 'Menunggu')->first();

        Laporan::create([
            'kode' => 'FF-099',
            'user_id' => $this->otherPelapor->id,
            'fasilitas_id' => $fasilitas->id,
            'kategori_id' => $kategori->id,
            'status_id' => $status->id,
            'judul' => 'Laporan Milik Budi',
            'lokasi' => 'Ruang Dosen',
            'deskripsi' => 'Hanya untuk Budi',
            'foto' => 'laporan/dummy.jpg',
        ]);

        $response = $this->actingAs($this->pelapor)->get(route('pelapor.laporan.show', 'FF-099'));

        $response->assertStatus(403);
    }
}
