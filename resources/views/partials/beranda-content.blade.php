@php
    $dokumentasi = [
        [
            'judul' => 'Literasi Pagi Bersama',
            'tanggal' => 'Senin, 03 Maret 2026',
            'deskripsi' => 'Siswa membaca buku nonpelajaran selama 15 menit sebelum pembelajaran dimulai untuk meningkatkan kebiasaan membaca harian.',
            'foto' => asset('images/perpus/dokumentasi-1.jpg'),
        ],
        [
            'judul' => 'Kunjungan Kelas ke Perpustakaan',
            'tanggal' => 'Selasa, 04 Maret 2026',
            'deskripsi' => 'Sosialisasi tata tertib perpustakaan, pengenalan rak koleksi, serta cara mencari buku berdasarkan kategori dan rak.',
            'foto' => asset('images/perpus/dokumentasi-2.jpg'),
        ],
        [
            'judul' => 'Pojok Referensi Tugas',
            'tanggal' => 'Rabu, 05 Maret 2026',
            'deskripsi' => 'Pemanfaatan kamus, atlas, dan ensiklopedia untuk mendukung penyusunan tugas proyek dan presentasi siswa.',
            'foto' => asset('images/perpus/dokumentasi-3.jpg'),
        ],
        [
            'judul' => 'Bimbingan Peminjaman Buku',
            'tanggal' => 'Kamis, 06 Maret 2026',
            'deskripsi' => 'Petugas membimbing siswa memilih buku, memahami alur peminjaman, serta pengembalian sesuai ketentuan perpustakaan.',
            'foto' => asset('images/perpus/dokumentasi-4.jpg'),
        ],
        [
            'judul' => 'Rekomendasi Buku Mingguan',
            'tanggal' => 'Jumat, 07 Maret 2026',
            'deskripsi' => 'Guru dan pustakawan menampilkan buku pilihan minggu ini untuk memperluas minat baca siswa di berbagai kategori.',
            'foto' => asset('images/perpus/dokumentasi-5.jpg'),
        ],
        [
            'judul' => 'Pendampingan Ruang Baca',
            'tanggal' => 'Sabtu, 08 Maret 2026',
            'deskripsi' => 'Kegiatan membaca mandiri dan diskusi ringan agar siswa lebih nyaman memanfaatkan perpustakaan sebagai ruang belajar.',
            'foto' => asset('images/perpus/dokumentasi-6.jpg'),
        ],
    ];
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
        <h1 class="mt-3 text-3xl font-extrabold leading-tight uppercase drop-shadow md:text-6xl">Selamat Datang</h1>
        <p class="mt-2 text-2xl font-semibold text-amber-200 drop-shadow md:text-5xl">SMK Negeri 2 Padang Panjang</p>
        <p class="mt-4 max-w-3xl text-sm text-slate-100 drop-shadow md:text-xl">Jalan Syekh Ibrahim Musa No.26, Ganting, Padang Panjang Timur</p>
    </div>
</section>

<section class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="m-6 md:m-8">
        <h2 class="text-3xl font-extrabold text-slate-900">Dokumentasi Kegiatan Perpustakaan</h2>
        <p class="mt-2 text-sm text-slate-600 md:text-base">
            Kumpulan dokumentasi kegiatan perpustakaan sekolah yang berfokus pada penguatan budaya literasi,
            pendampingan peminjaman, dan pemanfaatan ruang baca oleh siswa.
        </p>
    </div>
</section>

<section class="mb-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @foreach($dokumentasi as $item)
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <img
                src="{{ $item['foto'] }}"
                alt="{{ $item['judul'] }}"
                class="h-48 w-full object-cover"
                onerror="this.onerror=null;this.src='{{ asset('images/perpus/perpus-smekda.jpeg') }}';"
            >
            <div class="m-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $item['tanggal'] }}</p>
                <h3 class="mt-2 text-lg font-bold text-slate-900">{{ $item['judul'] }}</h3>
                <p class="mt-2 text-sm text-slate-600">{{ $item['deskripsi'] }}</p>
            </div>
        </article>
    @endforeach
</section>

<section class="mb-4 rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="m-6 md:m-8">
        <h3 class="text-2xl font-extrabold text-slate-900">Ringkasan Manfaat Kegiatan</h3>
        <ul class="mt-3 space-y-2 text-sm text-slate-700">
            <li>1. Meningkatkan minat baca siswa secara konsisten melalui kegiatan literasi terjadwal.</li>
            <li>2. Membantu siswa memahami proses peminjaman dan pengembalian buku dengan tertib.</li>
            <li>3. Memaksimalkan penggunaan koleksi referensi untuk tugas sekolah dan proyek belajar.</li>
            <li>4. Menjadikan perpustakaan sebagai ruang belajar aktif, nyaman, dan kolaboratif.</li>
        </ul>
    </div>
</section>