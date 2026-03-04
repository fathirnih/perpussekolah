<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Perpustakaan Sekolah' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-emerald-50 text-slate-800">
    @include('partials.navbar-publik', [
        'activeMenu' => $activeMenu ?? '',
        'showLoginButton' => true,
    ])

    <main class="mx-auto w-[min(1120px,92%)] py-10 md:py-14">
        @yield('content')
    </main>

    <footer id="kontak" class="border-t border-sky-100 bg-white">
        <div class="mx-auto flex w-[min(1120px,92%)] flex-wrap items-center justify-between gap-2 py-5 text-xs text-slate-500">
            <span>&copy; {{ date('Y') }} Perpustakaan SMK Negeri 2 Padang Panjang</span>
            <a href="{{ route('login.internal') }}" class="text-slate-400 hover:text-slate-600">portal internal</a>
        </div>
    </footer>
</body>
</html>
