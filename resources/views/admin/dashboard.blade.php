@extends('layouts.admin')

@section('content')
<div class="top">
    <div>
        <h1>Dashboard Admin</h1>
        <p class="lead">Ringkasan laporan kerusakan fasilitas dari seluruh warga kampus.</p>
    </div>
</div>

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
    <h2>Ringkasan Status Laporan</h2>
    <div style="margin-top: 14px;">
        @foreach($statusBreakdown as $sb)
            <x-progress-bar 
                :label="$sb['label']" 
                :value="$sb['value']" 
                :max="$sb['max']" 
                :color="$sb['color']" 
            />
        @endforeach
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom: 8px;">Laporan Terbaru</h2>
    <div class="scroll">
        <table>
            <tbody>
                @foreach(array_slice($laporanTerbaru, 0, 2) as $item)
                    <tr>
                        <td class="muted" style="width: 140px;">{{ $item['pelapor'] }}</td>
                        <td><b>{{ $item['judul'] }}</b></td>
                        <td class="muted">{{ $item['lokasi_singkat'] ?? $item['lokasi'] }}</td>
                        <td class="muted">{{ $item['tanggal'] }}</td>
                        <td><x-status-badge :status="$item['status']" /></td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.show', $item['kode']) }}">Detail →</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
