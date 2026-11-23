<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('pelapor.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'nim.required' => 'NIM/NIP wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $nim = trim($validated['nim']);
        $password = $validated['password'];

        $user = User::where('nim_nip', $nim)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'nim' => 'NIM/NIP salah atau tidak terdaftar.',
            ]);
        }

        if (! Auth::attempt(['nim_nip' => $nim, 'password' => $password], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'password' => 'Kata sandi salah.',
            ]);
        }

        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('pelapor.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
