<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Program Studi - LPKIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --sidebar-width: 18rem;
            --sidebar-mini-width: 5rem;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Sinkronisasi dengan Sidebar */
        @media (min-width: 1024px) {
            #mainContent {
                margin-left: var(--sidebar-width);
                transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Saat sidebar di parent berstatus .sidebar-mini */
            /* Kita gunakan class .content-mini yang di-trigger JS di sidebar */
            .content-mini {
                margin-left: var(--sidebar-mini-width) !important;
            }
        }

        .table-row-hover:hover {
            background-color: #f8fafc;
        }

        /* Animasi masuk */
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-slate-50">

    <!-- Include Sidebar -->
    @include('sidebar')

    <!-- Main Content Wrapper - Sekarang id-nya sudah sinkron dengan JS Sidebar -->
    <main id="mainContent" class="min-h-screen transition-all duration-300 ease-in-out">

        <!-- Header Dashboard -->
        <header class="glass-header sticky top-0 z-30 border-b border-slate-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <!-- Spacing for mobile hamburger -->
                    <div class="w-1 lg:hidden"></div>
                    <div class="ml-12">
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Kelola Prodi</h2>
                        <p class="text-xs text-slate-500 font-medium tracking-wide uppercase">Daftar Departemen Akademik
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('prodi.create') }}"
                        class="group flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-2xl text-sm font-bold transition-all active:scale-95 shadow-lg shadow-blue-200">
                        <span data-lucide="plus-circle"
                            class="w-4 h-4 group-hover:rotate-90 transition-transform"></span>
                        Tambah Prodi
                    </a>
                </div>
            </div>
        </header>

        <div class="p-6 lg:p-10 space-y-8 fade-in-up">

            <!-- Welcome/Info Section -->
            <div
                class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <span data-lucide="info" class="w-6 h-6"></span>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-sm">Total Program Studi</h3>
                        <p class="text-2xl font-black text-blue-600">{{ $prodis->count() }} <span
                                class="text-xs font-bold text-slate-400 ml-1">Terdaftar</span></p>
                    </div>
                </div>
                <div class="h-12 w-px bg-slate-100 hidden md:block"></div>
                <p class="text-xs text-slate-500 font-medium max-w-xs leading-relaxed">
                    Data prodi digunakan untuk memfilter daftar dosen dan admin yang bertugas di lingkungan LPKIA.
                </p>
            </div>

            <!-- Alert Section -->
            @if (session('success'))
                <div
                    class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-3xl shadow-sm">
                    <div class="bg-emerald-500 text-white p-1 rounded-full">
                        <span data-lucide="check" class="w-4 h-4"></span>
                    </div>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-100">
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-20">
                                    ID</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Nama Program Studi</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Dosen</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Admin</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Pengajuan</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($prodis as $i => $prodi)
                                <tr class="table-row-hover transition-all group">
                                    <td class="px-8 py-6 text-center">
                                        <span
                                            class="text-xs font-black text-slate-300 group-hover:text-blue-400 transition-colors">#{{ str_pad($prodi->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                                <span data-lucide="graduation-cap" class="w-5 h-5"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-extrabold text-slate-800 tracking-tight">{{ $prodi->nama_prodi }}</span>
                                                <span
                                                    class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Akademik
                                                    LPKIA</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <span
                                                class="text-sm font-black text-slate-800">{{ $prodi->dosens_count }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase">Dosen</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="inline-flex flex-col items-center">
                                            <span
                                                class="text-sm font-black text-slate-800">{{ $prodi->users_count }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase">Admin</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div
                                            class="inline-flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-full group-hover:bg-blue-50 transition-colors">
                                            <div class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></div>
                                            <span
                                                class="text-xs font-black text-slate-600 group-hover:text-blue-700">{{ $prodi->pengajuans_count }}
                                                <span class="text-[9px] font-bold ml-0.5">FILES</span></span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('prodi.edit', $prodi->id) }}"
                                                class="w-9 h-9 flex items-center justify-center bg-white border border-slate-200 text-slate-400 hover:text-blue-600 hover:border-blue-100 hover:bg-blue-50 rounded-xl transition-all shadow-sm"
                                                title="Edit Data">
                                                <span data-lucide="edit-3" class="w-4 h-4"></span>
                                            </a>

                                            <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST"
                                                class="inline" id="delete-form-{{ $prodi->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $prodi->id }}')"
                                                    class="w-9 h-9 flex items-center justify-center bg-white border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-100 hover:bg-rose-50 rounded-xl transition-all shadow-sm"
                                                    title="Hapus Data">
                                                    <span data-lucide="trash-2" class="w-4 h-4"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($prodis->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-8 py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-6">
                                                <span data-lucide="database-zap" class="w-10 h-10"></span>
                                            </div>
                                            <h4 class="text-lg font-bold text-slate-800">Database Kosong</h4>
                                            <p class="text-slate-400 text-sm max-w-xs mt-1 leading-relaxed">Belum ada
                                                data program studi yang ditambahkan ke dalam sistem.</p>
                                            <a href="{{ route('prodi.create') }}"
                                                class="mt-6 text-sm font-bold text-blue-600 hover:text-blue-700 underline underline-offset-4">Tambah
                                                Sekarang</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Footer Table Info -->
                <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">LPKIA Academic Management
                        v1.0</p>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase">System Ready</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 for Delete Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

            // Script untuk handle Mini Sidebar secara dinamis di halaman ini
            // Jika sidebar ada class .sidebar-mini, mainContent harus ada class .content-mini
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const desktopToggleBtn = document.getElementById('desktopToggleBtn');

            // Cek status awal (jika perlu)
            if (sidebar?.classList.contains('sidebar-mini')) {
                mainContent?.classList.add('content-mini');
            }

            // Sync toggle button jika di sidebar ada event listener
            desktopToggleBtn?.addEventListener('click', () => {
                // Beri sedikit delay agar transisi CSS sinkron
                setTimeout(() => {
                    if (sidebar.classList.contains('sidebar-mini')) {
                        mainContent.classList.add('content-mini');
                    } else {
                        mainContent.classList.remove('content-mini');
                    }
                }, 10);
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Prodi?',
                text: "Menghapus prodi ini akan menghapus akses admin dan dosen di dalamnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus Data',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[2.5rem] p-8',
                    confirmButton: 'rounded-2xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-2xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</body>

</html>
