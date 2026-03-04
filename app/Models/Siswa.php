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
        'foto_profil',
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

    protected static function booted(): void
    {
        static::creating(function (self $siswa): void {
            if (blank($siswa->password)) {
                $siswa->password = 'password';
            }
        });
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'siswa_id');
    }
}
