@props([
    'icon'  => '',
    'value' => '0',
    'label' => '',
    'trend' => null,
    'trendUp' => true,
    'color' => 'blue',
])

@php
$colorMap = [
    'blue'   => ['bg' => 'bg-blue-50',   'icon' => 'bg-blue-100 text-blue-700',   'value' => 'text-blue-700'],
    'yellow' => ['bg' => 'bg-yellow-50', 'icon' => 'bg-yellow-100 text-yellow-700', 'value' => 'text-yellow-700'],
    'green'  => ['bg' => 'bg-green-50',  'icon' => 'bg-green-100 text-green-700',  'value' => 'text-green-700'],
    'red'    => ['bg' => 'bg-red-50',    'icon' => 'bg-red-100 text-red-600',      'value' => 'text-red-600'],
];

$colors = $colorMap[$color] ?? $colorMap['blue'];

$svgIcons = [
    'home'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
    'clipboard' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
    'check'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'x-circle'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'clock'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'users'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    'chart'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
];

$svgPath = $svgIcons[$icon] ?? $svgIcons['clipboard'];
@endphp

<div {{ $attributes->merge(['class' => "bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-start gap-4"]) }}>

    <!-- Icon -->
    <div class="w-12 h-12 rounded-xl {{ $colors['icon'] }} flex items-center justify-center flex-shrink-0">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $svgPath !!}
        </svg>
    </div>

    <!-- Content -->
    <div class="flex-1 min-w-0">
        <p class="text-2xl font-bold {{ $colors['value'] }} leading-none mb-1">{{ $value }}</p>
        <p class="text-sm text-slate-500 font-medium">{{ $label }}</p>

        @if($trend !== null)
        <div class="flex items-center gap-1 mt-2">
            <svg class="w-3.5 h-3.5 {{ $trendUp ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if($trendUp)
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                @endif
            </svg>
            <span class="text-xs {{ $trendUp ? 'text-green-600' : 'text-red-600' }} font-medium">{{ $trend }}</span>
        </div>
        @endif
    </div>
</div>
