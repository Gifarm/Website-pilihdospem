<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .sidebar-active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.0) 100%);
            border-left: 4px solid #3b82f6;
            color: #1d4ed8;
        }

        /* Bottom Nav Active State */
        .bottom-nav-active {
            color: #2563eb;
        }

        .bottom-nav-active .nav-indicator {
            transform: scaleX(1);
            opacity: 1;
        }

        /* Desktop Toggle Logic */
        @media (min-width: 1024px) {
            .sidebar-desktop-hidden {
                transform: translateX(-100%);
            }

            #mainContent {
                transition: margin-left 0.3s ease;
            }

            .content-shifted {
                margin-left: 0 !important;
            }
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        /* Padding for mobile to prevent content hidden behind bottom nav */
        @media (max-width: 1023px) {
            body {
                padding-bottom: 80px;
            }
        }
    </style>
</head>

<body class="bg-slate-50">

    <!-- DESKTOP SIDEBAR (Hidden on Mobile) -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-50 h-screen w-72 bg-white border-r border-slate-200 transition-transform duration-300 hidden lg:flex flex-col">

        <div class="flex flex-col h-full">
            <!-- Logo Header -->
            <div class="p-6 flex items-center justify-between border-b border-slate-50">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                        <img src="{{ asset('logo-lpkia.png') }}" alt="Logo LPKIA" class="h-8 w-auto">
                    </div>
                    <div id="sidebarLogoText">
                        <h1 class="font-bold text-slate-800 text-sm leading-tight text-nowrap">Dospem Panel</h1>
                        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">LPKIA Bandung</p>
                    </div>
                </div>
                <button id="desktopCloseBtn" class="p-1 hover:bg-slate-100 rounded-lg text-slate-400 transition-colors">
                    <span data-lucide="chevron-left" class="w-5 h-5"></span>
                </button>
            </div>

            <!-- Navigation Links Desktop -->
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar mt-4">
                <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Main Menu</p>

                @if (auth()->user()->role == 'superadmin')
                    <a href="/superadmin/home"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-50 {{ Request::is('superadmin/home') ? 'sidebar-active' : 'text-slate-600' }}">
                        <span data-lucide="layout-dashboard" class="w-5 h-5"></span> Dashboard
                    </a>
                    <a href="/superadmin/prodi"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-50 {{ Request::is('superadmin/prodi*') ? 'sidebar-active' : 'text-slate-600' }}">
                        <span data-lucide="building-2" class="w-5 h-5"></span> Kelola Prodi
                    </a>
                    <a href="/superadmin/admin-user"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-50 {{ Request::is('superadmin/admin-user*') ? 'sidebar-active' : 'text-slate-600' }}">
                        <span data-lucide="users-round" class="w-5 h-5"></span> Kelola Admin
                    </a>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <form id="formReset" action="/superadmin/reset-pengajuan" method="POST">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmReset()"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-rose-600 transition-all duration-200 hover:bg-rose-50">
                                <span data-lucide="refresh-ccw" class="w-5 h-5"></span> Reset Pengajuan
                            </button>
                        </form>
                    </div>
                @endif

                @if (auth()->user()->role == 'admin')
                    <a href="/admin/home"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-50 {{ Request::is('admin/home') ? 'sidebar-active' : 'text-slate-600' }}">
                        <span data-lucide="layout-dashboard" class="w-5 h-5"></span> Dashboard
                    </a>
                    <a href="/admin/dosen"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-50 {{ Request::is('admin/dosen*') ? 'sidebar-active' : 'text-slate-600' }}">
                        <span data-lucide="user-square-2" class="w-5 h-5"></span> Kelola Dosen
                    </a>
                    <a href="/admin/pengajuan"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-50 {{ Request::is('admin/pengajuan*') ? 'sidebar-active' : 'text-slate-600' }}">
                        <span data-lucide="clipboard-list" class="w-5 h-5"></span> Data Pengajuan
                    </a>
                @endif
            </nav>

            <!-- Logout Footer Desktop -->
            <div class="p-4 border-t border-slate-100">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-colors">
                        <span data-lucide="log-out" class="w-4 h-4"></span> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav
        class="lg:hidden fixed bottom-0 left-0 right-0 z-[60] bg-white/80 backdrop-blur-lg border-t border-slate-200 px-4 pb-safe shadow-[0_-4px_20px_rgba(0,0,0,0.03)]">
        <div class="flex justify-around items-center h-20 relative">

            @if (auth()->user()->role == 'superadmin')
                <a href="/superadmin/home"
                    class="flex flex-col items-center gap-1 group relative py-2 {{ Request::is('superadmin/home') ? 'bottom-nav-active' : 'text-slate-400' }}">
                    <span data-lucide="layout-dashboard"
                        class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Home</span>
                    <div
                        class="nav-indicator absolute -top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-blue-600 rounded-full opacity-0 scale-x-0 transition-all duration-300">
                    </div>
                </a>
                <a href="/superadmin/prodi"
                    class="flex flex-col items-center gap-1 group relative py-2 {{ Request::is('superadmin/prodi*') ? 'bottom-nav-active' : 'text-slate-400' }}">
                    <span data-lucide="building-2" class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Prodi</span>
                    <div
                        class="nav-indicator absolute -top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-blue-600 rounded-full opacity-0 scale-x-0 transition-all duration-300">
                    </div>
                </a>
                <a href="/superadmin/admin-user"
                    class="flex flex-col items-center gap-1 group relative py-2 {{ Request::is('superadmin/admin-user*') ? 'bottom-nav-active' : 'text-slate-400' }}">
                    <span data-lucide="users-round" class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Admin</span>
                    <div
                        class="nav-indicator absolute -top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-blue-600 rounded-full opacity-0 scale-x-0 transition-all duration-300">
                    </div>
                </a>
            @endif

            @if (auth()->user()->role == 'admin')
                <a href="/admin/home"
                    class="flex flex-col items-center gap-1 group relative py-2 {{ Request::is('admin/home') ? 'bottom-nav-active' : 'text-slate-400' }}">
                    <span data-lucide="layout-dashboard"
                        class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Home</span>
                    <div
                        class="nav-indicator absolute -top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-blue-600 rounded-full opacity-0 scale-x-0 transition-all duration-300">
                    </div>
                </a>
                <a href="/admin/dosen"
                    class="flex flex-col items-center gap-1 group relative py-2 {{ Request::is('admin/dosen*') ? 'bottom-nav-active' : 'text-slate-400' }}">
                    <span data-lucide="user-square-2" class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Dosen</span>
                    <div
                        class="nav-indicator absolute -top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-blue-600 rounded-full opacity-0 scale-x-0 transition-all duration-300">
                    </div>
                </a>
                <a href="/admin/pengajuan"
                    class="flex flex-col items-center gap-1 group relative py-2 {{ Request::is('admin/pengajuan*') ? 'bottom-nav-active' : 'text-slate-400' }}">
                    <span data-lucide="clipboard-list"
                        class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Data</span>
                    <div
                        class="nav-indicator absolute -top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-blue-600 rounded-full opacity-0 scale-x-0 transition-all duration-300">
                    </div>
                </a>
            @endif

            <!-- Logout Button (Mobile) -->
            <form action="/logout" method="POST" class="flex flex-col items-center">
                @csrf
                <button type="submit" class="flex flex-col items-center gap-1 text-rose-500 py-2 group">
                    <span data-lucide="log-out" class="w-6 h-6 transition-transform group-active:scale-90"></span>
                    <span class="text-[10px] font-bold uppercase tracking-tight">Keluar</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Desktop Open Button -->
    <div class="hidden lg:block fixed top-4 left-4 z-[40]">
        <button id="desktopOpenBtn"
            class="p-3 bg-white border border-slate-200 rounded-xl shadow-sm text-slate-600 hover:bg-slate-50 transition-all opacity-0 pointer-events-none translate-x-[-20px]">
            <span data-lucide="menu" class="w-5 h-5"></span>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const desktopCloseBtn = document.getElementById('desktopCloseBtn');
            const desktopOpenBtn = document.getElementById('desktopOpenBtn');

            const initIcons = () => {
                if (window.lucide) window.lucide.createIcons();
            }
            initIcons();

            // --- DESKTOP TOGGLE LOGIC ---
            const hideDesktopSidebar = () => {
                sidebar.classList.add('sidebar-desktop-hidden');
                desktopOpenBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-x-[-20px]');
                document.getElementById('mainContent')?.classList.add('content-shifted');
            };

            const showDesktopSidebar = () => {
                sidebar.classList.remove('sidebar-desktop-hidden');
                desktopOpenBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-x-[-20px]');
                document.getElementById('mainContent')?.classList.remove('content-shifted');
            };

            desktopCloseBtn?.addEventListener('click', hideDesktopSidebar);
            desktopOpenBtn?.addEventListener('click', showDesktopSidebar);

            // SweetAlert2 Logic
            window.confirmReset = () => {
                if (window.Swal) {
                    window.Swal.fire({
                        title: 'Reset Semua Data?',
                        text: "Data pengajuan mahasiswa akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Reset Sekarang',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-3xl'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) document.getElementById('formReset').submit();
                    });
                } else if (confirm('Konfirmasi reset semua data pengajuan?')) {
                    document.getElementById('formReset').submit();
                }
            };
        });
    </script>
</body>

</html>
