<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Perpustakaan Sekolah' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-screen overflow-x-hidden bg-[#f8fafc] text-slate-800">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_14%_20%,rgba(226,232,240,0.55),transparent_38%),radial-gradient(circle_at_82%_78%,rgba(226,232,240,0.45),transparent_34%)]"></div>

        <svg class="absolute -left-10 top-10 h-56 w-[28rem] text-slate-300/70" viewBox="0 0 480 180" fill="none">
            <path d="M12 66 C78 8, 150 122, 228 68 C302 16, 368 126, 468 62" stroke="currentColor" stroke-width="4.2" stroke-linecap="round"/>
            <path d="M38 118 C102 62, 174 166, 252 114 C324 66, 392 164, 452 118" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
        </svg>

        <svg class="absolute right-0 top-24 h-64 w-[25rem] text-slate-300/70" viewBox="0 0 420 220" fill="none">
            <path d="M18 42 C88 12, 142 118, 210 62 C274 12, 334 118, 402 52" stroke="currentColor" stroke-width="3.8" stroke-linecap="round"/>
            <path d="M18 148 C76 92, 154 206, 244 148 C314 100, 360 188, 404 150" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        </svg>

        <svg class="absolute -left-8 bottom-24 h-52 w-[23rem] text-slate-300/65" viewBox="0 0 400 180" fill="none">
            <path d="M16 62 C82 12, 144 118, 222 72 C292 26, 346 118, 390 82" stroke="currentColor" stroke-width="3.8" stroke-linecap="round"/>
            <path d="M24 124 C92 76, 168 168, 248 126 C318 92, 358 150, 390 130" stroke="currentColor" stroke-width="2.1" stroke-linecap="round"/>
        </svg>

        <svg class="absolute right-16 bottom-12 h-40 w-40 text-slate-300/65" viewBox="0 0 160 160" fill="none">
            <circle cx="80" cy="80" r="58" stroke="currentColor" stroke-width="3"/>
            <path d="M30 86 C52 58, 108 58, 130 86" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
            <path d="M54 42 L106 118" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>

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
