<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? 'Admin Panel' }} - FixFacility</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="app">
        <aside class="side">
            <div class="logo">FixFacility</div>
            <div class="sub">ADMIN PANEL</div>

            <x-sidebar-item :route="'admin.dashboard'" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-sidebar-item>

            <x-sidebar-item :route="'admin.laporan.index'" :active="request()->routeIs('admin.laporan.index') || request()->routeIs('admin.laporan.show')">
                Semua Laporan
            </x-sidebar-item>

            <x-sidebar-item :route="'admin.rekap'" :active="request()->routeIs('admin.rekap')">
                Rekap Laporan
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
