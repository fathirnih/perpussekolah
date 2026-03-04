@php
    $showStatus = $showStatus ?? true;
@endphp

<div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
    @forelse(($katalog ?? []) as $item)
        <article class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex gap-3">
                <div class="shrink-0">
                    @if(!empty($item->gambar_sampul))
                        <img
                            src="{{ asset('storage/' . $item->gambar_sampul) }}"
                            alt="Sampul {{ $item->judul }}"
                            class="h-24 w-16 rounded-md border border-slate-200 object-cover"
                        >
                    @else
                        <div class="flex h-24 w-16 items-center justify-center rounded-md border border-dashed border-slate-300 bg-slate-50 text-[10px] text-slate-400">
                            No Cover
                        </div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <h3 class="line-clamp-2 text-sm font-bold text-slate-800">{{ $item->judul }}</h3>
                    <p class="mt-1 text-xs text-slate-500">{{ $item->penulis ?? '-' }}</p>
                    <p class="mt-2 text-[11px] text-slate-500">{{ $item->kode_buku ?? '-' }} | {{ $item->tahun_terbit ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-3 flex flex-wrap gap-2">
                <span class="inline-flex rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700">
                    {{ $item->nama_kategori ?? '-' }}
                </span>
                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                    Rak: {{ $item->nomor_rak ?? '-' }}
                </span>
                @if($showStatus)
                    @if(($item->stok_tersedia ?? 0) > 0)
                        <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Tersedia</span>
                    @else
                        <span class="inline-flex rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">Dipinjam</span>
                    @endif
                @else
                    <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                        Stok: {{ (int) ($item->stok_tersedia ?? 0) }}
                    </span>
                @endif
            </div>
        </article>
    @empty
        <div class="rounded-xl border border-slate-200 bg-white p-6 text-center text-sm text-slate-500 sm:col-span-2 xl:col-span-3">
            Data buku belum tersedia atau tidak ditemukan.
        </div>
    @endforelse
</div>

@if(isset($katalog) && method_exists($katalog, 'links'))
    <div class="mt-4 rounded-lg border border-slate-200 bg-white px-3 py-2">
        {{ $katalog->onEachSide(1)->links() }}
    </div>
@endif