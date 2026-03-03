<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'buku_id',
        'qty',
        'tanggal_kembali',
        'status_item',
        'denda',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kembali' => 'date',
            'denda' => 'decimal:2',
        ];
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
