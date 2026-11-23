@extends('layouts.pelapor')

@section('content')
<div class="top">
    <div>
        <h1>Buat Laporan Kerusakan</h1>
        <p class="lead">Isi informasi kerusakan fasilitas secara lengkap dan sertakan foto bukti.</p>
    </div>
</div>

@php
    $isIncomplete = $errors->any();
    $hasJudulErr = $errors->has('judul');
    $hasFasilitasErr = $errors->has('fasilitas');
    $hasLokasiErr = $errors->has('lokasi');
    $hasKategoriErr = $errors->has('kategori');
    $hasDeskripsiErr = $errors->has('deskripsi');
    $hasFotoErr = $errors->has('foto');
@endphp

<div class="card">
    <div class="alert {{ $isIncomplete ? 'show' : '' }}" id="alert-error-form">
        <b>Periksa kembali data laporan</b>
        Masih ada kolom wajib yang belum diisi atau tidak sesuai.
    </div>

    <h2 style="margin-bottom: 20px;">Informasi Kerusakan</h2>

    <form id="form-buat-laporan" method="POST" action="{{ route('pelapor.laporan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="fl">
            <div class="g {{ $hasJudulErr ? 'err' : '' }}">
                <label for="judul">Judul laporan *</label>
                <input 
                    type="text" 
                    id="judul" 
                    name="judul" 
                    placeholder="{{ $hasJudulErr ? ($errors->first('judul') ?: 'Wajib diisi') : 'Apa yang ingin dilaporkan' }}"
                    value="{{ old('judul') }}"
                >
                <div class="em">{{ $errors->first('judul') ?: 'Wajib diisi' }}</div>
            </div>

            <div class="g {{ $hasFasilitasErr ? 'err' : '' }}">
                <label for="fasilitas">Fasilitas *</label>
                <select id="fasilitas" name="fasilitas" class="select">
                    <option value="">{{ $hasFasilitasErr ? ($errors->first('fasilitas') ?: 'Wajib diisi') : 'Pilih fasilitas' }}</option>
                    @foreach($formOptions['fasilitas'] as $opt)
                        <option value="{{ $opt }}" {{ old('fasilitas') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
                <div class="em">{{ $errors->first('fasilitas') ?: 'Wajib diisi' }}</div>
            </div>

            <div class="g {{ $hasLokasiErr ? 'err' : '' }}">
                <label for="lokasi">Lokasi *</label>
                <input 
                    type="text" 
                    id="lokasi" 
                    name="lokasi" 
                    placeholder="{{ $hasLokasiErr ? ($errors->first('lokasi') ?: 'Wajib diisi') : 'Tempat ditemukannya kerusakan' }}"
                    value="{{ old('lokasi') }}"
                >
                <div class="em">{{ $errors->first('lokasi') ?: 'Wajib diisi' }}</div>
            </div>

            <div class="g {{ $hasKategoriErr ? 'err' : '' }}">
                <label for="kategori">Kategori kerusakan *</label>
                <select id="kategori" name="kategori" class="select">
                    <option value="">{{ $hasKategoriErr ? ($errors->first('kategori') ?: 'Wajib diisi') : 'Pilih kategori' }}</option>
                    @foreach($formOptions['kategori'] as $opt)
                        <option value="{{ $opt }}" {{ old('kategori') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
                <div class="em">{{ $errors->first('kategori') ?: 'Wajib diisi' }}</div>
            </div>

            <div class="g full {{ $hasDeskripsiErr ? 'err' : '' }}">
                <label for="deskripsi">Deskripsi kerusakan *</label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    placeholder="Jelaskan kondisi kerusakan dan kapan ditemukan."
                >{{ old('deskripsi') }}</textarea>
                <div class="em">{{ $errors->first('deskripsi') ?: 'Wajib diisi' }}</div>
            </div>

            <div class="g full {{ $hasFotoErr ? 'err' : '' }}" id="group-foto">
                <label>Foto Bukti Kerusakan *</label>
                
                {{-- Area Drop Zone --}}
                <div class="drop {{ $hasFotoErr ? 'is-invalid' : '' }}" id="drop-foto">
                    <b id="drop-title">+ Klik untuk memilih foto atau seret file ke sini</b>
                    <small id="drop-subtitle">Format JPG, JPEG, PNG, WEBP • Maksimal 5 MB • Minimal 1 foto</small>
                </div>

                {{-- Area Pratinjau Foto (muncul saat foto dipilih) --}}
                <div id="foto-preview-wrapper" class="upload-preview-wrapper" style="display: none;">
                    <div class="upload-preview-card">
                        <img id="foto-preview-img" src="" alt="Pratinjau Foto" class="upload-preview-thumb">
                        <div class="upload-preview-meta">
                            <div class="upload-preview-info">
                                <span id="foto-preview-name" class="upload-preview-filename">-</span>
                                <span id="foto-preview-size" class="upload-preview-filesize">-</span>
                            </div>
                            <div class="upload-preview-actions">
                                <button type="button" id="btn-ganti-foto" class="btn btn-sm btn-outline">Ganti foto</button>
                                <button type="button" id="btn-hapus-foto" class="btn btn-sm btn-danger-outline">Hapus foto</button>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="file" id="input-foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp" hidden>
                <div class="em" id="foto-error-msg">{{ $errors->first('foto') ?: 'Wajib diisi' }}</div>

                @if($errors->any())
                    <small style="display: block; margin-top: 6px; color: var(--mu);">
                        Pilih ulang foto Anda jika sebelumnya sudah dipilih.
                    </small>
                @endif
            </div>
        </div>

        <div style="text-align: right; margin-top: 24px;">
            <button type="submit" class="btn">Kirim Laporan</button>
        </div>
    </form>
</div>
@endsection
