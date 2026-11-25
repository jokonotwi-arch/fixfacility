@extends('layouts.admin')

@section('content')
<div class="top">
    <div>
        <h1>Semua Laporan</h1>
        <p class="lead">Kelola, tinjau, dan tindak lanjuti laporan dari seluruh warga kampus.</p>
    </div>
</div>

<div class="card">
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="fi" id="form-filter-admin">
        <div class="fi-search">
            <label for="filter-search">Cari laporan</label>
            <input 
                type="text" 
                id="filter-search" 
                name="q" 
                placeholder="Cari kode, judul, pelapor..."
                value="{{ request('q') }}"
            >
        </div>
        <div class="fi-status">
            <label for="filter-status">Status</label>
            <select id="filter-status" name="status" class="select">
                <option value="">Semua status</option>
                <option value="Menunggu" {{ request('status') === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Diproses" {{ request('status') === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ request('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="fi-kategori">
            <label for="filter-kategori">Kategori</label>
            <select id="filter-kategori" name="kategori" class="select">
                <option value="">Semua kategori</option>
                @if(isset($formOptions['kategori']))
                    @foreach($formOptions['kategori'] as $opt)
                        <option value="{{ $opt }}" {{ request('kategori') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                @else
                    <option value="Kelistrikan" {{ request('kategori') === 'Kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                    <option value="Peralatan kelas" {{ request('kategori') === 'Peralatan kelas' ? 'selected' : '' }}>Peralatan kelas</option>
                    <option value="Sanitasi" {{ request('kategori') === 'Sanitasi' ? 'selected' : '' }}>Sanitasi</option>
                    <option value="Bangunan" {{ request('kategori') === 'Bangunan' ? 'selected' : '' }}>Bangunan</option>
                @endif
            </select>
        </div>
        <div class="fi-btn">
            <button type="submit" class="btn" id="btn-filter-terapkan">Terapkan</button>
        </div>
    </form>
</div>

<div class="card">
    <h2>Daftar Laporan</h2>
    <p class="lead" id="laporan-count-text" style="margin: 4px 0 16px; font-size: 13px;">
        {{ $totalCount ?? 0 }} laporan tercatat
    </p>

    <div class="scroll">
        <table>
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>JUDUL LAPORAN</th>
                    <th>PELAPOR</th>
                    <th>LOKASI</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody id="laporan-tbody">
                @forelse($laporan as $item)
                    <tr 
                        data-kode="{{ $item['kode'] }}"
                        data-judul="{{ $item['judul'] }}"
                        data-pelapor="{{ $item['pelapor'] }}"
                        data-status="{{ $item['status'] }}"
                        data-kategori="{{ $item['kategori'] }}"
                    >
                        <td><b>{{ $item['kode'] }}</b></td>
                        <td><b>{{ $item['judul'] }}</b></td>
                        <td class="muted">{{ $item['pelapor'] }}</td>
                        <td class="muted">{{ $item['lokasi_singkat'] ?? $item['lokasi'] }}</td>
                        <td class="muted">{{ $item['tanggal'] }}</td>
                        <td><x-status-badge :status="$item['status']" /></td>
                        <td>
                            <a href="{{ route('admin.laporan.show', $item['kode']) }}">Detail →</a>
                        </td>
                    </tr>
                @empty
                    <tr id="row-no-match">
                        <td colspan="7" style="text-align: center; color: var(--mu); padding: 24px;">
                            Tidak ada laporan yang cocok.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($laporan, 'links') && $laporan->hasPages())
        <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
            {{ $laporan->links() }}
        </div>
    @endif
</div>
@endsection
