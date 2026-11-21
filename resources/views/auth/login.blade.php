@extends('layouts.auth')

@section('content')
<form id="form-login" method="POST" action="{{ route('login') }}">
    @csrf
    <h1 style="font-size: 28px; margin-bottom: 6px;">Selamat datang</h1>
    <p class="lead" style="margin-bottom: 28px;">Masuk menggunakan akun kampus yang telah terdaftar.</p>

    @php
        $errorState = request('error') ?? request('state');
        $hasNimError = $errors->has('nim') || $errorState === 'nim' || $errorState === 'nim_error';
        $hasPasswordError = $errors->has('password') || $errorState === 'password' || $errorState === 'password_error';
    @endphp

    <div class="g {{ $hasNimError ? 'err' : '' }}" id="g-nim" style="margin-bottom: 20px;">
        <label for="nim">NIM/NIP</label>
        <input 
            type="text" 
            id="nim" 
            name="nim" 
            placeholder="{{ $hasNimError ? 'NIM/NIP salah atau kosong!' : 'NIM/NIP' }}"
            value="{{ $hasNimError ? '' : old('nim', request('nim')) }}"
            autocomplete="username"
        >
        <div class="em" id="e1">NIM/NIP salah atau kosong!</div>
    </div>

    <div class="g {{ $hasPasswordError ? 'err' : '' }}" id="g-password" style="margin-bottom: 28px;">
        <label for="password">Kata sandi</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Kata sandi"
            autocomplete="current-password"
            value="{{ $hasPasswordError ? '12345678' : '' }}"
        >
        <div class="em" id="e2">Kata sandi salah.</div>
    </div>

    <button type="submit" class="btn w">Masuk</button>

    <div style="color: var(--mu); font-size: 12px; margin-top: 20px; line-height: 1.6;">
        Data contoh: NIM <b>F1G125017</b> atau <b>admin</b>, sandi <b>12345678</b>.<br>
        <span style="opacity: 0.85;">Test state visual: 
            <a href="{{ route('login', ['state' => 'nim_error']) }}">NIM Salah</a> • 
            <a href="{{ route('login', ['state' => 'password_error']) }}">Sandi Salah</a> • 
            <a href="{{ route('login') }}">Normal</a>
        </span>
    </div>
</form>
@endsection
