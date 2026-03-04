@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Detail Buku', 'activeMenu' => $activeMenu ?? 'katalog'])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    <div class="mb-6">
        <a
            href="{{ $kembaliUrl ?? route('katalog') }}"
            class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
        >
            Kembali ke Katalog
        </a>
    </div>

    <div class="grid gap-6 md:grid-cols-[220px_1fr]">
        <div>
            @if(!empty($buku->gambar_sampul))
                <img
                    src="{{ asset('storage/' . $buku->gambar_sampul) }}"
                    alt="Sampul {{ $buku->judul }}"
                    class="h-80 w-full rounded-xl border border-slate-200 object-cover"
                >
            @else
                <div class="flex h-80 w-full items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-sm text-slate-400">
                    No Cover
                </div>
            @endif
        </div>

        <div>
            <h1 class="text-2xl font-black text-sky-900">{{ $buku->judul }}</h1>
            <p class="mt-2 text-sm text-slate-600">{{ $buku->penulis }}</p>

            <div class="mt-5 grid gap-3 text-sm sm:grid-cols-2">
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Kode Buku:</span> {{ $buku->kode_buku }}</div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">ISBN:</span> {{ $buku->isbn ?: '-' }}</div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Kategori:</span> {{ $buku->kategori->nama_kategori ?? '-' }}</div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Rak:</span> {{ $buku->rak->nomor_rak ?? '-' }}</div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Penerbit:</span> {{ $buku->penerbit ?: '-' }}</div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3"><span class="font-semibold">Tahun Terbit:</span> {{ $buku->tahun_terbit ?: '-' }}</div>
                <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 sm:col-span-2">
                    <span class="font-semibold">Stok Tersedia:</span> {{ $buku->stok_tersedia }}/{{ $buku->stok_total }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
