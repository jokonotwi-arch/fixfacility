<?php

namespace App\Http\Controllers;

use App\Support\DummyData;
use Illuminate\Http\Request;

class PelaporController extends Controller
{
    /**
     * Tampilan Dashboard Pelapor
     */
    public function dashboard()
    {
        $stats = DummyData::getPelaporStats();
        $laporanList = DummyData::getLaporanList();
        $laporanTerbaru = array_slice($laporanList, 0, 3);

        return view('pelapor.dashboard', compact('stats', 'laporanTerbaru'));
    }

    /**
     * Tampilan Daftar Laporan Pelapor
     */
    public function index(Request $request)
    {
        $laporan = DummyData::getLaporanList();

        // Support testing state kosong melalui parameter ?empty=1
        if ($request->query('empty') == '1') {
            $laporan = [];
        }

        return view('pelapor.laporan.index', compact('laporan'));
    }

    /**
     * Tampilan Formulir Buat Laporan
     */
    public function create()
    {
        $formOptions = DummyData::getFormOptions();

        return view('pelapor.laporan.create', compact('formOptions'));
    }

    /**
     * Simpan Laporan (Dummy handler untuk form POST)
     */
    public function store(Request $request)
    {
        // Backend developer nantinya dapat menyambungkan penyimpanan data di sini
        return redirect()->route('pelapor.laporan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Tampilan Detail Laporan Pelapor
     */
    public function show(string $kode)
    {
        $laporan = DummyData::findLaporan($kode);

        if (!$laporan) {
            abort(404, 'Laporan tidak ditemukan');
        }

        return view('pelapor.laporan.show', compact('laporan'));
    }
}
