<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - FixFacility</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100" x-data="{ sidebarOpen: false }">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"></div>

    <!-- Admin Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 w-64 bg-[#1E3A5F] transform transition-transform duration-300 z-30 lg:translate-x-0 lg:static flex flex-col flex-shrink-0">

        <!-- Logo -->
        <div class="flex items-center px-6 py-5 border-b border-blue-800">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <span class="text-white text-lg font-bold">FixFacility</span>
                <span class="block text-blue-300 text-xs">Admin Panel</span>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <!-- Dashboard -->
            <a href="/preview/admin/dashboard" class="flex items-center px-3 py-2.5 rounded-lg bg-white text-blue-700 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <!-- Laporan -->
            <a href="/preview/admin/laporan" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Manajemen Laporan
                <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-0.5">12</span>
            </a>
            <!-- Pengguna -->
            <a href="/preview/admin/pengguna" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Manajemen Pengguna
            </a>
            <!-- Profil -->
            <a href="/preview/admin/profil" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Admin
            </a>
        </nav>

        <!-- Admin user at bottom -->
        <div class="px-4 py-4 border-t border-blue-800">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">A</span>
                </div>
                <div class="ml-3">
                    <p class="text-white text-sm font-medium">Admin Fasilitas</p>
                    <p class="text-blue-300 text-xs">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top navbar -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between flex-shrink-0">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">Dashboard Admin</h1>
            <div class="flex items-center space-x-4" x-data="{ notifOpen: false, userOpen: false }">
                <!-- Notification Bell -->
                <button @click="notifOpen = !notifOpen" class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <!-- User Dropdown -->
                <div class="relative">
                    <button @click="userOpen = !userOpen" class="flex items-center space-x-2 p-1 rounded-lg hover:bg-gray-100">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">A</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:block">Admin Fasilitas</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="userOpen" @click.away="userOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                        <a href="/preview/admin/profil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                        <hr class="my-1">
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            <!-- Welcome -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Selamat Datang, Admin! 👋</h2>
                <p class="text-gray-500 mt-1">Berikut ringkasan aktivitas sistem FixFacility hari ini.</p>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
                <!-- Total Laporan -->
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Laporan</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">45</p>
                            <p class="text-xs text-blue-600 mt-1">↑ 8 laporan bulan ini</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Menunggu -->
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Menunggu</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                            <p class="text-xs text-yellow-600 mt-1">Perlu ditindaklanjuti</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Diproses -->
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-sky-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Diproses</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">18</p>
                            <p class="text-xs text-sky-600 mt-1">Sedang ditangani</p>
                        </div>
                        <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Selesai -->
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Selesai</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">15</p>
                            <p class="text-xs text-green-600 mt-1">Berhasil diselesaikan</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart + Category Summary -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mb-6">
                <!-- Chart Placeholder -->
                <div class="xl:col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-gray-800">Grafik Laporan Bulanan</h3>
                        <span class="text-sm text-gray-500">2024</span>
                    </div>
                    <!-- CSS Bar Chart -->
                    <div class="flex items-end justify-between h-40 gap-2">
                        @php
                        $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                        $values = [5,8,6,12,9,15,11,7,13,10,8,12];
                        $max = max($values);
                        @endphp
                        @foreach($months as $i => $month)
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-full bg-blue-500 rounded-t-sm transition-all hover:bg-blue-600"
                                 style="height: {{ ($values[$i]/$max)*100 }}%"
                                 title="{{ $values[$i] }} laporan"></div>
                            <span class="text-xs text-gray-400 mt-1">{{ $month }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Category Summary -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-base font-semibold text-gray-800 mb-4">Laporan per Kategori</h3>
                    <div class="space-y-3">
                        @php
                        $categories = [
                            ['name'=>'Lampu','count'=>10,'color'=>'yellow','bar'=>67],
                            ['name'=>'Air','count'=>8,'color'=>'blue','bar'=>53],
                            ['name'=>'AC','count'=>7,'color'=>'sky','bar'=>47],
                            ['name'=>'Toilet','count'=>5,'color'=>'purple','bar'=>33],
                            ['name'=>'Lainnya','count'=>15,'color'=>'gray','bar'=>100],
                        ];
                        @endphp
                        @foreach($categories as $cat)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-medium text-gray-700">{{ $cat['name'] }}</span>
                                <span class="text-gray-500">{{ $cat['count'] }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $cat['bar'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Laporan Table -->
            <div class="bg-white rounded-xl shadow-sm mb-6">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-800">Laporan Terbaru</h3>
                    <div class="flex items-center gap-3">
                        <a href="/preview/admin/laporan" class="text-sm text-blue-600 hover:underline font-medium">Lihat Semua →</a>
                        <a href="/preview/admin/laporan" class="bg-blue-600 text-white text-sm px-4 py-1.5 rounded-lg hover:bg-blue-700 transition-colors">Lihat Laporan Baru</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">ID</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Pelapor</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Judul</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Kategori</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Lokasi</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Prioritas</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Tanggal</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#LPR-045</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Ahmad Fauzi</td>
                                <td class="px-6 py-4 text-gray-700">Lampu koridor padam</td>
                                <td class="px-6 py-4 text-gray-600">Lampu</td>
                                <td class="px-6 py-4 text-gray-600">Gedung A Lt.3</td>
                                <td class="px-6 py-4"><span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-medium">Tinggi</span></td>
                                <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-medium">Menunggu</span></td>
                                <td class="px-6 py-4 text-gray-500">20 Nov 2024</td>
                                <td class="px-6 py-4"><a href="/preview/admin/laporan/detail" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg hover:bg-blue-700">Proses</a></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#LPR-044</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Siti Rahayu</td>
                                <td class="px-6 py-4 text-gray-700">AC bocor di ruang kelas</td>
                                <td class="px-6 py-4 text-gray-600">AC</td>
                                <td class="px-6 py-4 text-gray-600">Gedung B Lt.2</td>
                                <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-medium">Sedang</span></td>
                                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-medium">Diproses</span></td>
                                <td class="px-6 py-4 text-gray-500">19 Nov 2024</td>
                                <td class="px-6 py-4"><a href="/preview/admin/laporan/detail" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg hover:bg-blue-700">Proses</a></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#LPR-043</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Budi Santoso</td>
                                <td class="px-6 py-4 text-gray-700">Toilet mampet lantai 1</td>
                                <td class="px-6 py-4 text-gray-600">Toilet</td>
                                <td class="px-6 py-4 text-gray-600">Gedung C Lt.1</td>
                                <td class="px-6 py-4"><span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-medium">Tinggi</span></td>
                                <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-medium">Menunggu</span></td>
                                <td class="px-6 py-4 text-gray-500">18 Nov 2024</td>
                                <td class="px-6 py-4"><a href="/preview/admin/laporan/detail" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg hover:bg-blue-700">Proses</a></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#LPR-042</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Dewi Lestari</td>
                                <td class="px-6 py-4 text-gray-700">Air tidak keluar kamar mandi</td>
                                <td class="px-6 py-4 text-gray-600">Air</td>
                                <td class="px-6 py-4 text-gray-600">Gedung A Lt.1</td>
                                <td class="px-6 py-4"><span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full font-medium">Rendah</span></td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-medium">Selesai</span></td>
                                <td class="px-6 py-4 text-gray-500">17 Nov 2024</td>
                                <td class="px-6 py-4"><a href="/preview/admin/laporan/detail" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg hover:bg-blue-700">Proses</a></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#LPR-041</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Rudi Hartono</td>
                                <td class="px-6 py-4 text-gray-700">Pintu rusak tidak bisa dikunci</td>
                                <td class="px-6 py-4 text-gray-600">Lainnya</td>
                                <td class="px-6 py-4 text-gray-600">Gedung D Lt.2</td>
                                <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-medium">Sedang</span></td>
                                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-medium">Diproses</span></td>
                                <td class="px-6 py-4 text-gray-500">16 Nov 2024</td>
                                <td class="px-6 py-4"><a href="/preview/admin/laporan/detail" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg hover:bg-blue-700">Proses</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
