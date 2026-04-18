<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - LPKIA</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Vite untuk JS (Lucide Icons, Swal, dll) -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="bg-slate-50">

    <!-- Include Sidebar -->
    @include('sidebar')

    <!-- Main Content Wrapper -->
    <!-- ID 'mainContent' ini penting buat sinkronisasi toggle sidebar di desktop -->
    <main id="mainContent" class="lg:ml-72 min-h-screen transition-all duration-300">

        <header class="glass-header sticky top-0 z-30 border-b border-slate-200 px-6 py-4 lg:pl-10">
            <div class="flex items-center justify-between">
                <!-- Padding kiri otomatis dari lg:ml-72 di mainContent sudah cukup,
                     tapi saat sidebar tutup, content-shifted akan buat ml-0 -->
                <div class="flex items-center gap-4">
                    <!-- Space kosong buat tombol toggle kalau sidebar lagi tutup -->
                    <div class="w-10 lg:hidden"></div>

                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-900">{{ now()->translatedFormat('d F Y') }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider">Status: System Online</p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400">
                        <span data-lucide="bell" class="w-5 h-5"></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-6 lg:p-10 space-y-10">

            <!-- Welcome Section -->
            <div
                class="relative overflow-hidden bg-slate-900 rounded-[2rem] p-8 text-white shadow-2xl shadow-slate-200">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-2">Halo, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-slate-400 max-w-md text-sm leading-relaxed">
                        Anda memiliki kendali penuh atas manajemen Program Studi, Admin Prodi, dan pembersihan data
                        pengajuan sistem.
                    </p>
                </div>
                <!-- Dekorasi Abstrak -->
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-48 h-48 bg-indigo-600/20 rounded-full blur-3xl">
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <!-- Total Prodi -->
                <div
                    class="stat-card bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                        <span data-lucide="building-2" class="w-7 h-7"></span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Prodi</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ $total_prodi }}</h4>
                    </div>
                </div>

                <!-- Total Admin -->
                <div
                    class="stat-card bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <span data-lucide="shield-check" class="w-7 h-7"></span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Admin</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ $total_admin }}</h4>
                    </div>
                </div>

                <!-- Total Dosen -->
                <div
                    class="stat-card bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <span data-lucide="users-round" class="w-7 h-7"></span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Dosen</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ $total_dosen }}</h4>
                    </div>
                </div>

                <!-- Total Pengajuan -->
                <div
                    class="stat-card bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                        <span data-lucide="file-text" class="w-7 h-7"></span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pengajuan</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ $total_pengajuan }}</h4>
                    </div>
                </div>

            </div>

            <!-- Additional Info Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Info Akses Cepat -->
                <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="font-bold text-slate-900">Akses Cepat Manajemen</h4>
                        <span data-lucide="zap" class="w-5 h-5 text-amber-500 fill-amber-500"></span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="/prodi"
                            class="p-4 border border-slate-100 rounded-2xl flex items-center gap-4 hover:border-blue-200 hover:bg-blue-50/30 transition-all group">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                <span data-lucide="plus-circle" class="w-5 h-5"></span>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Tambah Prodi Baru</span>
                        </a>
                        <a href="/admin-user"
                            class="p-4 border border-slate-100 rounded-2xl flex items-center gap-4 hover:border-blue-200 hover:bg-blue-50/30 transition-all group">
                            <div
                                class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                <span data-lucide="user-plus" class="w-5 h-5"></span>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Registrasi Admin</span>
                        </a>
                    </div>
                </div>

                <!-- Info Log Sistem Singkat -->
                <div
                    class="bg-blue-600 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl shadow-blue-100">
                    <h4 class="font-bold mb-4">Informasi Sistem</h4>
                    <div class="space-y-4 relative z-10">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-2 h-2 rounded-full bg-blue-300"></div>
                            <p class="text-xs text-blue-100 leading-relaxed">Pastikan melakukan reset data pengajuan
                                setiap awal semester baru.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-2 h-2 rounded-full bg-blue-300"></div>
                            <p class="text-xs text-blue-100 leading-relaxed">Monitoring admin prodi secara berkala untuk
                                validitas data dospem.</p>
                        </div>
                    </div>
                    <span data-lucide="info" class="absolute -bottom-4 -right-4 w-24 h-24 text-blue-500/30"></span>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi Lucide Icons
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>

</body>

</html>
