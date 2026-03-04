@extends('layouts.siswa', ['title' => 'Pengembalian Buku'])

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Pengembalian Buku</h2>
    <p class="mt-1 text-sm text-slate-600">Ajukan pengembalian untuk buku yang sedang dipinjam.</p>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">{{ session('error') }}</div>
@endif

<div class="overflow-x-auto rounded-xl border bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left">Kode</th>
                <th class="px-4 py-3 text-left">Buku</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Jatuh Tempo</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($daftarDipinjam as $item)
            <tr class="border-t align-top">
                <td class="px-4 py-3">{{ $item->kode_peminjaman }}</td>
                <td class="px-4 py-3">
                    <ul class="space-y-1">
                        @foreach($item->detailPeminjaman as $detail)
                            <li>{{ $detail->buku->judul ?? '-' }} ({{ $detail->qty }})</li>
                        @endforeach
                    </ul>
                </td>
                <td class="px-4 py-3">{{ ucfirst($item->status) }}</td>
                <td class="px-4 py-3">{{ optional($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                <td class="px-4 py-3">
                    @if($item->pengajuan_pengembalian)
                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Menunggu Proses Petugas</span>
                    @else
                        <form method="POST" action="{{ route('siswa.pengembalian.ajukan', $item) }}">
                            @csrf
                            <button type="submit" class="rounded-lg border border-sky-200 bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-700 hover:bg-sky-100">
                                Ajukan Pengembalian
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">Belum ada buku yang sedang dipinjam.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $daftarDipinjam->links() }}</div>
@endsection
