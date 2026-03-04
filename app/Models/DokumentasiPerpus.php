<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiPerpus extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi_perpus';

    protected $fillable = [
        'judul',
        'tanggal_kegiatan',
        'deskripsi',
        'foto',
        'urutan',
        'is_published',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'is_published' => 'boolean',
    ];
}
