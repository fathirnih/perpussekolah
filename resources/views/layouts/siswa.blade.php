<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Area Siswa' }}</title>
    @vite('resources/css/app.css')
    <style>
        .menu-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 9999px;
            background: #e2e8f0;
            color: #1e3a8a;
            font-size: 0.75rem;
            font-weight: 700;
            line-height: 1;
            flex-shrink: 0;
        }

        body.sidebar-collapsed #siswaSidebar { width: 5rem; }
        body.sidebar-collapsed #siswaMain { padding-left: 5rem; }
        body.sidebar-collapsed .sidebar-label, body.sidebar-collapsed .brand-text { display: none; }
        body.sidebar-collapsed .sidebar-link { justify-content: center; }

        @media (max-width: 1023px) {
            body.sidebar-collapsed #siswaSidebar { width: 16rem; }
            body.sidebar-collapsed #siswaMain { padding-left: 0; }
            body.sidebar-collapsed .sidebar-label, body.sidebar-collapsed .brand-text { display: inline; }
            body.sidebar-collapsed .sidebar-link { justify-content: flex-start; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">
    <aside id="siswaSidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-slate-200 bg-white transition-all duration-300 lg:translate-x-0">
        <div class="flex h-16 items-center border-b border-slate-200 px-4">
            @include('partials.logo-sekolah', ['size' => 'h-9 w-9', 'rounded' => 'rounded-lg'])
            <span class="brand-text ml-2 text-sm font-bold text-slate-800">Siswa SMKN 2</span>
        </div>

        <nav class="space-y-1 p-3">
            <a href="{{ route('siswa.dashboard') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('siswa.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}">
                <span class="menu-icon">D</span>
                <span class="sidebar-label">Dashboard</span>
            </a>
            <a href="{{ route('siswa.peminjaman.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('siswa.peminjaman.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}">
                <span class="menu-icon">M</span>
                <span class="sidebar-label">Peminjaman</span>
            </a>
            <a href="{{ route('siswa.pengembalian.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('siswa.pengembalian.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}">
                <span class="menu-icon">K</span>
                <span class="sidebar-label">Pengembalian</span>
            </a>
            <a href="{{ route('siswa.profil') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('siswa.profil*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}">
                <span class="menu-icon">P</span>
                <span class="sidebar-label">Profil</span>
            </a>
        </nav>

        <div class="mt-auto space-y-2 border-t border-slate-200 p-3">
            <a href="{{ route('beranda') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                <span class="menu-icon">&lt;</span>
                <span class="sidebar-label">Kembali ke Beranda</span>
            </a>
            <form method="POST" action="{{ route('logout.siswa') }}">
                @csrf
                <button type="submit" class="sidebar-link flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-rose-700 hover:bg-rose-50">
                    <span class="menu-icon" style="background:#fee2e2;color:#b91c1c;">X</span>
                    <span class="sidebar-label">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div id="siswaBackdrop" class="fixed inset-0 z-30 hidden bg-slate-900/40 lg:hidden"></div>

    <div id="siswaMain" class="min-h-screen transition-all duration-300 lg:pl-64">
        @include('partials.navbar-publik', [
            'activeMenu' => $activeMenu ?? '',
            'showLoginButton' => false,
            'showMenuButton' => true,
            'showNavLinks' => true,
            'menuButtonId' => 'toggleSiswaSidebar',
            'containerClass' => 'w-full px-4 lg:px-6',
            'navLinks' => [
                ['label' => 'Beranda', 'href' => route('siswa.beranda'), 'active' => ($activeMenu ?? '') === 'beranda'],
                ['label' => 'Galeri', 'href' => route('siswa.galeri'), 'active' => ($activeMenu ?? '') === 'galeri'],
                ['label' => 'Katalog', 'href' => route('siswa.katalog'), 'active' => ($activeMenu ?? '') === 'katalog'],
                ['label' => 'Informasi', 'href' => route('siswa.informasi'), 'active' => ($activeMenu ?? '') === 'informasi'],
                ['label' => 'Kontak', 'href' => route('siswa.kontak'), 'active' => ($activeMenu ?? '') === 'kontak'],
            ],
        ])

        <main class="px-4 py-8 lg:px-6">
            @yield('content')
        </main>
    </div>

    <script>
        (() => {
            const body = document.body;
            const sidebar = document.getElementById('siswaSidebar');
            const backdrop = document.getElementById('siswaBackdrop');
            const toggleBtn = document.getElementById('toggleSiswaSidebar');
            const key = 'siswa_sidebar_collapsed';

            const setCollapsed = (collapsed) => {
                body.classList.toggle('sidebar-collapsed', collapsed);
                localStorage.setItem(key, collapsed ? '1' : '0');
            };

            if (window.innerWidth >= 1024) {
                setCollapsed(localStorage.getItem(key) === '1');
            }

            const openMobile = () => {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            };

            const closeMobile = () => {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            };

            toggleBtn?.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    const opened = !sidebar.classList.contains('-translate-x-full');
                    if (opened) closeMobile(); else openMobile();
                    return;
                }

                setCollapsed(!body.classList.contains('sidebar-collapsed'));
            });

            backdrop?.addEventListener('click', closeMobile);
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    backdrop.classList.add('hidden');
                    sidebar.classList.remove('-translate-x-full');
                } else {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        })();
    </script>
</body>
</html>
