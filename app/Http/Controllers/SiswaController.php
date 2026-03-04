<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $daftarSiswa = Siswa::with('kelas')->latest()->get();

        return view('admin.siswa.index', compact('daftarSiswa'));
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
            'is_registered' => ['nullable', 'boolean'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
        ]);

        $data['is_registered'] = (bool) ($data['is_registered'] ?? false);
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
            'is_registered' => ['nullable', 'boolean'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
        ]);

        $data['is_registered'] = (bool) ($data['is_registered'] ?? false);
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
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
