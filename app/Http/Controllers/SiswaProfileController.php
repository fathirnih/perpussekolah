<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaProfileController extends Controller
{
    public function edit(Request $request)
    {
        $auth = $request->session()->get('siswa_auth');
        $siswa = Siswa::findOrFail($auth['id']);

        return view('siswa.profil', compact('siswa', 'auth'));
    }

    public function update(Request $request)
    {
        $auth = $request->session()->get('siswa_auth');
        $siswa = Siswa::findOrFail($auth['id']);

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255', 'unique:siswa,email,' . $siswa->id],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:6'],
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

        $request->session()->put('siswa_auth', [
            'id' => $siswa->id,
            'nama' => $siswa->nama,
            'nisn' => $siswa->nisn,
            'email' => $siswa->email,
            'kelas' => $siswa->kelas,
        ]);

        return back()->with('success', 'Profil siswa berhasil diperbarui.');
    }
}
