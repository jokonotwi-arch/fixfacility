<?php

namespace App\Http\Controllers;

use App\Support\DummyData;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilan Dashboard Admin
     */
    public function dashboard()
    {
        $stats = DummyData::getAdminStats();
        $statusBreakdown = DummyData::getStatusBreakdown();
        $laporanTerbaru = DummyData::getLaporanList();

        return view('admin.dashboard', compact('stats', 'statusBreakdown', 'laporanTerbaru'));
    }

    /**
     * Tampilan Semua Laporan Admin (dengan filter dan pencarian)
     */
    public function laporanIndex(Request $request)
    {
        $all = DummyData::getLaporanList();
        $q = strtolower(trim($request->query('q', '')));
        $status = $request->query('status', '');
        $kategori = $request->query('kategori', '');

        $laporan = array_filter($all, function ($item) use ($q, $status, $kategori) {
            $matchQuery = empty($q) ||
                str_contains(strtolower($item['kode']), $q) ||
                str_contains(strtolower($item['judul']), $q) ||
                str_contains(strtolower($item['pelapor']), $q);

            $matchStatus = empty($status) || $item['status'] === $status;
            $matchKategori = empty($kategori) || $item['kategori'] === $kategori;

            return $matchQuery && $matchStatus && $matchKategori;
        });

        $totalCount = 128; // Angka statistik tercatat dari desain

        return view('admin.laporan.index', compact('laporan', 'totalCount'));
    }

    /**
     * Tampilan Detail Laporan Admin (update status + modal konfirmasi hapus)
     */
    public function laporanShow(string $kode)
    {
        $laporan = DummyData::findLaporan($kode);
        $formOptions = DummyData::getFormOptions();

        if (!$laporan) {
            abort(404, 'Laporan tidak ditemukan');
        }

        return view('admin.laporan.show', compact('laporan', 'formOptions'));
    }

    /**
     * Pembaruan Status Laporan (Dummy handler)
     */
    public function laporanUpdate(Request $request, string $kode)
    {
        // Backend developer nantinya menghubungkan perubahan status di database
        return redirect()->route('admin.laporan.show', $kode)
            ->with('success', 'Status laporan berhasil diperbarui!');
    }

    /**
     * Hapus Laporan (Dummy handler)
     */
    public function laporanDestroy(string $kode)
    {
        // Backend developer nantinya menghubungkan penghapusan data di database
        return redirect()->route('admin.laporan.index')
            ->with('success', "Laporan $kode berhasil dihapus!");
    }

    /**
     * Tampilan Rekap Laporan
     */
    public function rekap()
    {
        $rekapSummary = DummyData::getRekapSummary();
        $statusBreakdown = DummyData::getStatusBreakdown();
        $kategoriStats = DummyData::getKategoriStats();

        return view('admin.rekap', compact('rekapSummary', 'statusBreakdown', 'kategoriStats'));
    }
}
