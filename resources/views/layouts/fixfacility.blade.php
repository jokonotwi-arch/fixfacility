<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FixFacility') }} - {{ $title ?? 'Dashboard' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Sidebar Overlay (mobile) -->
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/50 lg:hidden"
        style="display: none;"
    ></div>

    <!-- Sidebar -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
    >
        <x-ff-sidebar :role="$role ?? 'pelapor'" :active="$active ?? ''" />
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex flex-col min-h-screen lg:pl-64">

        <!-- Top Navbar -->
        <x-ff-navbar>
            <x-slot name="title">{{ $title ?? 'Dashboard' }}</x-slot>
        </x-ff-navbar>

        <!-- Page Content -->
        <main class="flex-1 p-4 md:p-6 lg:p-8">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 px-6 py-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-slate-500">
                <p>&copy; {{ date('Y') }} <span class="font-semibold text-blue-700">FixFacility</span>. Semua hak dilindungi.</p>
                <p>Sistem Pelaporan Fasilitas</p>
            </div>
        </footer>
    </div>

</body>
</html>
