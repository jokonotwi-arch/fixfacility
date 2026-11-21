<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $nim = trim($request->input('nim', ''));
        $password = $request->input('password', '');

        // Validation for dummy check
        if (empty($nim)) {
            return redirect()->route('login', ['state' => 'nim_error'])
                ->withErrors(['nim' => 'NIM/NIP salah atau kosong!'])
                ->withInput();
        }

        if ($password !== '12345678') {
            return redirect()->route('login', ['state' => 'password_error'])
                ->withErrors(['password' => 'Kata sandi salah.'])
                ->withInput();
        }

        if (strtolower($nim) === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('pelapor.dashboard');
    }

    public function logout()
    {
        return redirect()->route('login');
    }
}
