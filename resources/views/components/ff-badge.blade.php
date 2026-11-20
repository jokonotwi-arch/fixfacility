@props([
    'status' => 'menunggu',
])

@php
$styles = [
    'menunggu' => 'bg-yellow-100 text-yellow-800',
    'diproses'  => 'bg-blue-100 text-blue-800',
    'selesai'   => 'bg-green-100 text-green-800',
    'ditolak'   => 'bg-red-100 text-red-800',
];

$labels = [
    'menunggu' => 'Menunggu',
    'diproses'  => 'Diproses',
    'selesai'   => 'Selesai',
    'ditolak'   => 'Ditolak',
];

$dots = [
    'menunggu' => 'bg-yellow-500',
    'diproses'  => 'bg-blue-500',
    'selesai'   => 'bg-green-500',
    'ditolak'   => 'bg-red-500',
];

$style = $styles[$status] ?? 'bg-slate-100 text-slate-700';
$label = $labels[$status] ?? ucfirst($status);
$dot   = $dots[$status]   ?? 'bg-slate-400';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium $style"]) }}>
    <span class="w-1.5 h-1.5 rounded-full {{ $dot }}"></span>
    {{ $label }}
</span>
