@extends('layouts.pelapor')

@section('content')
<div class="top">
    <div>
        <h1>Buat Laporan Kerusakan</h1>
        <p class="lead">Isi informasi kerusakan fasilitas secara lengkap dan sertakan foto bukti.</p>
    </div>
</div>

@php
    $state = request('state');
    $isIncomplete = $state === 'incomplete' || $errors->any();
    $isInvalidPhoto = $state === 'invalid_photo';
@endphp

<div class="card">
    <div class="alert {{ $isIncomplete ? 'show' : '' }}" id="alert-error-form">
        <b>Periksa kembali data laporan</b>
        Masih ada kolom wajib yang belum diisi.
    </div>

    <h2 style="margin-bottom: 20px;">Informasi Kerusakan</h2>

    <form id="form-buat-laporan" method="POST" action="{{ route('pelapor.laporan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="fl">
            <div class="g {{ $isIncomplete ? 'err' : '' }}">
                <label for="judul">Judul laporan *</label>
                <input 
                    type="text" 
                    id="judul" 
                    name="judul" 
                    placeholder="{{ $isIncomplete ? 'Wajib diisi' : 'Apa yang ingin dilaporkan' }}"
                    value="{{ old('judul') }}"
                >
                <div class="em">Wajib diisi</div>
            </div>

            <div class="g {{ $isIncomplete ? 'err' : '' }}">
                <label for="fasilitas">Fasilitas *</label>
                <select id="fasilitas" name="fasilitas">
                    <option value="">{{ $isIncomplete ? 'Wajib diisi' : 'Pilih fasilitas' }}</option>
                    @foreach($formOptions['fasilitas'] as $opt)
                        <option value="{{ $opt }}" {{ old('fasilitas') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
                <div class="em">Wajib diisi</div>
            </div>

            <div class="g {{ $isIncomplete ? 'err' : '' }}">
                <label for="lokasi">Lokasi *</label>
                <input 
                    type="text" 
                    id="lokasi" 
                    name="lokasi" 
                    placeholder="{{ $isIncomplete ? 'Wajib diisi' : 'Tempat ditemukannya kerusakan' }}"
                    value="{{ old('lokasi') }}"
                >
                <div class="em">Wajib diisi</div>
            </div>

            <div class="g {{ $isIncomplete ? 'err' : '' }}">
                <label for="kategori">Kategori kerusakan *</label>
                <select id="kategori" name="kategori">
                    <option value="">{{ $isIncomplete ? 'Wajib diisi' : 'Pilih kategori' }}</option>
                    @foreach($formOptions['kategori'] as $opt)
                        <option value="{{ $opt }}" {{ old('kategori') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
                <div class="em">Wajib diisi</div>
            </div>

            <div class="g full {{ $isIncomplete ? 'err' : '' }}">
                <label for="deskripsi">Deskripsi kerusakan *</label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    placeholder="Jelaskan kondisi kerusakan dan kapan ditemukan."
                >{{ old('deskripsi') }}</textarea>
                <div class="em">Wajib diisi</div>
            </div>

            <div class="g full {{ ($isIncomplete || $isInvalidPhoto) ? 'err' : '' }}" id="group-foto">
                <label>Foto Bukti Kerusakan *</label>
                <div class="drop {{ ($isIncomplete || $isInvalidPhoto) ? 'is-invalid' : '' }}" id="drop-foto">
                    @if($isInvalidPhoto)
                        <b id="drop-title">+ Klik untuk memilih foto atau seret file ke sini</b>
                        <small id="drop-subtitle">Format JPG atau PNG • Maksimal 5 MB</small>
                    @elseif($isIncomplete)
                        <b id="drop-title" style="color: var(--rd);">Belum ada foto yang diunggah</b>
                        <small id="drop-subtitle">Format JPG, PNG • Maksimal 5 MB • Minimal 1 foto</small>
                    @else
                        <b id="drop-title">+ Klik untuk memilih foto atau seret file ke sini</b>
                        <small id="drop-subtitle">Format JPG, PNG • Maksimal 5 MB • Minimal 1 foto</small>
                    @endif
                </div>
                <input type="file" id="input-foto" name="foto" accept="image/jpeg,image/png" hidden>
                <div class="em">Wajib diisi</div>
            </div>
        </div>

        <div style="text-align: right; margin-top: 24px;">
            <button type="submit" class="btn">Kirim Laporan</button>
        </div>
    </form>
</div>

<div style="color: var(--mu); font-size: 12px; margin-top: 8px;">
    Test state visual: 
    <a href="{{ route('pelapor.laporan.create', ['state' => 'incomplete']) }}">Data Belum Lengkap</a> • 
    <a href="{{ route('pelapor.laporan.create', ['state' => 'invalid_photo']) }}">Foto Tidak Valid</a> • 
    <a href="{{ route('pelapor.laporan.create') }}">Normal</a>
</div>
@endsection
