@props([
    'label' => null,
    'title' => null,
    'value',
    'subtext' => null,
    'description' => null,
    'url' => null,
])

@php
    $cardLabel = $label ?? $title;
    $cardSub = $subtext ?? $description;
@endphp

<div class="card stat">
    <span class="stat-label">{{ $cardLabel }}</span>
    <b class="stat-val">{{ $value }}</b>
    @if($url)
        <a href="{{ $url }}" class="stat-sub">{{ $cardSub }}</a>
    @else
        <span class="stat-sub">{{ $cardSub }}</span>
    @endif
</div>
