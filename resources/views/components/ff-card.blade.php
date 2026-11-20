@props([
    'title' => null,
    'noPadding' => false,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden']) }}>
    @if($title)
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-slate-700">{{ $title }}</h3>
        @isset($action)
        <div class="flex-shrink-0">{{ $action }}</div>
        @endisset
    </div>
    @endif

    <div class="{{ $noPadding ? '' : 'p-6' }}">
        {{ $slot }}
    </div>
</div>
