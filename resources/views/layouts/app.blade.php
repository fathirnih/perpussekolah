<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Perpustakaan Sekolah' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-amber-50 text-slate-800">
    <header class="sticky top-0 z-20 border-b border-sky-100 bg-white/90 backdrop-blur">
        <div class="mx-auto flex w-[min(1120px,92%)] items-center justify-between py-4">
            <div class="text-lg font-bold text-sky-900">Perpustakaan Sekolah</div>
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('beranda') }}" class="{{ ($activeMenu ?? '') === 'beranda' ? 'text-sky-700' : 'hover:text-sky-700' }}">Beranda</a>
                <a href="{{ route('katalog') }}" class="{{ ($activeMenu ?? '') === 'katalog' ? 'text-sky-700' : 'hover:text-sky-700' }}">Katalog</a>
                <a href="{{ route('informasi') }}" class="{{ ($activeMenu ?? '') === 'informasi' ? 'text-sky-700' : 'hover:text-sky-700' }}">Informasi</a>
                <a href="{{ route('kontak') }}" class="{{ ($activeMenu ?? '') === 'kontak' ? 'text-sky-700' : 'hover:text-sky-700' }}">Kontak</a>
            </nav>
            <a href="{{ route('login.siswa') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-800">
                Login Siswa
            </a>
        </div>
    </header>

    <main class="mx-auto w-[min(1120px,92%)] py-10 md:py-14">
        @yield('content')
    </main>

    <footer id="kontak" class="border-t border-sky-100 bg-white">
        <div class="mx-auto flex w-[min(1120px,92%)] flex-wrap items-center justify-between gap-2 py-5 text-xs text-slate-500">
            <span>&copy; {{ date('Y') }} Perpustakaan Sekolah</span>
            <a href="{{ route('login.internal') }}" class="text-slate-400 hover:text-slate-600">portal internal</a>
        </div>
    </footer>
</body>
</html>
