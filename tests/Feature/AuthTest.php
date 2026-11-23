<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\ReferensiSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ReferensiSeeder::class);
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Selamat datang');
        $response->assertSee('NIM/NIP');
    }

    public function test_login_requires_nim_and_password(): void
    {
        $response = $this->post('/login', [
            'nim' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors([
            'nim' => 'NIM/NIP wajib diisi.',
            'password' => 'Kata sandi wajib diisi.',
        ]);
        $this->assertGuest();
    }

    public function test_login_fails_with_unregistered_nim(): void
    {
        $response = $this->post('/login', [
            'nim' => 'TIDAKADA',
            'password' => '12345678',
        ]);

        $response->assertSessionHasErrors([
            'nim' => 'NIM/NIP salah atau tidak terdaftar.',
        ]);
        $this->assertGuest();
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Contoh',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);

        $response = $this->post('/login', [
            'nim' => 'F1G125017',
            'password' => 'salah123',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'Kata sandi salah.',
        ]);
        $this->assertGuest();
    }

    public function test_pelapor_can_login_and_redirects_to_pelapor_dashboard(): void
    {
        $user = User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Contoh',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);

        $response = $this->post('/login', [
            'nim' => 'F1G125017',
            'password' => '12345678',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('pelapor.dashboard'));
    }

    public function test_admin_can_login_and_redirects_to_admin_dashboard(): void
    {
        $admin = User::create([
            'nim_nip' => 'admin',
            'name' => 'Admin FixFacility',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'nim' => 'admin',
            'password' => '12345678',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_guest_cannot_access_protected_pages(): void
    {
        $resPelapor = $this->get('/pelapor/dashboard');
        $resPelapor->assertRedirect(route('login'));

        $resAdmin = $this->get('/admin/dashboard');
        $resAdmin->assertRedirect(route('login'));
    }

    public function test_pelapor_cannot_access_admin_pages(): void
    {
        $pelapor = User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Pelapor',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);

        $response = $this->actingAs($pelapor)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_pelapor_pages(): void
    {
        $admin = User::create([
            'nim_nip' => 'admin',
            'name' => 'Admin FixFacility',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/pelapor/dashboard');
        $response->assertStatus(403);
    }

    public function test_user_can_logout_via_post_request(): void
    {
        $user = User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Contoh',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    public function test_logout_via_get_is_not_allowed(): void
    {
        $user = User::create([
            'nim_nip' => 'F1G125017',
            'name' => 'Raihan Contoh',
            'password' => Hash::make('12345678'),
            'role' => 'pelapor',
        ]);

        $response = $this->actingAs($user)->get('/logout');
        $response->assertStatus(405);
    }
}
