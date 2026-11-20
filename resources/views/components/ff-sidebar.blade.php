@props([
    'role' => 'pelapor',
    'active' => '',
])

@php
$pelapor_nav = [
    ['label' => 'Dashboard',     'route' => '/preview/pelapor/dashboard',       'name' => 'pelapor.dashboard', 'icon' => 'home'],
    ['label' => 'Buat Laporan',  'route' => '/preview/pelapor/laporan/buat',    'name' => 'pelapor.laporan.buat', 'icon' => 'plus'],
    ['label' => 'Laporan Saya',  'route' => '/preview/pelapor/laporan',         'name' => 'pelapor.laporan', 'icon' => 'list'],
    ['label' => 'Profil',        'route' => '/preview/pelapor/profil',          'name' => 'pelapor.profil', 'icon' => 'user'],
];

$admin_nav = [
    ['label' => 'Dashboard',          'route' => '/preview/admin/dashboard', 'name' => 'admin.dashboard', 'icon' => 'home'],
    ['label' => 'Manajemen Laporan',  'route' => '/preview/admin/laporan',   'name' => 'admin.laporan',   'icon' => 'clipboard'],
    ['label' => 'Manajemen Pengguna', 'route' => '/preview/admin/pengguna',  'name' => 'admin.pengguna',  'icon' => 'users'],
    ['label' => 'Profil',             'route' => '/preview/admin/profil',    'name' => 'admin.profil',    'icon' => 'user'],
];

$navItems = $role === 'admin' ? $admin_nav : $pelapor_nav;

$icons = [
    'home' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
    'plus' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>',
    'list' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>',
    'user' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    'clipboard' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
];
@endphp

<div class="h-full flex flex-col" style="background-color: #1E3A5F;">

    <!-- Logo -->
    <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
        <div class="w-9 h-9 bg-blue-500 rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div>
            <span class="text-white font-bold text-lg leading-tight block">FixFacility</span>
            <span class="text-blue-300 text-xs font-medium capitalize">{{ $role }}</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @foreach($navItems as $item)
            @php
                $isActive = $active === $item['name'] || request()->is(ltrim($item['route'], '/'));
            @endphp
            <a href="{{ $item['route'] }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-150 group
                      {{ $isActive
                          ? 'bg-white text-blue-700 font-semibold shadow-sm'
                          : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $isActive ? 'text-blue-700' : 'text-gray-400 group-hover:text-white' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icons[$item['icon']] !!}
                </svg>
                <span class="text-sm">{{ $item['label'] }}</span>

                @if($isActive)
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-700"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <!-- Bottom: Role badge -->
    <div class="px-4 py-4 border-t border-white/10">
        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-white/5">
            <div class="w-2 h-2 rounded-full {{ $role === 'admin' ? 'bg-purple-400' : 'bg-green-400' }}"></div>
            <span class="text-xs text-gray-300 capitalize">Mode: {{ $role }}</span>
        </div>
    </div>
</div>
