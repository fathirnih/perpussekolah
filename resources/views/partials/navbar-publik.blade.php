@php
    $active = $activeMenu ?? '';
    $showLoginButton = $showLoginButton ?? false;
    $showMenuButton = $showMenuButton ?? false;
    $showRightPlaceholder = $showRightPlaceholder ?? true;
    $showNavLinks = $showNavLinks ?? true;
    $menuButtonId = $menuButtonId ?? 'togglePublicSidebar';
    $containerClass = $containerClass ?? 'mx-auto w-[min(1120px,92%)]';
    $navLinks = $navLinks ?? [
        ['label' => 'Beranda', 'href' => route('beranda'), 'active' => $active === 'beranda'],
        ['label' => 'Katalog', 'href' => route('katalog'), 'active' => $active === 'katalog'],
        ['label' => 'Informasi', 'href' => route('informasi'), 'active' => $active === 'informasi'],
        ['label' => 'Kontak', 'href' => route('kontak'), 'active' => $active === 'kontak'],
    ];
@endphp

<header class="sticky top-0 z-20 border-b border-sky-100 bg-white/90 backdrop-blur">
    <div class="{{ $containerClass }} flex items-center justify-between py-4">
        <div class="flex items-center gap-3">
            @if($showMenuButton)
                <button id="{{ $menuButtonId }}" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Menu
                </button>
            @endif
            <div class="flex items-center gap-2">
                @include('partials.logo-sekolah', ['size' => 'h-9 w-9', 'rounded' => 'rounded-lg'])
                <div>
                    <div class="text-sm font-black leading-tight text-sky-900">SMK Negeri 2 Padang Panjang</div>
                    <div class="text-xs leading-tight text-slate-500">Perpustakaan Sekolah</div>
                </div>
            </div>
        </div>

        @if($showNavLinks)
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                @foreach($navLinks as $link)
                    <a href="{{ $link['href'] }}" class="{{ ($link['active'] ?? false) ? 'text-sky-700' : 'hover:text-sky-700' }}">{{ $link['label'] }}</a>
                @endforeach
            </nav>
        @endif

        @if($showLoginButton)
            <a href="{{ route('login.siswa') }}" class="rounded-lg bg-sky-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-800">
                Login
            </a>
        @elseif($showRightPlaceholder)
            <div class="w-10 md:w-[120px]"></div>
        @endif
    </div>
</header>
