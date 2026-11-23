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

            <div class="out">
                <button type="button" class="nav out" onclick="bukaModalLogout()">Keluar</button>
            </div>
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

    <!-- Modal Konfirmasi Logout -->
    <div class="mask" id="modal-konfirmasi-logout">
        <div class="mod">
            <div class="x" style="background: #f1f5f9; color: var(--tx);">!</div>
            <h2>Anda akan keluar, yakin?</h2>
            <p>Sesi login Anda akan diakhiri. Anda perlu memasukkan kredensial lagi untuk masuk.</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="acts">
                    <button type="button" class="btn gr" onclick="tutupModalLogout()">Batal</button>
                    <button type="submit" class="btn red">Yakin</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
