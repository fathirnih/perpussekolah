<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $q = trim((string) request()->query('q', ''));
        $kelasId = trim((string) request()->query('kelas_id', ''));

        $daftarKelas = Kelas::query()->orderBy('nama_kelas')->get(['id', 'nama_kelas']);

        $daftarSiswa = Siswa::with('kelas')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($nested) use ($q) {
                    $nested->where('nama', 'like', "%{$q}%")
                        ->orWhere('nisn', 'like', "%{$q}%");
                });
            })
            ->when($kelasId !== '', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.siswa.index', compact('daftarSiswa', 'q', 'kelasId', 'daftarKelas'));
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('kelas');

        return view('admin.siswa.show', compact('siswa'));
    }

    public function create()
    {
        $daftarKelas = Kelas::query()->orderBy('nama_kelas')->get(['id', 'nama_kelas']);

        return view('admin.siswa.create', compact('daftarKelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nisn' => ['required', 'digits:10', 'unique:siswa,nisn'],
            'nama' => ['required', 'string', 'max:255'],
            'kelas_id' => ['required', 'integer', 'exists:kelas,id'],
            'email' => ['nullable', 'email', 'max:255', 'unique:siswa,email'],
            'password' => ['nullable', 'string', 'min:6'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('siswa', 'public');
        }

        Siswa::create($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $daftarKelas = Kelas::query()->orderBy('nama_kelas')->get(['id', 'nama_kelas']);

        return view('admin.siswa.edit', compact('siswa', 'daftarKelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nisn' => ['required', 'digits:10', 'unique:siswa,nisn,' . $siswa->id],
            'nama' => ['required', 'string', 'max:255'],
            'kelas_id' => ['required', 'integer', 'exists:kelas,id'],
            'email' => ['nullable', 'email', 'max:255', 'unique:siswa,email,' . $siswa->id],
            'password' => ['nullable', 'string', 'min:6'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }
        if ($request->hasFile('foto_profil')) {
            if ($siswa->foto_profil) {
                Storage::disk('public')->delete($siswa->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('siswa', 'public');
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
