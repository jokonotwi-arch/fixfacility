@extends('layouts.auth')

@section('content')
<form id="form-login" method="POST" action="{{ route('login') }}">
    @csrf
    <h1 style="font-size: 28px; margin-bottom: 6px;">Selamat datang</h1>
    <p class="lead" style="margin-bottom: 28px;">Masuk menggunakan akun kampus yang telah terdaftar.</p>

    <div class="g {{ $errors->has('nim') ? 'err' : '' }}" id="g-nim" style="margin-bottom: 20px;">
        <label for="nim">NIM/NIP</label>
        <input 
            type="text" 
            id="nim" 
            name="nim" 
            placeholder="NIM/NIP"
            value="{{ old('nim') }}"
            autocomplete="username"
        >
        <div class="em" id="e1">{{ $errors->first('nim') }}</div>
    </div>

    <div class="g {{ $errors->has('password') ? 'err' : '' }}" id="g-password" style="margin-bottom: 28px;">
        <label for="password">Kata sandi</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Kata sandi"
            autocomplete="current-password"
        >
        <div class="em" id="e2">{{ $errors->first('password') }}</div>
    </div>

    <button type="submit" class="btn w">Masuk</button>
</form>
@endsection
