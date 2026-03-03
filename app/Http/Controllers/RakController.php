<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RakController extends Controller
{
    public function index()
    {
        $daftarRak = Rak::latest()->get();

        return view('admin.rak.index', compact('daftarRak'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_rak' => ['required', 'string', 'max:100', 'unique:rak,nomor_rak'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Rak::create($data);

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    public function edit(Rak $rak)
    {
        return view('admin.rak.edit', compact('rak'));
    }

    public function update(Request $request, Rak $rak)
    {
        $data = $request->validate([
            'nomor_rak' => ['required', 'string', 'max:100', Rule::unique('rak', 'nomor_rak')->ignore($rak->id)],
            'keterangan' => ['nullable', 'string'],
        ]);

        $rak->update($data);

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil diperbarui.');
    }

    public function destroy(Rak $rak)
    {
        $rak->delete();

        return redirect()->route('admin.rak.index')->with('success', 'Rak berhasil dihapus.');
    }
}
