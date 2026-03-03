<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Perpustakaan' }}</title>
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

        body.sidebar-collapsed #adminSidebar { width: 5rem; }
        body.sidebar-collapsed #adminMain { padding-left: 5rem; }
        body.sidebar-collapsed .sidebar-label, body.sidebar-collapsed .brand-text { display: none; }
        body.sidebar-collapsed .sidebar-link { justify-content: center; }

        @media (max-width: 1023px) {
            body.sidebar-collapsed #adminSidebar { width: 16rem; }
            body.sidebar-collapsed #adminMain { padding-left: 0; }
            body.sidebar-collapsed .sidebar-label, body.sidebar-collapsed .brand-text { display: inline; }
            body.sidebar-collapsed .sidebar-link { justify-content: flex-start; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
    <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-slate-200 bg-white transition-all duration-300 lg:translate-x-0">
        <div class="flex h-16 items-center border-b border-slate-200 px-4">
            <span class="text-xl font-black text-sky-700">PS</span>
            <span class="brand-text ml-2 text-sm font-bold text-slate-800">Perpus Admin</span>
        </div>

        <nav class="space-y-1 p-3">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">D</span><span class="sidebar-label">Dashboard</span></a>
            <a href="{{ route('admin.user.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.user.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">A</span><span class="sidebar-label">Admin User</span></a>
            <a href="{{ route('admin.petugas.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.petugas.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">P</span><span class="sidebar-label">Petugas</span></a>
            <a href="{{ route('admin.siswa.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.siswa.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">S</span><span class="sidebar-label">Siswa</span></a>
            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.kategori.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">K</span><span class="sidebar-label">Kategori</span></a>
            <a href="{{ route('admin.rak.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.rak.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">R</span><span class="sidebar-label">Rak</span></a>
            <a href="{{ route('admin.buku.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.buku.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-700 hover:bg-slate-100' }}"><span class="menu-icon">B</span><span class="sidebar-label">Data Buku</span></a>
        </nav>

        <div class="mt-auto space-y-2 border-t border-slate-200 p-3">
            <a href="{{ route('beranda') }}" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                <span class="menu-icon">&lt;</span>
                <span class="sidebar-label">Kembali ke Beranda</span>
            </a>
            <form method="POST" action="{{ route('logout.internal') }}">
                @csrf
                <button type="submit" class="sidebar-link flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-rose-700 hover:bg-rose-50">
                    <span class="menu-icon" style="background:#fee2e2;color:#b91c1c;">X</span>
                    <span class="sidebar-label">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div id="sidebarBackdrop" class="fixed inset-0 z-30 hidden bg-slate-900/40 lg:hidden"></div>

    <div id="adminMain" class="min-h-screen transition-all duration-300 lg:pl-64">
        <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="flex h-16 items-center px-4 lg:px-6">
                <button id="toggleSidebar" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Menu
                </button>
            </div>
        </header>

        <main class="p-4 lg:p-6">
            @yield('content')
        </main>
    </div>

    <script>
        (() => {
            const body = document.body;
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const toggleBtn = document.getElementById('toggleSidebar');
            const key = 'admin_sidebar_collapsed';

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
