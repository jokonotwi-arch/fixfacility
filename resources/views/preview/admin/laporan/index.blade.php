<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Laporan - FixFacility</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100"
      x-data="{
        sidebarOpen: false,
        search: '',
        statusFilter: '',
        kategoriFilter: '',
        prioritasFilter: '',
        bulkSelected: [],
        selectAll: false,
        rows: [
            {id:'LPR-045',pelapor:'Ahmad Fauzi',judul:'Lampu koridor padam',kategori:'Lampu',lokasi:'Gedung A Lt.3',prioritas:'Tinggi',status:'menunggu',tanggal:'20 Nov 2024'},
            {id:'LPR-044',pelapor:'Siti Rahayu',judul:'AC bocor di ruang kelas',kategori:'AC',lokasi:'Gedung B Lt.2',prioritas:'Sedang',status:'diproses',tanggal:'19 Nov 2024'},
            {id:'LPR-043',pelapor:'Budi Santoso',judul:'Toilet mampet lantai 1',kategori:'Toilet',lokasi:'Gedung C Lt.1',prioritas:'Tinggi',status:'menunggu',tanggal:'18 Nov 2024'},
            {id:'LPR-042',pelapor:'Dewi Lestari',judul:'Air tidak keluar kamar mandi',kategori:'Air',lokasi:'Gedung A Lt.1',prioritas:'Rendah',status:'selesai',tanggal:'17 Nov 2024'},
            {id:'LPR-041',pelapor:'Rudi Hartono',judul:'Pintu rusak tidak bisa dikunci',kategori:'Lainnya',lokasi:'Gedung D Lt.2',prioritas:'Sedang',status:'diproses',tanggal:'16 Nov 2024'},
            {id:'LPR-040',pelapor:'Maya Sari',judul:'Lampu toilet mati',kategori:'Lampu',lokasi:'Gedung B Lt.1',prioritas:'Rendah',status:'selesai',tanggal:'15 Nov 2024'},
            {id:'LPR-039',pelapor:'Eko Prasetyo',judul:'AC tidak dingin',kategori:'AC',lokasi:'Gedung A Lt.4',prioritas:'Sedang',status:'diproses',tanggal:'14 Nov 2024'},
            {id:'LPR-038',pelapor:'Fitri Handayani',judul:'Kebocoran pipa air',kategori:'Air',lokasi:'Gedung C Lt.2',prioritas:'Tinggi',status:'menunggu',tanggal:'13 Nov 2024'},
            {id:'LPR-037',pelapor:'Hendra Gunawan',judul:'Kaca jendela pecah',kategori:'Lainnya',lokasi:'Gedung D Lt.1',prioritas:'Sedang',status:'ditolak',tanggal:'12 Nov 2024'},
            {id:'LPR-036',pelapor:'Indah Permata',judul:'Stop kontak tidak berfungsi',kategori:'Lampu',lokasi:'Gedung B Lt.3',prioritas:'Tinggi',status:'menunggu',tanggal:'11 Nov 2024'},
        ],
        get filteredRows() {
            return this.rows.filter(r => {
                const matchSearch = this.search === '' || r.pelapor.toLowerCase().includes(this.search.toLowerCase()) || r.judul.toLowerCase().includes(this.search.toLowerCase()) || r.id.toLowerCase().includes(this.search.toLowerCase());
                const matchStatus = this.statusFilter === '' || r.status === this.statusFilter;
                const matchKategori = this.kategoriFilter === '' || r.kategori === this.kategoriFilter;
                const matchPrioritas = this.prioritasFilter === '' || r.prioritas === this.prioritasFilter;
                return matchSearch && matchStatus && matchKategori && matchPrioritas;
            });
        },
        toggleSelectAll() {
            if (this.selectAll) {
                this.bulkSelected = this.filteredRows.map(r => r.id);
            } else {
                this.bulkSelected = [];
            }
        }
      }">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"></div>

    <!-- Admin Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 w-64 bg-[#1E3A5F] transform transition-transform duration-300 z-30 lg:translate-x-0 lg:static flex flex-col flex-shrink-0">
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
            <a href="/preview/admin/dashboard" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="/preview/admin/laporan" class="flex items-center px-3 py-2.5 rounded-lg bg-white text-blue-700 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Manajemen Laporan
                <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-0.5">12</span>
            </a>
            <a href="/preview/admin/pengguna" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Manajemen Pengguna
            </a>
            <a href="/preview/admin/profil" class="flex items-center px-3 py-2.5 rounded-lg text-gray-300 hover:bg-blue-800 hover:text-white text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil Admin
            </a>
        </nav>
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
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between flex-shrink-0" x-data="{ userOpen: false }">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">Manajemen Laporan</h1>
            <div class="flex items-center space-x-4">
                <button class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div class="relative">
                    <button @click="userOpen = !userOpen" class="flex items-center space-x-2 p-1 rounded-lg hover:bg-gray-100">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center"><span class="text-white text-sm font-bold">A</span></div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
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
            <!-- Filter Bar -->
            <div class="bg-white rounded-xl shadow-sm p-5 mb-5">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-3">
                    <!-- Search -->
                    <div class="xl:col-span-2 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/></svg>
                        <input x-model="search" type="text" placeholder="Cari ID, pelapor, atau judul..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <!-- Status Filter -->
                    <select x-model="statusFilter" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <!-- Kategori Filter -->
                    <select x-model="kategoriFilter" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="Lampu">Lampu</option>
                        <option value="Air">Air</option>
                        <option value="AC">AC</option>
                        <option value="Toilet">Toilet</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <!-- Prioritas Filter -->
                    <select x-model="prioritasFilter" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Prioritas</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="flex items-center justify-between mt-3">
                    <button @click="search=''; statusFilter=''; kategoriFilter=''; prioritasFilter=''" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Reset Filter
                    </button>
                    <button class="flex items-center gap-2 bg-green-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Export CSV
                    </button>
                </div>
            </div>

            <!-- Bulk Actions -->
            <div x-show="bulkSelected.length > 0" class="bg-blue-50 border border-blue-200 rounded-xl px-5 py-3 mb-4 flex items-center justify-between">
                <span class="text-sm text-blue-700 font-medium"><span x-text="bulkSelected.length"></span> laporan dipilih</span>
                <button class="bg-green-600 text-white text-sm px-4 py-1.5 rounded-lg hover:bg-green-700">Tandai Selesai</button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    <input type="checkbox" x-model="selectAll" @change="toggleSelectAll()" class="rounded border-gray-300">
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">ID Laporan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Pelapor</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Prioritas</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="(row, index) in filteredRows" :key="row.id">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <input type="checkbox" :value="row.id" x-model="bulkSelected" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-3 text-gray-500" x-text="index + 1"></td>
                                    <td class="px-4 py-3 font-mono text-xs text-gray-500" x-text="'#' + row.id"></td>
                                    <td class="px-4 py-3 font-medium text-gray-800" x-text="row.pelapor"></td>
                                    <td class="px-4 py-3 text-gray-700" x-text="row.judul"></td>
                                    <td class="px-4 py-3 text-gray-600" x-text="row.kategori"></td>
                                    <td class="px-4 py-3 text-gray-600" x-text="row.lokasi"></td>
                                    <td class="px-4 py-3">
                                        <span :class="{
                                            'bg-red-100 text-red-700': row.prioritas === 'Tinggi',
                                            'bg-yellow-100 text-yellow-700': row.prioritas === 'Sedang',
                                            'bg-gray-100 text-gray-700': row.prioritas === 'Rendah'
                                        }" class="text-xs px-2 py-1 rounded-full font-medium" x-text="row.prioritas"></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span :class="{
                                            'bg-yellow-100 text-yellow-700': row.status === 'menunggu',
                                            'bg-blue-100 text-blue-700': row.status === 'diproses',
                                            'bg-green-100 text-green-700': row.status === 'selesai',
                                            'bg-red-100 text-red-700': row.status === 'ditolak'
                                        }" class="text-xs px-2 py-1 rounded-full font-medium capitalize" x-text="row.status"></span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500" x-text="row.tanggal"></td>
                                    <td class="px-4 py-3">
                                        <a href="/preview/admin/laporan/detail" class="border border-blue-600 text-blue-600 text-xs px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">Detail</a>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="filteredRows.length === 0">
                                <td colspan="11" class="px-6 py-10 text-center text-gray-400">
                                    <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Tidak ada laporan ditemukan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-500">Menampilkan <span x-text="filteredRows.length"></span> dari 10 laporan</p>
                    <div class="flex items-center gap-1">
                        <button class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50">‹</button>
                        <button class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg">1</button>
                        <button class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50">2</button>
                        <button class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50">›</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
