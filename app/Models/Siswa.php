<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';

    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'email',
        'password',
        'is_registered',
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
            'is_registered' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'siswa_id');
    }
}
