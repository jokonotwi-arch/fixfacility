<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - FixFacility</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <!-- Left Panel: Decorative -->
        <div class="md:w-5/12 bg-gradient-to-br from-blue-700 to-blue-900 p-10 flex-col justify-between hidden md:flex">
            <div>
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-white text-2xl font-bold">FixFacility</span>
                </div>
                <!-- Tagline -->
                <h2 class="text-white text-3xl font-bold mb-4">Bergabung dengan<br>FixFacility</h2>
                <p class="text-blue-200 text-lg">Daftarkan diri Anda dan mulai laporkan masalah fasilitas kampus dengan mudah.</p>
            </div>
            <!-- Feature points -->
            <div class="space-y-3">
                <div class="flex items-center text-blue-100">
                    <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm">Daftar gratis, mudah, dan cepat</span>
                </div>
                <div class="flex items-center text-blue-100">
                    <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm">Pantau laporan Anda secara real-time</span>
                </div>
                <div class="flex items-center text-blue-100">
                    <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm">Terima notifikasi penanganan laporan</span>
                </div>
            </div>
        </div>

        <!-- Right Panel: Register Form -->
        <div class="md:w-7/12 p-8 md:p-10 flex flex-col justify-center" x-data="{ role: 'pelapor', showPass: false, showConfirm: false }">
            <!-- Mobile logo -->
            <div class="flex items-center mb-5 md:hidden">
                <div class="w-9 h-9 bg-blue-700 rounded-xl flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="text-blue-700 text-xl font-bold">FixFacility</span>
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-1">Buat Akun Baru</h3>
            <p class="text-gray-500 mb-6">Isi data di bawah untuk mendaftar</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Role Selector (card-style) -->
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar sebagai</label>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Pelapor -->
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="pelapor" class="sr-only" x-model="role">
                            <div :class="role === 'pelapor' ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-600' : 'border-gray-200 bg-white hover:border-blue-300'"
                                 class="border-2 rounded-xl p-3 transition-all duration-200">
                                <div class="flex items-center space-x-2">
                                    <div :class="role === 'pelapor' ? 'bg-blue-600' : 'bg-gray-200'"
                                         class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p :class="role === 'pelapor' ? 'text-blue-700' : 'text-gray-700'"
                                           class="text-sm font-semibold">Pelapor</p>
                                        <p class="text-xs text-gray-400">Mahasiswa / Staf</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <!-- Admin -->
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="admin" class="sr-only" x-model="role">
                            <div :class="role === 'admin' ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-600' : 'border-gray-200 bg-white hover:border-blue-300'"
                                 class="border-2 rounded-xl p-3 transition-all duration-200">
                                <div class="flex items-center space-x-2">
                                    <div :class="role === 'admin' ? 'bg-blue-600' : 'bg-gray-200'"
                                         class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p :class="role === 'admin' ? 'text-blue-700' : 'text-gray-700'"
                                           class="text-sm font-semibold">Admin</p>
                                        <p class="text-xs text-gray-400">Pengelola fasilitas</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" required autofocus>
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="reg_email">Email</label>
                    <input type="email" id="reg_email" name="email" value="{{ old('email') }}" placeholder="email@example.com"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" required>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No. Telepon -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="phone">No. Telepon</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    @error('phone')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input :type="showPass ? 'text' : 'password'" name="password" placeholder="Min. 8 karakter"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 pr-11 text-sm" required>
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                            <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPass" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" placeholder="Ulangi password"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 pr-11 text-sm" required>
                        <button type="button" @click="showConfirm = !showConfirm" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                            <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start mb-5">
                    <input type="checkbox" id="terms" name="terms" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5" required>
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        Saya menyetujui <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Syarat & Ketentuan</a> dan <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Kebijakan Privasi</a>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-xl transition-colors duration-200">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Sudah punya akun?
                <a href="/preview/auth/login" class="text-blue-600 font-medium hover:text-blue-800">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>
