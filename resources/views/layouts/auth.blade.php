<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? 'Masuk' }} - FixFacility</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="login">
        <div class="lf">
            <h1>FixFacility</h1>
            <p>Laporan kerusakan fasilitas kampus</p>
            <div class="hero">
                <h3>FASILITAS KAMPUS LEBIH TERAWAT</h3>
                <p>Laporkan kerusakan dan pantau proses tindak lanjutnya.</p>
            </div>
        </div>
        <div class="lr">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
