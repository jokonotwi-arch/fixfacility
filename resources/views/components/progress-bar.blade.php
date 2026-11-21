@props([
    'label',
    'value',
    'max' => 100,
    'color' => '#2563eb',
])

@php
    $percentage = $max > 0 ? min(100, round(($value / $max) * 100, 1)) : 0;
@endphp

<div class="bar">
    <i>{{ $label }}</i>
    <div class="bar-track">
        <u style="width: {{ $percentage }}%; background: {{ $color }};"></u>
    </div>
    <b>{{ $value }}</b>
</div>
