@extends('layouts.pelapor')

@section('content')
<div class="top">
    <div>
        <h1>Dashboard Pelapor</h1>
        <p class="lead">Pantau laporan kerusakan fasilitas yang telah kamu kirim.</p>
    </div>
    <div>
        <a href="{{ route('pelapor.laporan.create') }}" class="btn">+ Buat Laporan</a>
    </div>
</div>

<h2 style="margin: -10px 0 20px;">Selamat pagi!</h2>

<div class="grid4">
    @foreach($stats as $stat)
        <x-stat-card 
            :label="$stat['label']" 
            :value="$stat['value']" 
            :subtext="$stat['subtext']" 
        />
    @endforeach
</div>

<div class="card">
    <h2>Laporan Terbaru</h2>
    <p class="lead" style="margin: 4px 0 16px; font-size: 13px;">Daftar laporan yang terakhir kamu kirim.</p>

    @if(count($laporanTerbaru) > 0)
        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>KODE</th>
                        <th>JUDUL LAPORAN</th>
                        <th>FASILITAS</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanTerbaru as $item)
                        <tr>
                            <td><span class="muted">{{ $item['kode'] }}</span></td>
                            <td><b>{{ $item['judul'] }}</b></td>
                            <td class="muted">{{ $item['fasilitas'] ?? $item['lokasi_singkat'] }}</td>
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
        <p style="color: var(--mu); margin: 12px 0 0;">Belum ada laporan.</p>
    @endif
</div>
@endsection
