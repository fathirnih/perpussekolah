@php
    $dokumen = collect($dokumentasi ?? []);
    $utama = $dokumen->first();
    $galeri = $dokumen->slice(1)->take(8);
@endphp

<section class="relative -mt-2 mb-10 overflow-hidden bg-white">
    <img
        src="{{ asset('images/perpus/perpus-smekda.jpeg') }}"
        alt="SMK Negeri 2 Padang Panjang"
        class="h-[320px] w-full object-cover md:h-[460px]"
        onerror="this.onerror=null;this.src='{{ asset('images/logo-sekolah.jpeg') }}';"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/15 to-white/10"></div>

    <div class="absolute inset-x-0 bottom-0 mx-5 mb-5 text-white md:mx-10 md:mb-10">
        <p class="inline-block border-b-2 border-amber-300 pb-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-100">Perpustakaan Sekolah</p>
        <h1 class="mt-3 text-3xl font-extrabold leading-tight uppercase drop-shadow md:text-6xl">
            Selamat Datang
            <span class="block text-amber-200">Ruang Literasi Siswa</span>
        </h1>
        <p class="mt-3 max-w-3xl text-sm text-slate-100 drop-shadow md:text-xl">
            Temukan inspirasi, perluas wawasan, dan tumbuhkan budaya membaca
            bersama Perpustakaan SMK Negeri 2 Padang Panjang.
        </p>
    </div>
</section>

<section class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="m-6 md:m-8">
        <h2 class="text-3xl font-extrabold text-slate-900">Dokumentasi Perpustakaan</h2>
        <p class="mt-2 text-sm text-slate-600 md:text-base">Dokumentasi berikut dikelola admin perpustakaan dan ditampilkan otomatis dari database.</p>
    </div>
</section>

@if($utama)
<section class="mb-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="grid md:grid-cols-[1.1fr_0.9fr]">
        <button type="button" class="w-full text-left" onclick="openDokumentasiModal('{{ asset('storage/' . $utama->foto) }}', '{{ e($utama->judul) }}')">
            <img
                src="{{ $utama->foto ? asset('storage/' . $utama->foto) : asset('images/perpus/perpus-smekda.jpeg') }}"
                alt="{{ $utama->judul }}"
                class="h-64 w-full object-cover md:h-full"
            >
        </button>
        <div class="m-6 md:m-8">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Dokumentasi Utama</p>
            <h3 class="mt-2 text-2xl font-extrabold text-slate-900">{{ $utama->judul }}</h3>
            <p class="mt-2 text-sm text-slate-500">{{ optional($utama->tanggal_kegiatan)->format('d F Y') ?: '-' }}</p>
            <p class="mt-4 text-sm leading-relaxed text-slate-700">{{ $utama->deskripsi ?: 'Belum ada deskripsi kegiatan.' }}</p>
            @if($utama->foto)
                <button type="button" onclick="openDokumentasiModal('{{ asset('storage/' . $utama->foto) }}', '{{ e($utama->judul) }}')" class="mt-5 rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Lihat Foto Penuh
                </button>
            @endif
        </div>
    </div>
</section>
@endif

@if(! $utama)
    <section class="mb-6">
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
            Belum ada dokumentasi yang dipublikasikan.
        </div>
    </section>
@endif

<div id="dokumentasiModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4">
    <div class="relative max-h-full w-full max-w-5xl">
        <button type="button" class="absolute right-2 top-2 rounded-md bg-black/60 px-3 py-1 text-sm font-semibold text-white" onclick="closeDokumentasiModal()">Tutup</button>
        <img id="dokumentasiModalImage" src="" alt="Preview Dokumentasi" class="max-h-[85vh] w-full rounded-lg object-contain">
        <p id="dokumentasiModalTitle" class="mt-2 text-center text-sm font-semibold text-white"></p>
    </div>
</div>

<script>
    function openDokumentasiModal(src, title) {
        const modal = document.getElementById('dokumentasiModal');
        const image = document.getElementById('dokumentasiModalImage');
        const label = document.getElementById('dokumentasiModalTitle');
        if (!modal || !image || !label) return;

        image.src = src;
        label.textContent = title || '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDokumentasiModal() {
        const modal = document.getElementById('dokumentasiModal');
        const image = document.getElementById('dokumentasiModalImage');
        if (!modal || !image) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
        image.src = '';
    }

    document.addEventListener('click', function (event) {
        const modal = document.getElementById('dokumentasiModal');
        if (!modal) return;
        if (event.target === modal) closeDokumentasiModal();
    });
</script>
