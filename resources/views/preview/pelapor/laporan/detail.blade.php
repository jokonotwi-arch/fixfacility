<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Laporan - FixFacility</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100" x-data="{ sidebarOpen: false, currentStatus: 'diproses' }">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Overlay -->
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
            <h1 class="text-xl font-semibold text-gray-800">Detail Laporan</h1>
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

        <main class="flex-1 overflow-y-auto p-6">
            <!-- Back + Preview switch -->
            <div class="flex items-center justify-between mb-6">
                <a href="/preview/pelapor/laporan" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-800 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Laporan
                </a>
                <!-- Demo status switcher (preview only) -->
                <div class="flex items-center space-x-2 text-xs text-gray-400">
                    <span>Preview status:</span>
                    <select x-model="currentStatus" class="border border-gray-200 rounded px-2 py-1 text-xs text-gray-600">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
            </div>

            <!-- Report Header Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="text-xs font-mono text-gray-400 bg-gray-100 px-2 py-0.5 rounded">#LPR-2024-011</span>
                            <span :class="{
                                'bg-yellow-100 text-yellow-800': currentStatus === 'menunggu',
                                'bg-blue-100 text-blue-800': currentStatus === 'diproses',
                                'bg-green-100 text-green-800': currentStatus === 'selesai',
                                'bg-red-100 text-red-800': currentStatus === 'ditolak'
                            }" class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold capitalize" x-text="currentStatus === 'menunggu' ? 'Menunggu' : currentStatus === 'diproses' ? 'Diproses' : currentStatus === 'selesai' ? 'Selesai' : 'Ditolak'"></span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Kebocoran Atap Ruang Rapat</h2>
                        <p class="text-sm text-gray-500 mt-1">Dibuat pada 15 November 2024 · 09:32 WIB</p>
                    </div>
                    <div class="shrink-0">
                        <span class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 text-xs font-medium rounded-lg">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                            Prioritas Tinggi
                        </span>
                    </div>
                </div>
            </div>

            <!-- Ditolak Alert -->
            <div x-show="currentStatus === 'ditolak'" class="bg-red-50 border border-red-200 rounded-xl p-5 mb-6">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-red-800 mb-1">Laporan Ditolak</h4>
                        <p class="text-sm text-red-700">Laporan ini tidak dapat diproses karena informasi yang diberikan tidak cukup detail. Mohon buat laporan baru dengan menyertakan foto kerusakan dan lokasi yang lebih spesifik.</p>
                        <p class="text-xs text-red-500 mt-2">Ditolak oleh: Ahmad Farid (Admin) · 16 Nov 2024, 14:20 WIB</p>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Detail + Photo + Description -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Info Detail -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-base font-semibold text-gray-800 mb-4">Informasi Laporan</h3>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Kategori</dt>
                                <dd class="text-sm font-medium text-gray-800">Kebocoran Air</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Lokasi</dt>
                                <dd class="text-sm font-medium text-gray-800">Gedung B, Lantai 2</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Pelapor</dt>
                                <dd class="text-sm font-medium text-gray-800">Budi Santoso</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Tanggal Lapor</dt>
                                <dd class="text-sm font-medium text-gray-800">15 November 2024</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Prioritas</dt>
                                <dd><span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">Tinggi</span></dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Terakhir Diperbarui</dt>
                                <dd class="text-sm font-medium text-gray-800">16 November 2024, 10:00</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Photo -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-base font-semibold text-gray-800 mb-4">Foto Laporan</h3>
                        <div class="bg-gray-100 rounded-xl h-56 flex flex-col items-center justify-center border-2 border-dashed border-gray-200">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-400">foto_laporan_LPR2024011.jpg</p>
                            <p class="text-xs text-gray-300 mt-1">1.2 MB · Diunggah 15 Nov 2024</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-base font-semibold text-gray-800 mb-3">Deskripsi Kerusakan</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Atap ruang rapat di lantai 2 Gedung B mengalami kebocoran yang cukup parah. Air menetes dari plafon setiap kali hujan turun, terutama di sudut ruangan dekat jendela. Sudah terjadi selama sekitar 2 minggu. Kebocoran ini menyebabkan lantai basah dan berpotensi menimbulkan bahaya keselamatan bagi pengguna ruangan. Beberapa peralatan elektronik di bawahnya juga terancam rusak jika tidak segera ditangani.
                        </p>
                    </div>
                </div>

                <!-- Right: Timeline + Admin Info -->
                <div class="space-y-6">
                    <!-- Timeline -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-base font-semibold text-gray-800 mb-5">Progres Laporan</h3>
                        <div class="relative">
                            <!-- Timeline line -->
                            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-100"></div>

                            <!-- Step: Menunggu -->
                            <div class="relative flex items-start mb-6">
                                <div class="relative z-10 w-8 h-8 rounded-full flex items-center justify-center shrink-0"
                                     :class="['menunggu','diproses','selesai','ditolak'].includes(currentStatus) ? 'bg-yellow-400' : 'bg-gray-200'">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-gray-800">Menunggu</p>
                                    <p class="text-xs text-gray-400 mt-0.5">15 Nov 2024, 09:32</p>
                                    <p class="text-xs text-gray-500 mt-1">Laporan diterima dan menunggu verifikasi</p>
                                </div>
                            </div>

                            <!-- Step: Diproses -->
                            <div class="relative flex items-start mb-6">
                                <div class="relative z-10 w-8 h-8 rounded-full flex items-center justify-center shrink-0"
                                     :class="['diproses','selesai'].includes(currentStatus) ? 'bg-blue-500' : 'bg-gray-200'">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold" :class="['diproses','selesai'].includes(currentStatus) ? 'text-gray-800' : 'text-gray-400'">Diproses</p>
                                    <p class="text-xs text-gray-400 mt-0.5" x-show="['diproses','selesai'].includes(currentStatus)">16 Nov 2024, 10:00</p>
                                    <p class="text-xs mt-1" :class="['diproses','selesai'].includes(currentStatus) ? 'text-gray-500' : 'text-gray-300'">Tim teknis sedang menangani kerusakan</p>
                                </div>
                            </div>

                            <!-- Step: Selesai atau Ditolak -->
                            <div class="relative flex items-start">
                                <div class="relative z-10 w-8 h-8 rounded-full flex items-center justify-center shrink-0"
                                     :class="currentStatus === 'selesai' ? 'bg-green-500' : currentStatus === 'ditolak' ? 'bg-red-500' : 'bg-gray-200'">
                                    <template x-if="currentStatus === 'selesai'">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </template>
                                    <template x-if="currentStatus === 'ditolak'">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </template>
                                    <template x-if="!['selesai','ditolak'].includes(currentStatus)">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </template>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold" :class="currentStatus === 'selesai' ? 'text-gray-800' : currentStatus === 'ditolak' ? 'text-red-700' : 'text-gray-400'"
                                       x-text="currentStatus === 'ditolak' ? 'Ditolak' : 'Selesai'"></p>
                                    <p class="text-xs text-gray-400 mt-0.5" x-show="['selesai','ditolak'].includes(currentStatus)">18 Nov 2024, 15:45</p>
                                    <p class="text-xs mt-1" :class="['selesai','ditolak'].includes(currentStatus) ? 'text-gray-500' : 'text-gray-300'"
                                       x-text="currentStatus === 'selesai' ? 'Perbaikan telah selesai dilakukan' : currentStatus === 'ditolak' ? 'Laporan tidak dapat diproses' : 'Belum diselesaikan'"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-base font-semibold text-gray-800 mb-4">Info Penanggung Jawab</h3>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center shrink-0">
                                <span class="text-white text-sm font-bold">AF</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Ahmad Farid</p>
                                <p class="text-xs text-gray-500">Admin Fasilitas</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-xs text-gray-500">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>ahmad.farid@fixfacility.id</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>+62 812-3456-7890</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 mb-1">Catatan Admin</p>
                            <p class="text-sm text-gray-600 italic">"Sudah ditugaskan ke tim plumbing. Dijadwalkan penanganan pada 17 November 2024."</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
