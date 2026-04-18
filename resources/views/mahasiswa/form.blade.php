<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemilihan Dospem - LPKIA</title>
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Tailwind tetap pakai CDN agar preview muncul. Di Laravel bisa hapus jika sudah install tailwind via npm -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!--
        CATATAN INSTALASI NPM (WAJIB):
        1. Jalankan di terminal:
           npm install sweetalert2 lucide

        2. Di resources/js/app.js tambahkan:
           import Swal from 'sweetalert2';
           import { createIcons, User, CreditCard, Phone, GraduationCap, ChevronDown, Users, Info, BookOpen, Send } from 'lucide';

           window.Swal = Swal;
           document.addEventListener('DOMContentLoaded', () => {
               createIcons({ icons: { User, CreditCard, Phone, GraduationCap, ChevronDown, Users, Info, BookOpen, Send } });
           });
    -->

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        .gradient-text {
            background: linear-gradient(90deg, #0056b3, #e63946);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .input-group:focus-within label {
            color: #0056b3;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom SweetAlert Style */
        .swal2-toast {
            border-radius: 16px !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(0, 86, 179, 0.1) !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- Header / Navbar -->
    <nav class="sticky top-0 z-50 w-full glass-card border-b border-slate-100 py-4 px-6 mb-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100">
                    <img src="{{ asset('logo-lpkia.png') }}" alt="Logo LPKIA" class="h-10 w-auto">
                </div>
                <div>
                    <h1 class="font-bold leading-tight text-slate-800 text-sm md:text-lg text-nowrap">Institut Digital
                        Ekonomi</h1>
                    <p class="text-[10px] md:text-xs font-semibold text-blue-600 tracking-wider uppercase">LPKIA -
                        Bandung</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
                <span
                    class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">Student
                    Portal</span>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 pb-20">

        <!-- Welcome Section -->
        <div class="text-center mb-10 animate-fade-in">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight leading-tight">
                Pendaftaran <span class="gradient-text">Dosen Pembimbing</span>
            </h2>
            <p class="text-slate-500 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Silakan isi data diri Anda untuk pengajuan judul Tugas Akhir atau Skripsi. Pastikan memilih dosen yang
                kuotanya masih tersedia.
            </p>
        </div>

        <!-- Form Card -->
        <div class="glass-card rounded-[2rem] overflow-hidden animate-fade-in shadow-2xl">
            <div class="h-3 w-full bg-gradient-to-r from-blue-600 via-indigo-500 to-rose-500"></div>

            <form id="formPendaftaran" method="POST" action="{{ route('mahasiswa.store') }}"
                class="p-8 md:p-12 space-y-8">
                @csrf

                <!-- Personal Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 input-group">
                        <label class="text-sm font-bold text-slate-700 ml-1 flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4 text-blue-500"></i> Nama Lengkap
                        </label>
                        <input type="text" name="nama_mahasiswa" required placeholder="Masukkan nama sesuai KTM"
                            class="w-full px-5 py-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200">
                    </div>

                    <div class="space-y-2 input-group">
                        <label class="text-sm font-bold text-slate-700 ml-1 flex items-center gap-2">
                            <i data-lucide="credit-card" class="w-4 h-4 text-blue-500"></i> NIM
                        </label>
                        <input type="text" name="nim" required placeholder="Contoh: 040121001"
                            class="w-full px-5 py-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 input-group">
                        <label class="text-sm font-bold text-slate-700 ml-1 flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-blue-500"></i> WhatsApp / No HP
                        </label>
                        <input type="text" name="no_hp" required placeholder="08xxxxxxxxx"
                            class="w-full px-5 py-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200">
                    </div>

                    <div class="space-y-2 input-group">
                        <label class="text-sm font-bold text-slate-700 ml-1 flex items-center gap-2">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-blue-500"></i> Program Studi
                        </label>
                        <div class="relative">
                            <select name="prodi_id" id="prodi" required
                                class="appearance-none w-full px-5 py-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 cursor-pointer">
                                <option value="" disabled selected>-- Pilih Program Studi --</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Selection -->
                <div class="space-y-2 input-group">
                    <label class="text-sm font-bold text-slate-700 ml-1 flex items-center gap-2">
                        <i data-lucide="users" class="w-4 h-4 text-blue-500"></i> Dosen Pembimbing
                    </label>
                    <div class="relative">
                        <select name="dosen_id" id="dosen" required
                            class="appearance-none w-full px-5 py-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 cursor-pointer disabled:bg-slate-50 disabled:text-slate-400 disabled:cursor-not-allowed">
                            <option value="" disabled selected>-- Pilih prodi terlebih dahulu --</option>
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-400 italic ml-1 flex items-center gap-1">
                        <i data-lucide="info" class="w-3 h-3"></i> Kuota diperbarui secara real-time oleh sistem
                    </p>
                </div>

                <!-- Thesis Topic -->
                <div class="space-y-2 input-group">
                    <label class="text-sm font-bold text-slate-700 ml-1 flex items-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4 text-blue-500"></i> Judul / Tema Tugas Akhir
                    </label>
                    <textarea name="tema_ta" rows="4" required
                        placeholder="Berikan gambaran singkat mengenai topik penelitian Anda..."
                        class="w-full px-5 py-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 resize-none"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" id="btnSubmit"
                        class="group relative w-full bg-slate-900 text-white py-5 px-6 rounded-2xl font-bold overflow-hidden transition-all duration-300 hover:shadow-[0_20px_40px_rgba(0,0,0,0.1)] active:scale-[0.98]">
                        <span class="flex items-center justify-center gap-3">
                            Kirim Pendaftaran
                            <i data-lucide="send"
                                class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <footer class="mt-12 text-center text-slate-400 text-sm">
            <p>&copy; {{ date('Y') }} Institut Digital Ekonomi LPKIA Bandung.</p>
        </footer>

    </main>

    <script>
        // Script ini berjalan dengan asumsi library di-import via NPM di app.js
        document.addEventListener('DOMContentLoaded', () => {

            // Toast Config (Menggunakan window.Swal yang sudah di-set di app.js)
            const Toast = (typeof Swal !== 'undefined') ? Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            }) : null;
            // console.log(window.Swal);
            // Laravel Session Alert
            @if (session('success'))
                Toast?.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}"
                });
            @endif

            @if (session('error'))
                Toast?.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}"
                });
            @endif

            // Dynamic Dropdown Dosen
            document.getElementById('prodi').addEventListener('change', function() {
                let prodiId = this.value;
                let dosenSelect = document.getElementById('dosen');

                dosenSelect.disabled = true;
                dosenSelect.innerHTML = '<option>🔄 Sedang memuat...</option>';

                fetch('/get-dosen/' + prodiId)
                    .then(res => res.json())
                    .then(data => {
                        dosenSelect.disabled = false;
                        dosenSelect.innerHTML =
                            '<option value="" disabled selected>-- Pilih Dosen --</option>';

                        data.forEach(d => {
                            let option = document.createElement('option');
                            if (d.full) {
                                option.text = `🚫 ${d.nama} (Penuh)`;
                                option.disabled = true;
                            } else {
                                option.value = d.id;
                                option.text = `👨‍🏫 ${d.nama} (Sisa: ${d.sisa})`;
                            }
                            dosenSelect.appendChild(option);
                        });
                    });
            });

            // Loading state saat submit
            document.getElementById('formPendaftaran').addEventListener('submit', function() {
                const btn = document.getElementById('btnSubmit');
                btn.innerHTML = '<span>Memproses...</span>';
                btn.classList.add('opacity-70', 'pointer-events-none');
            });
        });
    </script>
</body>

</html>
