<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Saya - FixFacility</title>
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
        <div class="flex items-center px-6 py-5 border-b border-blue-800">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="text-white text-lg font-bold">FixFacility</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="/preview/pelapor/dashboard" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
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
            <a href="/preview/pelapor/laporan" class="flex items-center px-3 py-2.5 rounded-lg bg-white text-blue-700 text-sm font-medium transition-colors">
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
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">Laporan Saya</h1>
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

        <main class="flex-1 overflow-y-auto p-6"
              x-data="{
                search: '',
                statusFilter: 'semua',
                dateFrom: '',
                dateTo: '',
                reports: [
                    { no: 1, id: 'LPR-2024-012', judul: 'Kerusakan Lampu Lorong', kategori: 'Kerusakan Lampu', lokasi: 'Gedung A, Lt 3', prioritas: 'Sedang', status: 'menunggu', tanggal: '18 Nov 2024' },
                    { no: 2, id: 'LPR-2024-011', judul: 'Kebocoran Atap Ruang Rapat', kategori: 'Kebocoran Air', lokasi: 'Gedung B, Lt 2', prioritas: 'Tinggi', status: 'diproses', tanggal: '15 Nov 2024' },
                    { no: 3, id: 'LPR-2024-010', judul: 'AC Rusak Ruang Kelas 3B', kategori: 'AC Rusak', lokasi: 'Gedung C, Lt 1', prioritas: 'Tinggi', status: 'selesai', tanggal: '10 Nov 2024' },
                    { no: 4, id: 'LPR-2024-009', judul: 'Toilet Tersumbat Lantai 2', kategori: 'Toilet', lokasi: 'Gedung A, Lt 2', prioritas: 'Tinggi', status: 'diproses', tanggal: '08 Nov 2024' },
                    { no: 5, id: 'LPR-2024-008', judul: 'Meja Retak Ruang Dosen', kategori: 'Meja/Kursi', lokasi: 'Gedung D, Lt 4', prioritas: 'Rendah', status: 'selesai', tanggal: '05 Nov 2024' },
                    { no: 6, id: 'LPR-2024-007', judul: 'Pintu Kelas Tidak Bisa Dikunci', kategori: 'Pintu/Jendela', lokasi: 'Gedung B, Lt 1', prioritas: 'Sedang', status: 'ditolak', tanggal: '01 Nov 2024' },
                    { no: 7, id: 'LPR-2024-006', judul: 'Lampu Kamar Mandi Mati', kategori: 'Kerusakan Lampu', lokasi: 'Gedung A, Lt 1', prioritas: 'Rendah', status: 'selesai', tanggal: '28 Okt 2024' },
                    { no: 8, id: 'LPR-2024-005', judul: 'Proyektor Rusak Lab Komputer', kategori: 'Lainnya', lokasi: 'Gedung C, Lt 2', prioritas: 'Tinggi', status: 'diproses', tanggal: '25 Okt 2024' },
                    { no: 9, id: 'LPR-2024-004', judul: 'Jendela Pecah Ruang 204', kategori: 'Pintu/Jendela', lokasi: 'Gedung B, Lt 2', prioritas: 'Sedang', status: 'menunggu', tanggal: '22 Okt 2024' },
                    { no: 10, id: 'LPR-2024-003', judul: 'Wastafel Bocor Toilet Lt 3', kategori: 'Kebocoran Air', lokasi: 'Gedung D, Lt 3', prioritas: 'Sedang', status: 'menunggu', tanggal: '20 Okt 2024' },
                ],
                get filtered() {
                    return this.reports.filter(r => {
                        const matchSearch = this.search === '' || r.judul.toLowerCase().includes(this.search.toLowerCase()) || r.id.toLowerCase().includes(this.search.toLowerCase());
                        const matchStatus = this.statusFilter === 'semua' || r.status === this.statusFilter;
                        return matchSearch && matchStatus;
                    });
                },
                badgeClass(status) {
                    const map = { menunggu: 'bg-yellow-100 text-yellow-800', diproses: 'bg-blue-100 text-blue-800', selesai: 'bg-green-100 text-green-800', ditolak: 'bg-red-100 text-red-800' };
                    return map[status] || 'bg-gray-100 text-gray-800';
                },
                badgeLabel(status) {
                    const map = { menunggu: 'Menunggu', diproses: 'Diproses', selesai: 'Selesai', ditolak: 'Ditolak' };
                    return map[status] || status;
                },
                prioritasClass(p) {
                    const map = { Tinggi: 'bg-red-100 text-red-700', Sedang: 'bg-yellow-100 text-yellow-700', Rendah: 'bg-green-100 text-green-700' };
                    return map[p] || 'bg-gray-100 text-gray-700';
                }
              }">

            <!-- Header Row -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Daftar Laporan</h2>
                    <p class="text-gray-500 text-sm mt-1">Semua laporan yang pernah Anda buat</p>
                </div>
                <a href="/preview/pelapor/laporan/buat"
                   class="inline-flex items-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Laporan Baru
                </a>
            </div>

            <!-- Filter Bar -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-5">
                <div class="flex flex-col md:flex-row gap-3">
                    <!-- Search -->
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" x-model="search" placeholder="Cari laporan..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <!-- Status filter -->
                    <select x-model="statusFilter" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white min-w-[150px]">
                        <option value="semua">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <!-- Date from -->
                    <input type="date" x-model="dateFrom" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Date to -->
                    <input type="date" x-model="dateTo" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Reset -->
                    <button @click="search=''; statusFilter='semua'; dateFrom=''; dateTo=''"
                            class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors whitespace-nowrap">
                        Reset
                    </button>
                </div>
            </div>

            <!-- Result count -->
            <p class="text-sm text-gray-500 mb-3">Menampilkan <span class="font-semibold text-gray-700" x-text="filtered.length"></span> laporan</p>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Laporan</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Prioritas</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="r in filtered" :key="r.id">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 text-gray-500" x-text="r.no"></td>
                                    <td class="px-4 py-3 font-mono text-xs text-gray-500" x-text="'#' + r.id"></td>
                                    <td class="px-4 py-3 font-medium text-gray-800" x-text="r.judul"></td>
                                    <td class="px-4 py-3 text-gray-600" x-text="r.kategori"></td>
                                    <td class="px-4 py-3 text-gray-600" x-text="r.lokasi"></td>
                                    <td class="px-4 py-3">
                                        <span :class="'inline-flex items-center px-2 py-0.5 rounded text-xs font-medium ' + prioritasClass(r.prioritas)" x-text="r.prioritas"></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span :class="'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' + badgeClass(r.status)" x-text="badgeLabel(r.status)"></span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 whitespace-nowrap" x-text="r.tanggal"></td>
                                    <td class="px-4 py-3">
                                        <a href="/preview/pelapor/laporan/detail" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-medium rounded-lg transition-colors">Lihat</a>
                                    </td>
                                </tr>
                            </template>
                            <!-- Empty state -->
                            <tr x-show="filtered.length === 0">
                                <td colspan="9" class="px-4 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p class="text-gray-400 font-medium">Tidak ada laporan ditemukan</p>
                                    <p class="text-gray-300 text-sm mt-1">Coba ubah filter pencarian Anda</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-500">Menampilkan 1–10 dari 10 laporan</p>
                    <div class="flex items-center space-x-1">
                        <button class="px-3 py-1.5 text-sm text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">← Prev</button>
                        <button class="px-3 py-1.5 text-sm bg-blue-700 text-white rounded-lg">1</button>
                        <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">2</button>
                        <button class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">3</button>
                        <button class="px-3 py-1.5 text-sm text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">Next →</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
