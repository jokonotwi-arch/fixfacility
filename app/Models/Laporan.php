<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'kode',
        'user_id',
        'fasilitas_id',
        'kategori_id',
        'status_id',
        'judul',
        'lokasi',
        'deskripsi',
        'foto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fasilitas(): BelongsTo
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusLaporan::class, 'status_id');
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'laporan_id')->orderBy('created_at', 'asc')->orderBy('id', 'asc');
    }

    public function formatForView(): array
    {
        $statusNama = $this->status ? $this->status->nama : 'Menunggu';

        $timeline = [];
        if ($this->relationLoaded('riwayat') && $this->riwayat->isNotEmpty()) {
            foreach ($this->riwayat as $r) {
                $stNama = $r->status ? $r->status->nama : 'Status';
                $defaultJudul = $stNama === 'Menunggu'
                    ? 'Laporan dikirim'
                    : ($stNama === 'Diproses' ? 'Laporan diproses' : 'Selesai');

                $timeline[] = [
                    'judul' => $defaultJudul,
                    'keterangan' => $r->keterangan ?? ($r->created_at ? $r->created_at->translatedFormat('d M Y • H.i') : ''),
                    'aktif' => true,
                ];
            }
        } else {
            $timeline[] = [
                'judul' => 'Laporan dikirim',
                'keterangan' => $this->created_at ? $this->created_at->translatedFormat('d M Y • H.i') : '',
                'aktif' => true,
            ];
        }

        if ($statusNama === 'Menunggu' && count($timeline) === 1) {
            $timeline[] = [
                'judul' => 'Menunggu ditinjau',
                'keterangan' => 'Admin belum memberikan pembaruan.',
                'aktif' => false,
            ];
        }

        $lokasiSingkat = explode(',', $this->lokasi)[0];

        return [
            'id' => $this->id,
            'kode' => $this->kode,
            'judul' => $this->judul,
            'pelapor' => $this->user ? $this->user->name : '',
            'fasilitas' => $this->fasilitas ? $this->fasilitas->nama : '',
            'lokasi' => $this->lokasi,
            'lokasi_singkat' => $lokasiSingkat,
            'kategori' => $this->kategori ? $this->kategori->nama : '',
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->created_at ? $this->created_at->translatedFormat('d M Y') : '',
            'tanggal_lengkap' => $this->created_at ? $this->created_at->translatedFormat('d F Y') : '',
            'status' => $statusNama,
            'foto' => $this->foto,
            'timeline' => $timeline,
        ];
    }
}
