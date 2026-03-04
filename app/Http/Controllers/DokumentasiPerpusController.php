<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiPerpus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumentasiPerpusController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $daftarDokumentasi = DokumentasiPerpus::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($nested) use ($q) {
                    $nested->where('judul', 'like', "%{$q}%")
                        ->orWhere('deskripsi', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('tanggal_kegiatan')
            ->orderBy('urutan')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.dokumentasi.index', compact('daftarDokumentasi', 'q'));
    }

    public function show(DokumentasiPerpus $dokumentasi)
    {
        return view('admin.dokumentasi.show', compact('dokumentasi'));
    }

    public function create()
    {
        return view('admin.dokumentasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'tanggal_kegiatan' => ['nullable', 'date'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['urutan'] = (int) ($data['urutan'] ?? 0);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['judul']);

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
            'slug' => ['nullable', 'string', 'max:255'],
            'tanggal_kegiatan' => ['nullable', 'date'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['urutan'] = (int) ($data['urutan'] ?? 0);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['judul'], $dokumentasi->id);

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

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $baseSlug = $base !== '' ? $base : 'dokumentasi';
        $slug = $baseSlug;
        $counter = 1;

        while (
            DokumentasiPerpus::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function resolveSlug(?string $requestedSlug, string $title, ?int $ignoreId = null): string
    {
        $candidate = trim((string) $requestedSlug) !== '' ? (string) $requestedSlug : $title;

        return $this->generateUniqueSlug($candidate, $ignoreId);
    }
}
