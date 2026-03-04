@php
    $showStatus = $showStatus ?? true;
@endphp

<section class="space-y-4">
    <div class="flex flex-col gap-2 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-black text-slate-900">Daftar Buku</h2>
        <p class="text-sm text-slate-500">Halaman {{ method_exists($katalog ?? null, 'currentPage') ? $katalog->currentPage() : 1 }} dari {{ method_exists($katalog ?? null, 'lastPage') ? $katalog->lastPage() : 1 }}</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @forelse(($katalog ?? []) as $item)
            @php
                $detailUrl = request()->routeIs('siswa.*') ? route('siswa.buku.detail', $item->id) : route('buku.detail', $item->id);
                $stok = (int) ($item->stok_tersedia ?? 0);
            @endphp
            <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <a href="{{ $detailUrl }}" class="block bg-slate-100">
                    @if(!empty($item->gambar_sampul))
                        <img
                            src="{{ asset('storage/' . $item->gambar_sampul) }}"
                            alt="Sampul {{ $item->judul }}"
                            class="h-64 w-full object-cover"
                        >
                    @else
                        <div class="flex h-64 w-full items-center justify-center text-xs font-semibold tracking-wide text-slate-400">NO COVER</div>
                    @endif
                </a>

                <div class="space-y-3 p-4">
                    <h3 class="line-clamp-2 text-base font-bold leading-6 text-slate-900">
                        <a href="{{ $detailUrl }}" class="hover:text-sky-700">{{ $item->judul }}</a>
                    </h3>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                        <a href="{{ $detailUrl }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                            Detail
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-center text-sm text-slate-500 sm:col-span-2 xl:col-span-3">
                Data buku belum tersedia atau tidak ditemukan.
            </div>
        @endforelse
    </div>

    @if(isset($katalog) && method_exists($katalog, 'links'))
        <div class="rounded-lg border border-slate-200 bg-white px-3 py-2">
            {{ $katalog->onEachSide(1)->links() }}
        </div>
    @endif
</section>
