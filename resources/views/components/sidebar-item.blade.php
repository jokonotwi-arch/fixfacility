@props([
    'route' => null,
    'href' => null,
    'active' => false,
])

@php
    $link = $href ?? ($route ? route($route) : '#');
@endphp

<a href="{{ $link }}" class="nav {{ $active ? 'on' : '' }}">
    {{ $slot }}
</a>
