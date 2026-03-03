<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index()
    {
        $daftarPetugas = Petugas::latest()->get();

        return view('admin.petugas.index', compact('daftarPetugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:petugas,email'],
            'password' => ['nullable', 'string', 'min:6'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
        ]);

        $data['password'] = $data['password'] ?? 'password';

        Petugas::create($data);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit(Petugas $petugas)
    {
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, Petugas $petugas)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('petugas', 'email')->ignore($petugas->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'alamat' => ['nullable', 'string'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $petugas->update($data);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy(Petugas $petugas)
    {
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
