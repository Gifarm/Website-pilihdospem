<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan - LPKIA</title>
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

        .table-row-hover:hover {
            background-color: #f8fafc;
        }

        .fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar for table */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>

<body class="text-slate-900">

    @include('sidebar')

    <main id="mainContent" class="min-h-screen transition-all duration-300">

        <!-- Header / Navbar -->
        <nav class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 px-6 py-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="lg:hidden w-8"></div>
                    <h2 class="text-lg font-bold tracking-tight text-slate-800">Daftar Pengajuan</h2>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('pengajuan.export') }}"
                        class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-2xl text-xs font-bold transition-all active:scale-95 shadow-lg shadow-emerald-100">
                        <span data-lucide="file-spreadsheet" class="w-4 h-4"></span>
                        Export Excel
                    </a>
                </div>
            </div>
        </nav>

        <div class="p-6 lg:p-8 space-y-6 fade-in-up">

            <!-- Alert Messages -->
            @if (session('success'))
                <div
                    class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm">
                    <span data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></span>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl shadow-sm">
                    <span data-lucide="alert-circle" class="w-5 h-5 text-rose-500"></span>
                    <p class="text-sm font-bold">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[1000px]">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-16">
                                    No</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Mahasiswa</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Tema Tugas Akhir</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Dosen Tujuan</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Status</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($pengajuans as $i => $p)
                                <tr class="table-row-hover transition-all group">
                                    <td class="px-6 py-6 text-center">
                                        <span class="text-xs font-bold text-slate-400">{{ $i + 1 }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-slate-800">{{ $p->nama_mahasiswa }}</span>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span
                                                    class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded font-bold">{{ $p->nim }}</span>
                                                <span
                                                    class="text-[10px] text-slate-400 font-medium flex items-center gap-1">
                                                    <span data-lucide="phone" class="w-3 h-3"></span>
                                                    {{ $p->no_hp }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="max-w-xs">
                                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-2 font-medium"
                                                title="{{ $p->tema_ta }}">
                                                {{ $p->tema_ta }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                                            <span class="text-xs font-bold text-slate-700">{{ $p->dosen->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        @if ($p->status == 'pending')
                                            <span
                                                class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-black uppercase border border-amber-100 flex items-center justify-center gap-1.5 w-max mx-auto">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Pending
                                            </span>
                                        @elseif($p->status == 'disetujui')
                                            <span
                                                class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase border border-emerald-100 flex items-center justify-center gap-1.5 w-max mx-auto">
                                                <span data-lucide="check" class="w-3 h-3"></span>
                                                Disetujui
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-black uppercase border border-rose-100 flex items-center justify-center gap-1.5 w-max mx-auto">
                                                <span data-lucide="x" class="w-3 h-3"></span>
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        @if ($p->status == 'pending')
                                            <div class="flex items-center justify-end gap-2">
                                                <form action="{{ route('pengajuan.approve', $p->id) }}" method="POST"
                                                    id="approve-form-{{ $p->id }}">
                                                    @csrf
                                                    <button type="button"
                                                        onclick="confirmAction('approve', '{{ $p->id }}')"
                                                        class="flex items-center gap-1.5 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase transition-all shadow-md shadow-emerald-100 active:scale-95">
                                                        ACC
                                                    </button>
                                                </form>

                                                <form action="{{ route('pengajuan.reject', $p->id) }}" method="POST"
                                                    id="reject-form-{{ $p->id }}">
                                                    @csrf
                                                    <button type="button"
                                                        onclick="confirmAction('reject', '{{ $p->id }}')"
                                                        class="flex items-center gap-1.5 bg-white border border-slate-200 text-rose-600 hover:bg-rose-50 px-4 py-2 rounded-xl text-[10px] font-black uppercase transition-all active:scale-95">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span
                                                class="text-[10px] font-bold text-slate-300 uppercase italic tracking-tighter italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if ($pengajuans->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-6 py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4 border border-slate-100">
                                                <span data-lucide="clipboard-list" class="w-10 h-10"></span>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-800 tracking-tight">Belum ada
                                                pengajuan masuk</h4>
                                            <p class="text-[11px] text-slate-400 mt-1 max-w-[200px]">Data pengajuan
                                                mahasiswa akan muncul di sini setelah mereka melakukan submit.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem Validasi Pengajuan
                        LPKIA</p>
                    <div class="flex items-center gap-2 text-[10px] font-black text-slate-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        {{ $pengajuans->count() }} TOTAL DATA
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 & Lucide -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

            // Sidebar Sync
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const desktopToggleBtn = document.getElementById('desktopToggleBtn');

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

        function confirmAction(type, id) {
            const isApprove = type === 'approve';

            Swal.fire({
                title: isApprove ? 'Setujui Pengajuan?' : 'Tolak Pengajuan?',
                text: isApprove ?
                    "Mahasiswa akan mendapatkan dosen pembimbing ini." :
                    "Berikan alasan penolakan (opsional) melalui jalur lain.",
                icon: isApprove ? 'question' : 'warning',
                showCancelButton: true,
                confirmButtonColor: isApprove ? '#10b981' : '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: isApprove ? 'Ya, Setujui!' : 'Ya, Tolak!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[2rem] p-6',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold text-xs uppercase tracking-wider',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold text-xs uppercase tracking-wider'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`${type}-form-${id}`).submit();
                }
            });
        }
    </script>
</body>

</html>
