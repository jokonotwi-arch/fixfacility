<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusLaporan extends Model
{
    use HasFactory;

    protected $table = 'status_laporan';

    protected $fillable = [
        'nama',
        'urutan',
    ];

    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'status_id');
    }
}
