<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $daftarKategori = KategoriBuku::latest()->get();

        return view('admin.kategori.index', compact('daftarKategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategori_buku,nama_kategori'],
            'keterangan' => ['nullable', 'string'],
        ]);

        KategoriBuku::create($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriBuku $kategori_buku)
    {
        return view('admin.kategori.edit', ['kategori' => $kategori_buku]);
    }

    public function update(Request $request, KategoriBuku $kategori_buku)
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', Rule::unique('kategori_buku', 'nama_kategori')->ignore($kategori_buku->id)],
            'keterangan' => ['nullable', 'string'],
        ]);

        $kategori_buku->update($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriBuku $kategori_buku)
    {
        $kategori_buku->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
