<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'isbn',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_buku_id',
        'rak_id',
        'stok_total',
        'stok_tersedia',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'rak_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'buku_id');
    }
}
