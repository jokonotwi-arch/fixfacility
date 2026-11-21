@extends('layouts.admin')

@section('content')
<div class="top">
    <div>
        <h1>Detail Laporan</h1>
        <p class="lead">Periksa bukti kerusakan dan perbarui status laporan.</p>
    </div>
</div>

<div class="two">
    <div class="card">
        <span class="muted">{{ $laporan['kode'] }} • {{ $laporan['tanggal_lengkap'] ?? $laporan['tanggal'] }}</span>
        <h1 style="margin: 8px 0 12px; font-size: 24px;">{{ $laporan['judul'] }}</h1>

        <div>
            <x-status-badge :status="$laporan['status']" />
        </div>

        <div style="margin-top: 18px;">
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
        </div>

        <h2 style="font-size: 15px; margin: 22px 0 12px;">Foto Bukti</h2>
        <div class="ph">
            Pratinjau foto
        </div>
    </div>

    <div class="card">
        <h2>Pembaruan Status</h2>
        <p class="lead" style="margin: 4px 0 16px; font-size: 13px;">Pilih status terbaru laporan ini.</p>

        <form method="POST" action="{{ route('admin.laporan.update', $laporan['kode']) }}">
            @csrf
            <div style="margin-bottom: 14px;">
                <label for="status-select">Status laporan</label>
                <select id="status-select" name="status">
                    <option value="">Pilih status</option>
                    @foreach($formOptions['status'] as $st)
                        <option value="{{ $st }}" {{ $laporan['status'] === $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            <div class="chips">
                @foreach($formOptions['status'] as $st)
                    <span 
                        class="b {{ $st }} chip-status {{ $laporan['status'] === $st ? 'active' : '' }}" 
                        data-status="{{ $st }}"
                    >
                        {{ $st }}
                    </span>
                @endforeach
            </div>

            <button type="submit" class="btn w">Simpan Perubahan</button>
        </form>

        <button 
            type="button" 
            class="btn red w" 
            style="margin-top: 10px;"
            onclick="bukaModalHapus('{{ $laporan['kode'] }}', '{{ addslashes($laporan['judul']) }}', '{{ route('admin.laporan.destroy', $laporan['kode']) }}')"
        >
            Hapus Laporan
        </button>
    </div>
</div>

<x-modal-konfirmasi 
    id="modal-konfirmasi-hapus"
    titleId="modal-hapus-title"
    descId="modal-hapus-desc"
    formId="modal-hapus-form"
    :title="'Hapus laporan ini?'"
    :desc="'Laporan ' . $laporan['kode'] . ' — ' . $laporan['judul'] . ' akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.'"
    :action="route('admin.laporan.destroy', $laporan['kode'])"
/>

<div style="color: var(--mu); font-size: 12px; margin-top: 14px;">
    Test state visual: 
    <a href="{{ route('admin.laporan.show', [$laporan['kode'], 'state' => 'modal_hapus']) }}">Tampilkan Modal Konfirmasi</a> • 
    <a href="{{ route('admin.laporan.show', $laporan['kode']) }}">Normal</a>
</div>

@if(request('state') === 'modal_hapus' || request('modal') === '1')
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            bukaModalHapus('{{ $laporan['kode'] }}', '{{ addslashes($laporan['judul']) }}', '{{ route('admin.laporan.destroy', $laporan['kode']) }}');
        });
    </script>
    @endpush
@endif
@endsection
