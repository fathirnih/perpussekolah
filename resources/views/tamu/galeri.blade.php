@extends($layout ?? 'layouts.app', ['title' => $title ?? 'Galeri - Perpustakaan Sekolah', 'activeMenu' => $activeMenu ?? 'galeri'])

@section('content')
<section class="rounded-2xl border border-sky-100 bg-white p-6 shadow-sm md:p-8">
    <h1 class="text-3xl font-black text-sky-900">Galeri Kegiatan Perpustakaan</h1>
    <p class="mt-2 text-slate-600">Dokumentasi kegiatan literasi, layanan perpustakaan, dan aktivitas siswa.</p>
</section>

<section class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @forelse($dokumentasiGaleri as $item)
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <button type="button" class="block w-full text-left" onclick="openGaleriModal('{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/perpus/perpus-smekda.jpeg') }}', '{{ e($item->judul) }}')">
                <img
                    src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/perpus/perpus-smekda.jpeg') }}"
                    alt="{{ $item->judul }}"
                    class="h-52 w-full object-cover"
                >
            </button>
            <div class="p-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ optional($item->tanggal_kegiatan)->format('d M Y') ?: '-' }}</p>
                <h2 class="mt-2 text-lg font-bold text-slate-900">{{ $item->judul }}</h2>
                <p class="mt-2 line-clamp-3 text-sm text-slate-600">{{ $item->deskripsi ?: 'Belum ada deskripsi kegiatan.' }}</p>
            </div>
        </article>
    @empty
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500 md:col-span-2 xl:col-span-3">
            Belum ada dokumentasi yang dipublikasikan.
        </div>
    @endforelse
</section>

@if(method_exists($dokumentasiGaleri, 'links'))
    <div class="mt-6 rounded-lg border border-slate-200 bg-white px-3 py-2">
        {{ $dokumentasiGaleri->onEachSide(1)->links() }}
    </div>
@endif

<div id="galeriModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4">
    <div class="relative max-h-full w-full max-w-5xl">
        <button type="button" class="absolute right-2 top-2 rounded-md bg-black/60 px-3 py-1 text-sm font-semibold text-white" onclick="closeGaleriModal()">Tutup</button>
        <img id="galeriModalImage" src="" alt="Preview Galeri" class="max-h-[85vh] w-full rounded-lg object-contain">
        <p id="galeriModalTitle" class="mt-2 text-center text-sm font-semibold text-white"></p>
    </div>
</div>

<script>
    function openGaleriModal(src, title) {
        const modal = document.getElementById('galeriModal');
        const image = document.getElementById('galeriModalImage');
        const label = document.getElementById('galeriModalTitle');
        if (!modal || !image || !label) return;

        image.src = src;
        label.textContent = title || '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeGaleriModal() {
        const modal = document.getElementById('galeriModal');
        const image = document.getElementById('galeriModalImage');
        if (!modal || !image) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        image.src = '';
    }

    document.addEventListener('click', function (event) {
        const modal = document.getElementById('galeriModal');
        if (!modal) return;
        if (event.target === modal) closeGaleriModal();
    });
</script>
@endsection
