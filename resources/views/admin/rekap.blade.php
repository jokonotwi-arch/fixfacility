@extends('layouts.admin')

@section('content')
<div class="top">
    <div>
        <h1>Rekap Laporan</h1>
        <p class="lead">Statistik laporan kerusakan fasilitas kampus.</p>
    </div>
</div>

<div class="card top" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="width: 240px;">
        <label for="rekap-periode">Periode rekap</label>
        <select id="rekap-periode" name="periode" onchange="location.href='{{ route('admin.rekap') }}?periode=' + encodeURIComponent(this.value)">
            @foreach($rekapSummary['periode_pilihan'] as $p)
                <option value="{{ $p }}" {{ $rekapSummary['periode'] === $p ? 'selected' : '' }}>{{ $p }}</option>
            @endforeach
        </select>
    </div>
    <span style="color: var(--mu); font-size: 13px;">Data diperbarui: {{ $rekapSummary['tanggal_update'] }}</span>
</div>

<div class="grid4">
    @foreach($rekapSummary['stats_cards'] as $stat)
        <x-stat-card 
            :label="$stat['label']" 
            :value="$stat['value']" 
            :subtext="$stat['subtext']" 
        />
    @endforeach
</div>

<div class="fl">
    <div class="card">
        <h2>Komposisi Status Laporan</h2>
        <div style="margin-top: 14px;">
            @foreach($statusBreakdown as $sb)
                <x-progress-bar 
                    :label="$sb['label']" 
                    :value="$sb['value']" 
                    :max="$sb['max'] ?? 1" 
                    :color="$sb['color']" 
                />
            @endforeach
        </div>
    </div>

    <div class="card">
        <h2>Laporan per Kategori</h2>
        <div style="margin-top: 14px;">
            @foreach($kategoriStats as $ks)
                <x-progress-bar 
                    :label="$ks['label']" 
                    :value="$ks['value']" 
                    :max="$ks['max']" 
                    :color="$ks['color']" 
                />
            @endforeach
        </div>
    </div>
</div>

<div style="margin-top: 18px;">
    <b>Ringkasan periode</b>
    <p style="color: var(--mu); margin: 4px 0 0;">
        Kategori terbanyak: {{ $rekapSummary['kategori_terbanyak'] }} • Tingkat penyelesaian: {{ $rekapSummary['tingkat_penyelesaian'] }}
    </p>
</div>
@endsection
