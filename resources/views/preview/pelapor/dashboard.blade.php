<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - FixFacility</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100" x-data="{ sidebarOpen: false }">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Overlay (mobile) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 w-64 bg-[#1E3A5F] transform transition-transform duration-300 ease-in-out z-30 lg:translate-x-0 lg:static lg:inset-0 flex flex-col">

        <!-- Logo -->
        <div class="flex items-center px-6 py-5 border-b border-blue-800">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="text-white text-lg font-bold">FixFacility</span>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="/preview/pelapor/dashboard" class="flex items-center px-3 py-2.5 rounded-lg bg-white text-blue-700 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="/preview/pelapor/laporan/buat" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Laporan
            </a>
            <a href="/preview/pelapor/laporan" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Laporan Saya
            </a>
            <a href="/preview/pelapor/profil" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Saya
            </a>
        </nav>

        <!-- User info -->
        <div class="px-4 py-4 border-t border-blue-800">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">BS</span>
                </div>
                <div class="ml-3">
                    <p class="text-white text-sm font-medium">Budi Santoso</p>
                    <p class="text-blue-300 text-xs">Pelapor</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <button class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">BS</span>
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-gray-700">Budi Santoso</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                        <a href="/preview/pelapor/profil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil Saya</a>
                        <div class="border-t border-gray-100"></div>
                        <a href="/preview/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Welcome -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Selamat Datang, Budi! 👋</h2>
                <p class="text-gray-500 mt-1">Pantau dan kelola laporan fasilitas Anda di sini.</p>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- Total -->
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">12</p>
                        <p class="text-sm text-gray-500 font-medium">Total Laporan</p>
                    </div>
                </div>
                <!-- Menunggu -->
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">3</p>
                        <p class="text-sm text-gray-500 font-medium">Menunggu</p>
                    </div>
                </div>
                <!-- Diproses -->
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">5</p>
                        <p class="text-sm text-gray-500 font-medium">Diproses</p>
                    </div>
                </div>
                <!-- Selesai -->
                <div class="bg-white rounded-xl shadow-sm p-6 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">4</p>
                        <p class="text-sm text-gray-500 font-medium">Selesai</p>
                    </div>
                </div>
            </div>

            <!-- Recent Reports -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Laporan Terbaru</h3>
                    <a href="/preview/pelapor/laporan/buat"
                       class="inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Laporan
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50">
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-mono text-xs">#LPR-2024-012</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Kerusakan Lampu Lorong</td>
                                <td class="px-6 py-4 text-gray-600">Kerusakan Lampu</td>
                                <td class="px-6 py-4 text-gray-600">Gedung A, Lantai 3</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">18 Nov 2024</td>
                                <td class="px-6 py-4">
                                    <a href="/preview/pelapor/laporan/detail" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-lg transition-colors">Lihat</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-mono text-xs">#LPR-2024-011</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Kebocoran Atap Ruang Rapat</td>
                                <td class="px-6 py-4 text-gray-600">Kebocoran Air</td>
                                <td class="px-6 py-4 text-gray-600">Gedung B, Lantai 2</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Diproses</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">15 Nov 2024</td>
                                <td class="px-6 py-4">
                                    <a href="/preview/pelapor/laporan/detail" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-lg transition-colors">Lihat</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-mono text-xs">#LPR-2024-010</td>
                                <td class="px-6 py-4 font-medium text-gray-800">AC Rusak Ruang Kelas 3B</td>
                                <td class="px-6 py-4 text-gray-600">AC Rusak</td>
                                <td class="px-6 py-4 text-gray-600">Gedung C, Lantai 1</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">10 Nov 2024</td>
                                <td class="px-6 py-4">
                                    <a href="/preview/pelapor/laporan/detail" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-lg transition-colors">Lihat</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-mono text-xs">#LPR-2024-009</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Toilet Tersumbat Lantai 2</td>
                                <td class="px-6 py-4 text-gray-600">Toilet</td>
                                <td class="px-6 py-4 text-gray-600">Gedung A, Lantai 2</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Diproses</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">08 Nov 2024</td>
                                <td class="px-6 py-4">
                                    <a href="/preview/pelapor/laporan/detail" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-lg transition-colors">Lihat</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-mono text-xs">#LPR-2024-008</td>
                                <td class="px-6 py-4 font-medium text-gray-800">Meja Retak Ruang Dosen</td>
                                <td class="px-6 py-4 text-gray-600">Meja/Kursi</td>
                                <td class="px-6 py-4 text-gray-600">Gedung D, Lantai 4</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">05 Nov 2024</td>
                                <td class="px-6 py-4">
                                    <a href="/preview/pelapor/laporan/detail" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-lg transition-colors">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 text-center">
                    <a href="/preview/pelapor/laporan" class="text-sm text-blue-700 hover:text-blue-800 font-medium">Lihat Semua Laporan →</a>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
