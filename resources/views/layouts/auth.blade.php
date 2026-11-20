<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FixFacility') }} - {{ $title ?? 'Autentikasi' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 antialiased min-h-screen">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Left Panel: Decorative -->
        <div class="hidden md:flex md:w-1/2 lg:w-5/12 relative overflow-hidden"
             style="background: linear-gradient(135deg, #1E3A5F 0%, #1D4ED8 60%, #3B82F6 100%);">

            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="200" cy="200" r="150" stroke="white" stroke-width="2"/>
                    <circle cx="200" cy="200" r="100" stroke="white" stroke-width="2"/>
                    <circle cx="200" cy="200" r="50" stroke="white" stroke-width="2"/>
                    <line x1="0" y1="200" x2="400" y2="200" stroke="white" stroke-width="1"/>
                    <line x1="200" y1="0" x2="200" y2="400" stroke="white" stroke-width="1"/>
                </svg>
            </div>

            <!-- Floating cards decoration -->
            <div class="absolute top-20 right-10 w-20 h-20 bg-white/10 rounded-2xl rotate-12 backdrop-blur-sm"></div>
            <div class="absolute bottom-32 left-10 w-16 h-16 bg-white/10 rounded-xl -rotate-6 backdrop-blur-sm"></div>
            <div class="absolute top-1/2 right-20 w-12 h-12 bg-white/10 rounded-lg rotate-45 backdrop-blur-sm"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col items-center justify-center w-full px-10 py-16 text-white text-center">

                <!-- Logo -->
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight">FixFacility</span>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4">
                    Laporkan Kerusakan<br>
                    <span class="text-blue-200">Fasilitas Kampus</span>
                </h1>

                <p class="text-blue-100/80 text-base leading-relaxed max-w-sm mb-10">
                    Platform pelaporan fasilitas yang mudah, cepat, dan transparan. Bantu kami menjaga lingkungan kampus tetap optimal.
                </p>

                <!-- Feature list -->
                <div class="space-y-3 text-sm text-blue-100/90 w-full max-w-xs">
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span>Pelaporan mudah dengan foto</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span>Pantau status laporan real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span>Notifikasi penanganan cepat</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: Form -->
        <div class="flex-1 flex flex-col items-center justify-center px-6 py-12 md:px-10 lg:px-16 bg-white">

            <!-- Mobile logo -->
            <div class="flex md:hidden items-center gap-2 mb-8">
                <div class="w-9 h-9 bg-blue-700 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-slate-800">FixFacility</span>
            </div>

            <!-- Form slot -->
            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>

            <!-- Footer note -->
            <p class="mt-10 text-xs text-slate-400 text-center">
                &copy; {{ date('Y') }} FixFacility — Sistem Pelaporan Fasilitas Kampus
            </p>
        </div>
    </div>

</body>
</html>
