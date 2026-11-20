<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - FixFacility</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-900 to-blue-700 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[500px]">

        <!-- Left Panel: Decorative -->
        <div class="md:w-1/2 bg-gradient-to-br from-blue-700 to-blue-900 p-10 flex-col justify-between hidden md:flex">
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
                <h2 class="text-white text-3xl font-bold mb-4">Laporkan Masalah<br>Fasilitas Kampus</h2>
                <p class="text-blue-200 text-lg">Platform pelaporan kerusakan fasilitas yang cepat, mudah, dan terpantau.</p>
            </div>
            <!-- Feature points -->
            <div class="space-y-3">
                <div class="flex items-center text-blue-100">
                    <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm">Laporan terpantau real-time</span>
                </div>
                <div class="flex items-center text-blue-100">
                    <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm">Notifikasi status laporan</span>
                </div>
                <div class="flex items-center text-blue-100">
                    <div class="w-6 h-6 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm">Penanganan cepat oleh admin</span>
                </div>
            </div>
        </div>

        <!-- Right Panel: Login Form -->
        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <!-- Mobile logo -->
            <div class="flex items-center mb-6 md:hidden">
                <div class="w-9 h-9 bg-blue-700 rounded-xl flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="text-blue-700 text-xl font-bold">FixFacility</span>
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang!</h3>
            <p class="text-gray-500 mb-8">Masuk ke akun FixFacility Anda</p>

            <!-- Form posts to real login route -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@example.com"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required autofocus>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password with toggle -->
                <div class="mb-6" x-data="{ show: false }">
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">Lupa Password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 pr-12" required>
                        <button type="button" @click="show = !show" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-xl transition-colors duration-200">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Belum punya akun?
                <a href="/preview/auth/register" class="text-blue-600 font-medium hover:text-blue-800">Daftar di sini</a>
            </p>

            <!-- Preview shortcuts -->
            <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-500 font-medium mb-2">🔗 Preview Halaman:</p>
                <div class="flex flex-wrap gap-2">
                    <a href="/preview/pelapor/dashboard" class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full hover:bg-blue-200">Dashboard Pelapor</a>
                    <a href="/preview/admin/dashboard" class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full hover:bg-orange-200">Dashboard Admin</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
