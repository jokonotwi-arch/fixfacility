<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? 'Portal Pelapor' }} - FixFacility</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="app">
        <aside class="side">
            <div class="logo">FixFacility</div>
            <div class="sub">PORTAL PELAPOR</div>

            <x-sidebar-item :route="'pelapor.dashboard'" :active="request()->routeIs('pelapor.dashboard')">
                Dashboard
            </x-sidebar-item>

            <x-sidebar-item :route="'pelapor.laporan.create'" :active="request()->routeIs('pelapor.laporan.create')">
                Buat Laporan
            </x-sidebar-item>

            <x-sidebar-item :route="'pelapor.laporan.index'" :active="request()->routeIs('pelapor.laporan.index') || request()->routeIs('pelapor.laporan.show')">
                Daftar Laporan
            </x-sidebar-item>

            <form action="{{ route('login') }}" method="GET" class="out">
                <button type="submit" class="nav out">Keluar</button>
            </form>
        </aside>

        <main class="main">
            @if(isset($pageTitle))
                <div class="top">
                    <div>
                        <h1>{{ $pageTitle }}</h1>
                        @if(isset($pageSubtitle))
                            <p class="lead">{{ $pageSubtitle }}</p>
                        @endif
                    </div>
                    @if(isset($headerAction))
                        <div>
                            {!! $headerAction !!}
                        </div>
                    @endif
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
