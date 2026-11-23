<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\RiwayatStatus;
use App\Models\StatusLaporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Tampilan Dashboard Admin
     */
    public function dashboard()
    {
        $total = Laporan::count();
        $menunggu = Laporan::whereHas('status', fn ($q) => $q->where('nama', 'Menunggu'))->count();
        $diproses = Laporan::whereHas('status', fn ($q) => $q->where('nama', 'Diproses'))->count();
        $selesai = Laporan::whereHas('status', fn ($q) => $q->where('nama', 'Selesai'))->count();

        $stats = [
            [
                'label' => 'Total Laporan',
                'value' => $total,
                'subtext' => 'Seluruh laporan masuk',
            ],
            [
                'label' => 'Menunggu',
                'value' => $menunggu,
                'subtext' => 'Perlu ditinjau',
            ],
            [
                'label' => 'Diproses',
                'value' => $diproses,
                'subtext' => 'Sedang ditangani',
            ],
            [
                'label' => 'Selesai',
                'value' => $selesai,
                'subtext' => 'Sudah ditindaklanjuti',
            ],
        ];

        $max = $total > 0 ? $total : 1;
        $pctMenunggu = round(($menunggu / $max) * 100, 1);
        $pctDiproses = round(($diproses / $max) * 100, 1);
        $pctSelesai = round(($selesai / $max) * 100, 1);

        $statusBreakdown = [
            [
                'label' => 'Menunggu',
                'value' => $menunggu,
                'color' => '#b8700a',
                'max' => $max,
                'percent' => number_format($pctMenunggu, 1, ',', '.') . '%',
            ],
            [
                'label' => 'Diproses',
                'value' => $diproses,
                'color' => '#2563eb',
                'max' => $max,
                'percent' => number_format($pctDiproses, 1, ',', '.') . '%',
            ],
            [
                'label' => 'Selesai',
                'value' => $selesai,
                'color' => '#16905a',
                'max' => $max,
                'percent' => number_format($pctSelesai, 1, ',', '.') . '%',
            ],
        ];

        $laporanTerbaru = Laporan::with(['user', 'fasilitas', 'kategori', 'status'])
            ->latest('id')
            ->take(5)
            ->get()
            ->map(fn ($item) => $item->formatForView())
            ->all();

        return view('admin.dashboard', compact('stats', 'statusBreakdown', 'laporanTerbaru'));
    }

    /**
     * Tampilan Semua Laporan Admin (dengan filter, pencarian, dan pagination yang mempertahankan query string)
     */
    public function laporanIndex(Request $request)
    {
        $query = Laporan::with(['user', 'fasilitas', 'kategori', 'status']);

        // Pencarian (judul, kode, deskripsi, pelapor)
        if ($request->filled('q')) {
            $q = trim($request->query('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('kode', 'like', "%{$q}%")
                    ->orWhere('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($uq) use ($q) {
                        $uq->where('name', 'like', "%{$q}%")
                           ->orWhere('nim_nip', 'like', "%{$q}%");
                    });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $st = trim($request->query('status'));
            $query->whereHas('status', fn ($sq) => $sq->where('nama', $st));
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $kat = trim($request->query('kategori'));
            $query->whereHas('kategori', fn ($kq) => $kq->where('nama', $kat));
        }

        $totalCount = Laporan::count();

        $paginator = $query->latest('id')->paginate(15)->withQueryString();
        $laporan = $paginator->through(fn ($item) => $item->formatForView());

        $formOptions = [
            'status' => StatusLaporan::orderBy('urutan')->pluck('nama')->all(),
            'kategori' => Kategori::orderBy('id')->pluck('nama')->all(),
        ];

        return view('admin.laporan.index', compact('laporan', 'totalCount', 'formOptions'));
    }

    /**
     * Tampilan Detail Laporan Admin (update status + modal konfirmasi hapus)
     */
    public function laporanShow(string $kode)
    {
        $laporanModel = Laporan::with(['user', 'fasilitas', 'kategori', 'status', 'riwayat.status', 'riwayat.pengubah'])
            ->where('kode', $kode)
            ->firstOrFail();

        $laporan = $laporanModel->formatForView();
        $formOptions = [
            'status' => StatusLaporan::orderBy('urutan')->pluck('nama')->all(),
        ];

        return view('admin.laporan.show', compact('laporan', 'formOptions'));
    }

    /**
     * Pembaruan Status Laporan
     */
    public function laporanUpdate(Request $request, string $kode)
    {
        $request->validate([
            'status' => ['required', 'string', 'exists:status_laporan,nama'],
        ], [
            'status.required' => 'Status laporan wajib dipilih.',
            'status.exists' => 'Status laporan yang dipilih tidak valid.',
        ]);

        $laporan = Laporan::where('kode', $kode)->firstOrFail();
        $statusBaru = StatusLaporan::where('nama', $request->status)->firstOrFail();

        DB::transaction(function () use ($laporan, $statusBaru) {
            $laporan->status_id = $statusBaru->id;
            $laporan->save();

            $keteranganMap = [
                'Menunggu' => 'Laporan dikirim',
                'Diproses' => 'Sedang ditangani petugas',
                'Selesai'  => 'Kerusakan telah ditindaklanjuti',
            ];

            RiwayatStatus::create([
                'laporan_id' => $laporan->id,
                'status_id' => $statusBaru->id,
                'diubah_oleh' => Auth::id(),
                'keterangan' => $keteranganMap[$statusBaru->nama] ?? 'Status diperbarui oleh admin',
                'created_at' => now(),
            ]);
        });

        return redirect()->route('admin.laporan.show', $kode)
            ->with('success', 'Status laporan berhasil diperbarui!');
    }

    /**
     * Hapus Laporan beserta file fotonya
     */
    public function laporanDestroy(string $kode)
    {
        $laporan = Laporan::where('kode', $kode)->firstOrFail();

        // Hapus file foto dari storage jika ada
        if (!empty($laporan->foto) && Storage::disk('public')->exists($laporan->foto)) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', "Laporan {$kode} berhasil dihapus!");
    }

    /**
     * Tampilan Rekap Laporan (Kompatibel SQLite dan MySQL tanpa fungsi tanggal spesifik DB)
     */
    public function rekap(Request $request)
    {
        $periodeParam = $request->query('periode');

        $latestReport = Laporan::latest('created_at')->first();
        $baseDate = $latestReport && $latestReport->created_at ? $latestReport->created_at->copy() : now();

        // Susun pilihan periode (6 bulan ke belakang)
        $periodePilihan = [];
        for ($i = 0; $i < 6; $i++) {
            $dt = $baseDate->copy()->subMonths($i);
            $pStr = $dt->translatedFormat('F Y');
            $periodePilihan[$pStr] = [
                'start' => $dt->copy()->startOfMonth()->startOfDay(),
                'end' => $dt->copy()->endOfMonth()->endOfDay(),
            ];
        }

        $selectedPeriode = $periodeParam && isset($periodePilihan[$periodeParam])
            ? $periodeParam
            : array_key_first($periodePilihan);

        $range = $periodePilihan[$selectedPeriode];
        $startDate = $range['start'];
        $endDate = $range['end'];

        // Ambil seluruh laporan dalam rentang tanggal standar
        $laporanPeriode = Laporan::with(['status', 'kategori'])
            ->where('created_at', '>=', $startDate->toDateTimeString())
            ->where('created_at', '<=', $endDate->toDateTimeString())
            ->get();

        $totalPeriode = $laporanPeriode->count();
        $menungguPeriode = $laporanPeriode->filter(fn ($l) => $l->status && $l->status->nama === 'Menunggu')->count();
        $diprosesPeriode = $laporanPeriode->filter(fn ($l) => $l->status && $l->status->nama === 'Diproses')->count();
        $selesaiPeriode = $laporanPeriode->filter(fn ($l) => $l->status && $l->status->nama === 'Selesai')->count();

        $pctSelesai = $totalPeriode > 0 ? round(($selesaiPeriode / $totalPeriode) * 100, 1) : 0;
        $tingkatPenyelesaian = number_format($pctSelesai, 1, ',', '.') . '%';

        $statsCards = [
            [
                'label' => 'Total Laporan',
                'value' => $totalPeriode,
                'subtext' => 'Semua laporan masuk',
            ],
            [
                'label' => 'Menunggu',
                'value' => $menungguPeriode,
                'subtext' => $totalPeriode > 0 ? number_format(($menungguPeriode / $totalPeriode) * 100, 1, ',', '.') . '% dari total' : '0% dari total',
            ],
            [
                'label' => 'Diproses',
                'value' => $diprosesPeriode,
                'subtext' => $totalPeriode > 0 ? number_format(($diprosesPeriode / $totalPeriode) * 100, 1, ',', '.') . '% dari total' : '0% dari total',
            ],
            [
                'label' => 'Selesai',
                'value' => $selesaiPeriode,
                'subtext' => $totalPeriode > 0 ? number_format(($selesaiPeriode / $totalPeriode) * 100, 1, ',', '.') . '% dari total' : '0% dari total',
            ],
        ];

        $maxStatus = max(1, $menungguPeriode, $diprosesPeriode, $selesaiPeriode);
        $statusBreakdown = [
            [
                'label' => 'Menunggu',
                'value' => $menungguPeriode,
                'color' => '#b8700a',
                'max' => $maxStatus,
            ],
            [
                'label' => 'Diproses',
                'value' => $diprosesPeriode,
                'color' => '#2563eb',
                'max' => $maxStatus,
            ],
            [
                'label' => 'Selesai',
                'value' => $selesaiPeriode,
                'color' => '#16905a',
                'max' => $maxStatus,
            ],
        ];

        // Laporan per kategori
        $semuaKategori = Kategori::all();
        $kategoriStats = [];
        $topKategoriNama = '-';
        $topKategoriCount = -1;

        foreach ($semuaKategori as $kat) {
            $cnt = $laporanPeriode->filter(fn ($l) => $l->kategori_id === $kat->id)->count();
            if ($cnt > $topKategoriCount) {
                $topKategoriCount = $cnt;
                $topKategoriNama = $kat->nama;
            }
            $kategoriStats[] = [
                'label' => $kat->nama,
                'value' => $cnt,
                'color' => '#2563eb',
            ];
        }

        $maxKategori = max(array_merge([1], array_column($kategoriStats, 'value')));
        foreach ($kategoriStats as &$ks) {
            $ks['max'] = $maxKategori;
        }

        $rekapSummary = [
            'periode' => $selectedPeriode,
            'periode_pilihan' => array_keys($periodePilihan),
            'tanggal_update' => now()->translatedFormat('d M Y'),
            'kategori_terbanyak' => $topKategoriNama,
            'tingkat_penyelesaian' => $tingkatPenyelesaian,
            'stats_cards' => $statsCards,
        ];

        return view('admin.rekap', compact('rekapSummary', 'statusBreakdown', 'kategoriStats'));
    }
}
