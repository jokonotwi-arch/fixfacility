<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendViewsTest extends TestCase
{
    use RefreshDatabase;

    protected User $pelapor;
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);

        $this->pelapor = User::where('role', 'pelapor')->first();
        $this->admin = User::where('role', 'admin')->first();
    }

    public function test_login_page_renders_successfully()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Selamat datang');
        $response->assertSee('NIM/NIP');
        $response->assertSee('Kata sandi');
        $response->assertSee('FASILITAS KAMPUS LEBIH TERAWAT');
    }

    public function test_login_error_states_render()
    {
        $resNim = $this->from('/login')->post('/login', ['nim' => '', 'password' => '12345678']);
        $resNim->assertRedirect('/login');
        $resNim->assertSessionHasErrors('nim');

        $resPw = $this->from('/login')->post('/login', ['nim' => 'F1G125017', 'password' => '']);
        $resPw->assertRedirect('/login');
        $resPw->assertSessionHasErrors('password');
    }

    public function test_pelapor_dashboard_renders()
    {
        $response = $this->actingAs($this->pelapor)->get('/pelapor/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Pelapor');
        $response->assertSee('Selamat pagi!');
        $response->assertSee('Total Laporan');
        $response->assertSee('Laporan Terbaru');
    }

    public function test_pelapor_laporan_index_and_empty_state()
    {
        $response = $this->actingAs($this->pelapor)->get('/pelapor/laporan');
        $response->assertStatus(200);
        $response->assertSee('Daftar Laporan Saya');
        $response->assertSee('FF-008');

        $emptyUser = User::factory()->create([
            'role' => 'pelapor',
            'nim_nip' => 'F1G125999',
            'name' => 'User Kosong',
        ]);
        $emptyResponse = $this->actingAs($emptyUser)->get('/pelapor/laporan');
        $emptyResponse->assertStatus(200);
        $emptyResponse->assertSee('Belum ada laporan');
        $emptyResponse->assertSee('0 laporan');
    }

    public function test_pelapor_laporan_create_and_validation_states()
    {
        $response = $this->actingAs($this->pelapor)->get('/pelapor/laporan/buat');
        $response->assertStatus(200);
        $response->assertSee('Buat Laporan Kerusakan');
        $response->assertSee('Informasi Kerusakan');

        // Test server-side validation error redirect
        $invalidSubmit = $this->actingAs($this->pelapor)->post('/pelapor/laporan', []);
        $invalidSubmit->assertSessionHasErrors(['judul', 'fasilitas', 'lokasi', 'kategori', 'deskripsi', 'foto']);
    }

    public function test_pelapor_laporan_detail()
    {
        $response = $this->actingAs($this->pelapor)->get('/pelapor/laporan/FF-008');
        $response->assertStatus(200);
        $response->assertSee('Detail Laporan');
        $response->assertSee('Lampu koridor mati');
        $response->assertSee('Riwayat Perkembangan');
        $response->assertSee('Laporan dikirim');
    }

    public function test_admin_dashboard_renders()
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Admin');
        $response->assertSee('Ringkasan Status Laporan');
        $response->assertSee('Laporan Terbaru');
    }

    public function test_admin_laporan_index_renders()
    {
        $response = $this->actingAs($this->admin)->get('/admin/laporan');
        $response->assertStatus(200);
        $response->assertSee('Semua Laporan');
        $response->assertSee('Daftar Laporan');
        $response->assertSee('FF-008');
    }

    public function test_admin_laporan_detail_and_modal()
    {
        $response = $this->actingAs($this->admin)->get('/admin/laporan/FF-008');
        $response->assertStatus(200);
        $response->assertSee('Detail Laporan');
        $response->assertSee('Pembaruan Status');
        $response->assertSee('Simpan Perubahan');
        $response->assertSee('Hapus Laporan');
        $response->assertSee('Hapus laporan ini?');
    }

    public function test_admin_rekap_renders()
    {
        $response = $this->actingAs($this->admin)->get('/admin/rekap');
        $response->assertStatus(200);
        $response->assertSee('Rekap Laporan');
        $response->assertSee('Komposisi Status Laporan');
        $response->assertSee('Laporan per Kategori');
        $response->assertSee('Kelistrikan');
        $response->assertSee('Ringkasan periode');
    }
}
