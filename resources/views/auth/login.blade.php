<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Dospem LPKIA</title>

    <!-- Tailwind tetap dipertahankan untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Vite untuk memanggil JS hasil install NPM -->
    @vite(['resources/js/app.js'])

    <style>
        button#togglePassword {
            z-index: 10;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        }

        .gradient-btn {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            transition: all 0.3s ease;
        }

        .gradient-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.3);
        }

        .input-focus:focus {
            ring: 4px;
            ring-color: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Custom SweetAlert Style */
        .swal2-popup {
            border-radius: 24px !important;
            padding: 2rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>

<body class="p-4">

    <div class="w-full max-w-md animate-slide-up">

        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex p-3 bg-white rounded-2xl shadow-sm border border-slate-100 mb-4">
                <img src="{{ asset('logo-lpkia.png') }}" alt="Logo LPKIA" class="h-12 w-auto">
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-slate-500 text-sm mt-1">Sistem Informasi Pendaftaran Dospem LPKIA</p>
        </div>

        <!-- Login Card -->
        <div class="glass-container rounded-[2.5rem] p-8 md:p-10">

            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold uppercase tracking-wider text-slate-500 ml-1">
                        Email Institusi
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <span data-lucide="mail" class="w-5 h-5"></span>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="w-full pl-11 pr-4 py-4 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700 placeholder:text-slate-400"
                            placeholder="nama@lpkia.ac.id">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            Kata Sandi
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                Lupa Password?
                            </a>
                        @endif
                    </div>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <span data-lucide="lock" class="w-5 h-5"></span>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="w-full pl-11 pr-12 py-4 bg-white border border-slate-200 rounded-2xl outline-none transition-all input-focus text-slate-700 placeholder:text-slate-400"
                            placeholder="••••••••">

                        <!-- Toggle Password Visibility -->
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">

                            <span id="eyeWrapper">
                                <span data-lucide="eye" class="w-5 h-5"></span>
                            </span>

                            <span id="eyeOffWrapper" class="hidden">
                                <span data-lucide="eye-off" class="w-5 h-5"></span>
                            </span>

                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center ml-1">
                    <label class="relative flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="sr-only peer">
                        <div
                            class="w-10 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-slate-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="btnSubmit"
                    class="gradient-btn w-full text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-2 group">
                    <span>Masuk ke Panel</span>
                    <span data-lucide="log-in" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></span>
                </button>
            </form>

            <!-- Footer Note -->
            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-slate-400 text-xs font-medium">
                    Hanya untuk Admin & Staff Program Studi
                </p>
                <a href="/"
                    class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 mt-4 hover:text-blue-600 transition-colors group">
                    <span data-lucide="arrow-left"
                        class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></span>
                    Kembali ke Form Mahasiswa
                </a>
            </div>
        </div>

        <p class="text-center text-slate-400 text-[10px] mt-8 uppercase tracking-[0.2em]">
            &copy; {{ date('Y') }} Institut Digital Ekonomi LPKIA
        </p>
    </div>

    <!-- Script Section -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Karena pakai NPM, lucide harus dipanggil melalui window yang di-expose di app.js
            const refreshIcons = () => {
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            };
            // Inisialisasi awal ikon
            refreshIcons();

            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eye = document.getElementById('eyeWrapper');
            const eyeOff = document.getElementById('eyeOffWrapper');

            toggleBtn.addEventListener('click', (e) => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';

                eye.classList.toggle('hidden');
                eyeOff.classList.toggle('hidden');
            });
            console.log("Swal:", window.Swal);
            // SweetAlert2 Handling (Menggunakan window.Swal dari app.js)
            const showToast = (icon, title) => {
                if (window.Swal) {
                    window.Swal.fire({
                        icon: icon,
                        title: title,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }
            };

            // Error handling Laravel
            @if ($errors->any())
                if (window.Swal) {
                    window.Swal.fire({
                        icon: 'error',
                        title: 'Akses Ditolak',
                        text: 'Email atau password yang Anda masukkan tidak valid.',
                        confirmButtonColor: '#0f172a',
                        confirmButtonText: 'Coba Lagi',
                        customClass: {
                            popup: 'swal2-popup'
                        }
                    });
                }
            @endif

            @if (session('status'))
                showToast('success', "{{ session('status') }}");
            @endif

            // Loading State on Submit
            const loginForm = document.getElementById('loginForm');
            const btnSubmit = document.getElementById('btnSubmit');

            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault(); // ❗ penting: stop reload

                btnSubmit.disabled = true;
                btnSubmit.innerHTML = `
        <span data-lucide="loader-2" class="w-5 h-5 animate-spin"></span>
        <span>Memproses...</span>
    `;
                refreshIcons();

                const formData = new FormData(loginForm);

                try {
                    const response = await fetch(loginForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();

                        window.Swal.fire({
                            icon: 'success',
                            title: 'Login berhasil!',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => {
                            if (data.role === 'superadmin') {
                                window.location.href = '/superadmin/home';
                            } else if (data.role === 'admin') {
                                window.location.href = '/admin/home';
                            } else if (data.role === 'mahasiswa') {
                                window.location.href = '/mahasiswa/home';
                            }
                        }, 1500);
                    } else {
                        let data = null;

                        try {
                            data = await response.json();
                        } catch (e) {
                            console.warn("Bukan JSON, kemungkinan dari Laravel redirect");
                        }

                        window.Swal.fire({
                            icon: 'error',
                            title: 'Login gagal',
                            text: data?.message || 'Email atau password salah'
                        });
                    }

                } catch (error) {
                    console.error(error);
                    window.Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan server'
                    });
                }

                // 🔥 WAJIB ADA DI SINI
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = `
    <span>Masuk ke Panel</span>
    <span data-lucide="log-in" class="w-5 h-5"></span>
`;
                refreshIcons();
            });
        });
    </script>
</body>

</html>
