@extends('layouts.pelapor')

@section('content')
@php
    $isEmpty = request('empty') == '1' || count($laporan) === 0;
@endphp

<div class="top">
    <div>
        <h1>Daftar Laporan Saya</h1>
        <p class="lead">Lihat seluruh laporan kerusakan yang pernah kamu kirim dan pantau statusnya.</p>
    </div>
    @if(!$isEmpty)
        <div>
            <a href="{{ route('pelapor.laporan.create') }}" class="btn">+ Buat Laporan</a>
        </div>
    @endif
</div>

<div class="card">
    <h2>Semua Laporan</h2>
    <p class="lead" style="margin: 4px 0 16px; font-size: 13px;">
        {{ $isEmpty ? '0 laporan' : 'Menampilkan laporan milik akun kamu.' }}
    </p>

    @if(!$isEmpty)
        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>KODE</th>
                        <th>JUDUL LAPORAN</th>
                        <th>FASILITAS / LOKASI</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporan as $item)
                        <tr>
                            <td><span class="muted">{{ $item['kode'] }}</span></td>
                            <td><b>{{ $item['judul'] }}</b></td>
                            <td class="muted">{{ $item['lokasi'] ?? $item['fasilitas'] }}</td>
                            <td class="muted">{{ $item['tanggal'] }}</td>
                            <td><x-status-badge :status="$item['status']" /></td>
                            <td>
                                <a href="{{ route('pelapor.laporan.show', $item['kode']) }}">Detail →</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <hr style="border: 0; border-top: 1px solid var(--ln); margin: 0 0 24px;">
        <x-empty-state 
            title="Belum ada laporan"
            message="Kamu belum pernah mengirim laporan kerusakan fasilitas.<br>Mulai dengan membuat laporan pertama agar kerusakan dapat segera ditangani."
            actionText="+ Buat Laporan"
            :actionUrl="route('pelapor.laporan.create')"
        />
    @endif
</div>

<div style="color: var(--mu); font-size: 12px; margin-top: 8px;">
    Test state visual: 
    <a href="{{ route('pelapor.laporan.index') }}">Ada Laporan (Normal)</a> • 
    <a href="{{ route('pelapor.laporan.index', ['empty' => 1]) }}">Belum Ada Laporan (Kosong)</a>
</div>
@endsection
