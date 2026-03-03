<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'petugas';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'petugas_id');
    }
}
