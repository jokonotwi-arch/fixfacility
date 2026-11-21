@props([
    'title' => 'Belum ada laporan',
    'message' => 'Kamu belum pernah mengirim laporan kerusakan fasilitas.<br>Mulai dengan membuat laporan pertama agar kerusakan dapat segera ditangani.',
    'actionText' => '+ Buat Laporan',
    'actionUrl' => null,
])

<div class="empty">
    <div class="ic">
        <div class="ic-doc">
            <div class="ic-line"></div>
            <div class="ic-line"></div>
            <div class="ic-line"></div>
        </div>
    </div>
    <h2>{{ $title }}</h2>
    <p>{!! $message !!}</p>
    @if($actionUrl)
        <a href="{{ $actionUrl }}" class="btn">{{ $actionText }}</a>
    @endif
</div>
