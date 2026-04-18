<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Dosen - LPKIA</title>
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

        .progress-bar {
            height: 6px;
            border-radius: 99px;
            background-color: #f1f5f9;
            overflow: hidden;
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
    </style>
</head>

<body class="text-slate-900">

    @include('sidebar')

    <main id="mainContent" class="min-h-screen transition-all duration-300">

        <!-- Header -->
        <nav class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-100 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="lg:hidden w-8"></div>
                    <h2 class="text-lg font-bold tracking-tight text-slate-800">Manajemen Dosen</h2>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('dosen.create') }}"
                        class="group flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-2xl text-sm font-bold transition-all active:scale-95 shadow-lg shadow-blue-100">
                        <span data-lucide="plus" class="w-4 h-4"></span>
                        Tambah Dosen
                    </a>
                </div>
            </div>
        </nav>

        <div class="p-6 lg:p-8 space-y-6 fade-in-up">

            <!-- Alert Session -->
            @if (session('success'))
                <div
                    class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm">
                    <span data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></span>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-16">
                                    No</th>
                                <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Informasi Dosen</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Kuota & Kapasitas</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Status</th>
                                <th
                                    class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($dosens as $i => $dosen)
                                <tr class="table-row-hover transition-all group">
                                    <td class="px-6 py-5 text-center">
                                        <span class="text-xs font-bold text-slate-400">{{ $i + 1 }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                                                {{ strtoupper(substr($dosen->nama, 0, 1)) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-bold text-slate-800">{{ $dosen->nama }}</span>
                                                <span
                                                    class="text-[11px] text-slate-400 font-medium italic">{{ $dosen->bidang_keahlian }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="max-w-[140px] mx-auto">
                                            @php
                                                $terpakai = $dosen->pengajuans->count();
                                                $persen = $dosen->kuota > 0 ? ($terpakai / $dosen->kuota) * 100 : 0;
                                                $barColor =
                                                    $persen >= 100
                                                        ? 'bg-rose-500'
                                                        : ($persen >= 75
                                                            ? 'bg-amber-500'
                                                            : 'bg-blue-500');
                                            @endphp
                                            <div class="flex justify-between items-end mb-1.5">
                                                <span class="text-[10px] font-black text-slate-700">{{ $terpakai }}
                                                    / {{ $dosen->kuota }}</span>
                                                <span class="text-[9px] font-bold text-slate-400 uppercase">Sisa:
                                                    {{ $dosen->sisaKuota() }}</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="h-full {{ $barColor }} transition-all"
                                                    style="width: {{ min($persen, 100) }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if ($dosen->isFull())
                                            <span
                                                class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-black uppercase border border-rose-100">Full</span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase border border-emerald-100">Tersedia</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <div
                                            class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('dosen.edit', $dosen->id) }}"
                                                class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all"
                                                title="Edit Data">
                                                <span data-lucide="edit-3" class="w-4 h-4"></span>
                                            </a>

                                            <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST"
                                                class="inline" id="delete-form-{{ $dosen->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $dosen->id }}')"
                                                    class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all"
                                                    title="Hapus Dosen">
                                                    <span data-lucide="trash-2" class="w-4 h-4"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($dosens->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                                                <span data-lucide="user-x" class="w-8 h-8"></span>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-800">Tidak ada data dosen</h4>
                                            <p class="text-xs text-slate-400 mt-1">Silahkan tambahkan dosen baru untuk
                                                memulai.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Menampilkan
                        {{ $dosens->count() }} Total Dosen Terdaftar</p>
                </div>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 & Lucide -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

            // Sidebar Sync Logic
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

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Dosen?',
                text: "Data bimbingan yang terkait mungkin akan terpengaruh!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl p-6',
                    confirmButton: 'rounded-xl px-5 py-2.5 font-bold text-sm',
                    cancelButton: 'rounded-xl px-5 py-2.5 font-bold text-sm'
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
