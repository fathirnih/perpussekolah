<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarBuku = Buku::with(['kategori', 'rak'])->latest()->get();

        return view('admin.buku.index', compact('daftarBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriBuku = KategoriBuku::orderBy('nama_kategori')->get();
        $rakBuku = Rak::orderBy('nomor_rak')->get();

        return view('admin.buku.create', compact('kategoriBuku', 'rakBuku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_buku' => ['required', 'string', 'max:100', 'unique:buku,kode_buku'],
            'isbn' => ['nullable', 'string', 'max:100'],
            'judul' => ['required', 'string', 'max:255'],
            'sinopsis' => ['nullable', 'string'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'tahun_terbit' => ['nullable', 'integer', 'between:1900,2100'],
            'kategori_buku_id' => ['required', 'exists:kategori_buku,id'],
            'rak_id' => ['required', 'exists:rak,id'],
            'stok_total' => ['required', 'integer', 'min:0'],
            'stok_tersedia' => ['required', 'integer', 'min:0'],
            'gambar_sampul' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar_sampul')) {
            $data['gambar_sampul'] = $request->file('gambar_sampul')->store('buku', 'public');
        }

        Buku::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        $buku->load(['kategori', 'rak']);

        return view('admin.buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategoriBuku = KategoriBuku::orderBy('nama_kategori')->get();
        $rakBuku = Rak::orderBy('nomor_rak')->get();

        return view('admin.buku.edit', compact('buku', 'kategoriBuku', 'rakBuku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'kode_buku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('buku', 'kode_buku')->ignore($buku->id),
            ],
            'isbn' => ['nullable', 'string', 'max:100'],
            'judul' => ['required', 'string', 'max:255'],
            'sinopsis' => ['nullable', 'string'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'tahun_terbit' => ['nullable', 'integer', 'between:1900,2100'],
            'kategori_buku_id' => ['required', 'exists:kategori_buku,id'],
            'rak_id' => ['required', 'exists:rak,id'],
            'stok_total' => ['required', 'integer', 'min:0'],
            'stok_tersedia' => ['required', 'integer', 'min:0'],
            'gambar_sampul' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar_sampul')) {
            if ($buku->gambar_sampul) {
                Storage::disk('public')->delete($buku->gambar_sampul);
            }

            $data['gambar_sampul'] = $request->file('gambar_sampul')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if ($buku->gambar_sampul) {
            Storage::disk('public')->delete($buku->gambar_sampul);
        }

        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
