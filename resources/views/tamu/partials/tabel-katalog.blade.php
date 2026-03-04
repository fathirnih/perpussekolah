<div class="mt-5 overflow-x-auto">
    <table class="w-full min-w-[720px] border-collapse text-sm">
        <thead>
            <tr class="border-b border-slate-200 text-left text-slate-500">
                <th class="py-3 pr-3 font-semibold">Judul</th>
                <th class="py-3 pr-3 font-semibold">Penulis</th>
                <th class="py-3 pr-3 font-semibold">Kategori</th>
                <th class="py-3 pr-3 font-semibold">Nomor Rak</th>
                <th class="py-3 font-semibold">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($katalog ?? []) as $item)
                <tr class="border-b border-slate-100 align-top">
                    <td class="py-3 pr-3 font-medium text-slate-700">{{ $item->judul }}</td>
                    <td class="py-3 pr-3 text-slate-600">{{ $item->penulis ?? '-' }}</td>
                    <td class="py-3 pr-3 text-slate-600">{{ $item->nama_kategori ?? '-' }}</td>
                    <td class="py-3 pr-3 text-slate-600">{{ $item->nomor_rak ?? '-' }}</td>
                    <td class="py-3">
                        @if(($item->stok_tersedia ?? 0) > 0)
                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Tersedia</span>
                        @else
                            <span class="inline-flex rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">Dipinjam</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="py-4 text-slate-500" colspan="5">Data buku belum tersedia atau tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
