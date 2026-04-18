<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Admin - LPKIA</title>
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

        @media (min-width: 1024px) {
            #mainContent {
                margin-left: var(--sidebar-width);
                transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .content-mini {
                margin-left: var(--sidebar-mini-width) !important;
            }
        }

        .table-row-hover:hover {
            background-color: #f8fafc;
        }

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

    <!-- Main Content Wrapper -->
    <main id="mainContent" class="min-h-screen transition-all duration-300 ease-in-out">

        <!-- Header Dashboard -->
        <header class="glass-header sticky top-0 z-30 border-b border-slate-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-1 lg:hidden"></div>
                    <div class="ml-12">
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Data Admin</h2>
                        <p class="text-xs text-slate-500 font-medium tracking-wide uppercase">Manajemen Hak Akses Sistem
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin-user.create') }}"
                        class="group flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-2xl text-sm font-bold transition-all active:scale-95 shadow-lg shadow-indigo-200">
                        <span data-lucide="user-plus" class="w-4 h-4"></span>
                        Tambah Admin
                    </a>
                </div>
            </div>
        </header>

        <div class="p-6 lg:p-10 space-y-8 fade-in-up">

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
                                    No</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Administrator</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Email Address</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Status</th>
                                <th
                                    class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($admins as $i => $admin)
                                <tr class="table-row-hover transition-all group">
                                    <td class="px-8 py-6 text-center">
                                        <span class="text-xs font-bold text-slate-400">{{ $i + 1 }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-xs border border-indigo-100">
                                                {{ strtoupper(substr($admin->name, 0, 2)) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-extrabold text-slate-800 tracking-tight">{{ $admin->name }}</span>
                                                <span
                                                    class="text-[10px] text-slate-400 font-bold uppercase tracking-wider italic">Full
                                                    Access Admin</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2 text-slate-600">
                                            <span data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></span>
                                            <span class="text-sm font-medium">{{ $admin->email }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-wider border border-emerald-100">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <!-- Kita asumsikan ada route edit jika diperlukan di masa depan -->
                                            <form action="{{ route('admin-user.destroy', $admin->id) }}" method="POST"
                                                class="inline" id="delete-form-{{ $admin->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $admin->id }}')"
                                                    class="w-10 h-10 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition-all shadow-sm border border-rose-100"
                                                    title="Hapus Admin">
                                                    <span data-lucide="trash-2" class="w-4 h-4"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($admins->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-8 py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-6 border border-slate-100 shadow-inner">
                                                <span data-lucide="shield-off" class="w-10 h-10"></span>
                                            </div>
                                            <h4 class="text-lg font-bold text-slate-800">Tidak Ada Admin</h4>
                                            <p class="text-slate-400 text-sm max-w-xs mt-1">Belum ada user dengan level
                                                Administrator yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Footer Table Info -->
                <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">Security
                        Management</p>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Total: {{ $admins->count() }}
                        User(s)</span>
                </div>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 for Delete Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

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
                title: 'Hapus Admin?',
                text: "User ini akan kehilangan akses total ke sistem LPKIA!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Cabut Akses',
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
