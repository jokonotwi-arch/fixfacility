@extends('layouts.pelapor')

@section('content')
<div class="top">
    <div>
        <h1>Detail Laporan</h1>
        <p class="lead">Informasi lengkap dan perkembangan laporan kerusakan kamu.</p>
    </div>
    <div>
        <a href="{{ route('pelapor.laporan.index') }}" class="btn" style="background: var(--ln); color: var(--tx);">← Kembali</a>
    </div>
</div>

<div class="two">
    <div class="card">
        <span class="muted">{{ $laporan['kode'] }} • Dikirim {{ $laporan['tanggal_lengkap'] ?? $laporan['tanggal'] }}</span>
        <h1 style="margin: 8px 0 12px; font-size: 24px;">{{ $laporan['judul'] }}</h1>
        
        <div>
            <x-status-badge :status="$laporan['status']" />
        </div>

        <hr style="border: 0; border-top: 1px solid var(--ln); margin: 20px 0 4px;">

        <div class="row">
            <span>Fasilitas</span>
            <div>{{ $laporan['fasilitas'] }}</div>
        </div>
        <div class="row">
            <span>Lokasi</span>
            <div>{{ $laporan['lokasi'] }}</div>
        </div>
        <div class="row">
            <span>Kategori</span>
            <div>{{ $laporan['kategori'] }}</div>
        </div>
        <div class="row">
            <span>Deskripsi</span>
            <div>{{ $laporan['deskripsi'] }}</div>
        </div>

        <h2 style="font-size: 15px; margin: 22px 0 12px;">Foto bukti kerusakan</h2>
        @if(!empty($laporan['foto']) && file_exists(public_path('storage/' . $laporan['foto'])))
            <div class="detail-photo-wrapper" style="margin-top: 10px;" onclick="bukaLightbox('{{ asset('storage/' . $laporan['foto']) }}', '{{ addslashes($laporan['judul']) }}')" title="Klik untuk memperbesar">
                <img src="{{ asset('storage/' . $laporan['foto']) }}" alt="Foto bukti kerusakan" style="width: 100%; max-height: 380px; object-fit: cover; display: block;">
                <div class="detail-photo-overlay">
                    <span>🔍 Klik untuk memperbesar foto</span>
                </div>
            </div>
        @else
            <div class="ph" style="background: var(--ln); color: var(--mu);">
                Pratinjau foto
            </div>
        @endif
    </div>

    <div class="card">
        <h2>Riwayat Perkembangan</h2>
        
        <div class="tl">
            @foreach($laporan['timeline'] as $step)
                <div class="tl-item {{ $step['aktif'] ? 'on' : '' }}">
                    <b>{{ $step['judul'] }}</b>
                    <small>{{ $step['keterangan'] }}</small>
                </div>
            @endforeach
        </div>

        <div class="note">
            Kamu akan menerima pembaruan saat status laporan berubah.
        </div>
    </div>
</div>
@endsection
