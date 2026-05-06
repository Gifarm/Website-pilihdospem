<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - LPKIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --sidebar-width: 18rem;
            --sidebar-mini-width: 5rem;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfd;
        }

        @media (min-width: 1024px) {
            #mainContent {
                margin-left: var(--sidebar-width);
                transition: margin-left 0.3s ease;
            }

            .content-mini {
                margin-left: var(--sidebar-mini-width) !important;
            }
        }

        /* Border tipis ala dashboard modern */
        .card-border {
            border: 1px solid #f1f5f9;
        }

        /* Hover effect yang gak norak */
        .hover-lift {
            transition: transform 0.2s ease, shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="text-slate-900">

    @include('sidebar')

    <main id="mainContent" class="min-h-screen">

        <!-- Navbar -->
        <nav class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="lg:hidden w-8"></div> <!-- Mobile spacer -->
                    <h2 class="text-lg font-bold tracking-tight text-slate-800">Dashboard Admin</h2>
                </div>

                <div class="flex items-center gap-4 text-slate-500">
                    <span class="text-xs font-semibold">{{ now()->format('l, d M Y') }}</span>
                    <div class="w-px h-4 bg-slate-200"></div>
                    <button class="relative hover:text-blue-600 transition-colors">
                        <span
                            class="absolute -top-1 -right-1 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
            </div>
        </nav>

        <div class="p-6 lg:p-8 space-y-8">

            <!-- Welcome Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900">Halo, Admin LPKIA!</h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Berikut adalah ringkasan aktivitas sistem hari
                        ini.</p>
                </div>
                {{-- <div class="flex gap-2">
                    <button
                        class="flex items-center gap-2 bg-white border border-slate-200 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all">
                        <span data-lucide="download-cloud" class="w-4 h-4"></span>
                        Export PDF
                    </button>
                </div> --}}
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card Dosen -->
                <div class="bg-white p-6 rounded-2xl card-border hover-lift shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Dosen</p>
                            <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $total_dosen }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                            <span data-lucide="users-2" class="w-5 h-5"></span>
                        </div>
                    </div>
                </div>

                <!-- Card Pengajuan -->
                <div class="bg-white p-6 rounded-2xl card-border hover-lift shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Pengajuan</p>
                            <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $total_pengajuan }}</h3>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                            <span data-lucide="folder-kanban" class="w-5 h-5"></span>
                        </div>
                    </div>
                </div>

                <!-- Card Disetujui -->
                <div class="bg-white p-6 rounded-2xl card-border hover-lift shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Disetujui</p>
                            <h3 class="text-3xl font-black text-emerald-600 mt-1">{{ $disetujui }}</h3>
                        </div>
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                            <span data-lucide="check-circle" class="w-5 h-5"></span>
                        </div>
                    </div>
                </div>

                <!-- Card Status Khusus (Pending/Ditolak) -->
                <div class="bg-slate-900 p-6 rounded-2xl hover-lift shadow-lg">
                    <div class="flex flex-col h-full justify-between">
                        <p
                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 text-center border-b border-white/10 pb-2">
                            Status Log</p>
                        <div class="flex justify-around items-center">
                            <div class="text-center px-2">
                                <span class="block text-xl font-black text-amber-400">{{ $pending }}</span>
                                <span
                                    class="text-[9px] font-bold text-white/50 uppercase tracking-tighter">Pending</span>
                            </div>
                            <div class="w-px h-8 bg-white/10"></div>
                            <div class="text-center px-2">
                                <span class="block text-xl font-black text-rose-500">{{ $ditolak }}</span>
                                <span
                                    class="text-[9px] font-bold text-white/50 uppercase tracking-tighter">Ditolak</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Progress Stats -->
                <div class="lg:col-span-8 bg-white p-8 rounded-[2rem] card-border shadow-sm">
                    <h3 class="font-extrabold text-slate-800 mb-6">Persentase Status Berkas</h3>

                    <div class="space-y-6">
                        @php
                            $total = max($total_pengajuan, 1);
                            $p_approved = ($disetujui / $total) * 100;
                            $p_pending = ($pending / $total) * 100;
                            $p_rejected = ($ditolak / $total) * 100;
                        @endphp

                        <div class="space-y-2">
                            <div class="flex justify-between text-[11px] font-bold uppercase">
                                <span class="text-slate-500">Sudah Disetujui</span>
                                <span class="text-emerald-600 font-black">{{ round($p_approved, 1) }}%</span>
                            </div>
                            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 transition-all duration-1000"
                                    style="width: {{ $p_approved }}%"></div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-[11px] font-bold uppercase">
                                <span class="text-slate-500">Dalam Antrian</span>
                                <span class="text-amber-500 font-black">{{ round($p_pending, 1) }}%</span>
                            </div>
                            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-400 transition-all duration-1000"
                                    style="width: {{ $p_pending }}%"></div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-[11px] font-bold uppercase">
                                <span class="text-slate-500">Tidak Lolos</span>
                                <span class="text-rose-500 font-black">{{ round($p_rejected, 1) }}%</span>
                            </div>
                            <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-rose-500 transition-all duration-1000"
                                    style="width: {{ $p_rejected }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Access -->
                <div class="lg:col-span-4 flex flex-col gap-4">
                    <div class="bg-indigo-600 p-6 rounded-3xl text-white shadow-xl shadow-indigo-100 flex-1">
                        <div class="flex flex-col h-full justify-between">
                            <div>
                                <h4 class="font-black text-lg">Navigasi Admin</h4>
                                <p
                                    class="text-indigo-100 text-[11px] font-medium mt-1 leading-relaxed opacity-80 italic">
                                    Akses cepat manajemen data inti.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-6">
                                <a href="{{ route('dosen.index') }}"
                                    class="bg-white/10 hover:bg-white/20 p-3 rounded-2xl flex flex-col items-center gap-2 transition-all border border-white/10">
                                    <span data-lucide="layout-grid" class="w-5 h-5"></span>
                                    <span class="text-[10px] font-bold uppercase">Prodi</span>
                                </a>
                                <a href="{{ route('admin.pengajuan.index') }}"
                                    class="bg-white/10 hover:bg-white/20 p-3 rounded-2xl flex flex-col items-center gap-2 transition-all border border-white/10">
                                    <span data-lucide="shield-check" class="w-5 h-5"></span>
                                    <span class="text-[10px] font-bold uppercase">Admin</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Small -->
            <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-slate-400">
                <p class="text-[10px] font-bold uppercase tracking-widest">© LPKIA Dashboard System</p>
                <div class="flex gap-4">
                    <span class="text-[10px] font-bold uppercase">v2.1.0</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const desktopToggleBtn = document.getElementById('desktopToggleBtn');

            // Sync toggle state
            if (sidebar?.classList.contains('sidebar-mini')) {
                mainContent?.classList.add('content-mini');
            }

            desktopToggleBtn?.addEventListener('click', () => {
                setTimeout(() => {
                    if (sidebar.classList.contains('sidebar-mini')) {
                        mainContent.classList.add('content-mini');
                    } else {
                        mainContent.classList.remove('content-mini');
                    }
                }, 10);
            });
        });
    </script>
</body>

</html>
