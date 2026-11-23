<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaporanRequest;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\RiwayatStatus;
use App\Models\StatusLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelaporController extends Controller
{
    /**
     * Tampilan Dashboard Pelapor
     */
    public function dashboard()
    {
        $userId = Auth::id();

        $total = Laporan::where('user_id', $userId)->count();
        $menunggu = Laporan::where('user_id', $userId)
            ->whereHas('status', fn ($q) => $q->where('nama', 'Menunggu'))
            ->count();
        $diproses = Laporan::where('user_id', $userId)
            ->whereHas('status', fn ($q) => $q->where('nama', 'Diproses'))
            ->count();
        $selesai = Laporan::where('user_id', $userId)
            ->whereHas('status', fn ($q) => $q->where('nama', 'Selesai'))
            ->count();

        $stats = [
            [
                'label' => 'Total Laporan',
                'value' => sprintf('%02d', $total),
                'subtext' => 'Semua laporan kamu',
            ],
            [
                'label' => 'Menunggu',
                'value' => sprintf('%02d', $menunggu),
                'subtext' => 'Belum ditinjau',
            ],
            [
                'label' => 'Diproses',
                'value' => sprintf('%02d', $diproses),
                'subtext' => 'Sedang ditangani',
            ],
            [
                'label' => 'Selesai',
                'value' => sprintf('%02d', $selesai),
                'subtext' => 'Telah ditindaklanjuti',
            ],
        ];

        $laporanTerbaru = Laporan::with(['fasilitas', 'status'])
            ->where('user_id', $userId)
            ->latest('id')
            ->take(3)
            ->get()
            ->map(fn ($item) => $item->formatForView())
            ->all();

        return view('pelapor.dashboard', compact('stats', 'laporanTerbaru'));
    }

    /**
     * Tampilan Daftar Laporan Pelapor
     */
    public function index(Request $request)
    {
        $laporan = Laporan::with(['fasilitas', 'kategori', 'status'])
            ->where('user_id', Auth::id())
            ->latest('id')
            ->get()
            ->map(fn ($item) => $item->formatForView())
            ->all();

        return view('pelapor.laporan.index', compact('laporan'));
    }

    /**
     * Tampilan Formulir Buat Laporan
     */
    public function create()
    {
        $formOptions = [
            'fasilitas' => Fasilitas::orderBy('id')->pluck('nama')->all(),
            'kategori' => Kategori::orderBy('id')->pluck('nama')->all(),
        ];

        return view('pelapor.laporan.create', compact('formOptions'));
    }

    /**
     * Simpan Laporan dengan transaksi dan kode unik FF-xxx
     */
    public function store(StoreLaporanRequest $request)
    {
        $user = $request->user();

        $laporan = DB::transaction(function () use ($request, $user) {
            // Ambil nomor kode terbesar saat ini untuk mencegah race condition
            $allKodes = Laporan::lockForUpdate()->pluck('kode');
            $maxNum = 0;
            foreach ($allKodes as $k) {
                if (preg_match('/FF-(\d+)/', $k, $matches)) {
                    $num = (int) $matches[1];
                    if ($num > $maxNum) {
                        $maxNum = $num;
                    }
                }
            }
            $nextNum = $maxNum + 1;
            $kode = sprintf('FF-%03d', $nextNum);

            // Simpan file foto bukti ke storage publik
            $path = $request->file('foto')->store('laporan', 'public');

            $fasilitasId = Fasilitas::where('nama', $request->fasilitas)->value('id');
            $kategoriId = Kategori::where('nama', $request->kategori)->value('id');
            $statusMenungguId = StatusLaporan::where('nama', 'Menunggu')->value('id');

            $newLaporan = Laporan::create([
                'kode' => $kode,
                'user_id' => $user->id,
                'fasilitas_id' => $fasilitasId,
                'kategori_id' => $kategoriId,
                'status_id' => $statusMenungguId,
                'judul' => $request->judul,
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi,
                'foto' => $path,
            ]);

            RiwayatStatus::create([
                'laporan_id' => $newLaporan->id,
                'status_id' => $statusMenungguId,
                'diubah_oleh' => null,
                'keterangan' => 'Laporan dikirim',
                'created_at' => now(),
            ]);

            return $newLaporan;
        });

        return redirect()->route('pelapor.laporan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Tampilan Detail Laporan Pelapor
     */
    public function show(string $kode)
    {
        $laporanModel = Laporan::with(['user', 'fasilitas', 'kategori', 'status', 'riwayat.status', 'riwayat.pengubah'])
            ->where('kode', $kode)
            ->firstOrFail();

        // Pelapor hanya bisa melihat laporan miliknya sendiri
        if ($laporanModel->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak untuk melihat laporan ini.');
        }

        $laporan = $laporanModel->formatForView();

        return view('pelapor.laporan.show', compact('laporan'));
    }
}
