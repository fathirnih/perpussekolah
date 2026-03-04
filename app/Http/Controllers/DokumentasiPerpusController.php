<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiPerpus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiPerpusController extends Controller
{
    public function index()
    {
        $daftarDokumentasi = DokumentasiPerpus::query()
            ->orderByDesc('tanggal_kegiatan')
            ->orderBy('urutan')
            ->latest()
            ->get();

        return view('admin.dokumentasi.index', compact('daftarDokumentasi'));
    }

    public function create()
    {
        return view('admin.dokumentasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_kegiatan' => ['nullable', 'date'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['urutan'] = (int) ($data['urutan'] ?? 0);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokumentasi-perpus', 'public');
        }

        DokumentasiPerpus::create($data);

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    public function edit(DokumentasiPerpus $dokumentasi)
    {
        return view('admin.dokumentasi.edit', compact('dokumentasi'));
    }

    public function update(Request $request, DokumentasiPerpus $dokumentasi)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_kegiatan' => ['nullable', 'date'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['urutan'] = (int) ($data['urutan'] ?? 0);

        if ($request->hasFile('foto')) {
            if ($dokumentasi->foto) {
                Storage::disk('public')->delete($dokumentasi->foto);
            }

            $data['foto'] = $request->file('foto')->store('dokumentasi-perpus', 'public');
        }

        $dokumentasi->update($data);

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy(DokumentasiPerpus $dokumentasi)
    {
        if ($dokumentasi->foto) {
            Storage::disk('public')->delete($dokumentasi->foto);
        }

        $dokumentasi->delete();

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
