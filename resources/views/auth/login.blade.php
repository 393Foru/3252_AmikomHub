<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eventama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        .colored-toast.swal2-icon-error {
            background-color: #fef2f2 !important;
            color: #991b1b !important;
        }
    </style>
</head>
<body class="bg-white selection:bg-blue-200 selection:text-blue-900">
    <!-- Wrapper utama -->
    <div class="flex min-h-screen w-full">
        <!-- Sisi Kiri: Gambar & Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 overflow-hidden">
        <!-- Gambar Background -->
        <img src="https://images.unsplash.com/photo-1540317580384-e5d43616b9aa?q=80&w=1200&auto=format&fit=crop" 
             class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay hover:scale-105 transition-transform duration-1000" alt="Event Background">
        
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-blue-800/80 to-cyan-900/90"></div>

        <div class="relative z-10 p-12 flex flex-col justify-between h-full w-full text-white">
            <!-- Logo Area -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-bold text-2xl tracking-tight hover:opacity-80 transition w-max">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-600 text-lg shadow-lg">
                    EvT
                </div>
                <span class="text-white">Event<span class="text-cyan-400">ama</span></span>
            </a>

            <!-- Testimonial Area -->
            <div class="max-w-md backdrop-blur-md bg-white/10 p-8 rounded-3xl border border-white/20 shadow-2xl">
                <div class="flex gap-1 mb-4 text-amber-400 text-sm">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h2 class="text-2xl font-bold leading-tight mb-4 text-white">
                    "Platform yang sangat membantu digitalisasi event dan aktivitas kemahasiswaan kami."
                </h2>
                <div class="flex items-center gap-4 mt-6">
                    <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center font-bold text-xl border-2 border-white/50">
                        T
                    </div>
                    <div>
                        <p class="font-bold text-white">Tama</p>
                        <p class="text-sm text-blue-200">Mahasiswa Universitas Amikom</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sisi Kanan: Form Login -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-blue-50 opacity-50 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-cyan-50 opacity-50 blur-3xl pointer-events-none"></div>

        <div class="max-w-md w-full relative z-10 py-6">
            
            <!-- Tombol Kembali (Di atas) -->
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors mb-10">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <!-- Mobile Logo -->
            <div class="lg:hidden flex items-center justify-center gap-2 mb-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white text-lg font-bold shadow-lg shadow-blue-200">
                        EvT
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-cyan-700">
                        Eventama
                    </span>
                </a>
            </div>

            <!-- Header Form -->
            <div class="text-center lg:text-left mb-10">
                <h1 class="text-3xl font-extrabold text-slate-900 mb-3 tracking-tight">Selamat Datang Kembali</h1>
                <p class="text-slate-500 font-medium">Masuk untuk mengelola event atau mencari event seru berikutnya.</p>
            </div>

            <!-- Error ditangani via SweetAlert2 di bagian bawah script -->

            <form id="loginForm" action="{{ Route::is('admin.*') ? route('admin.login.post') : route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Input Email -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border @error('email') border-red-400 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition-all text-slate-700 placeholder-slate-400 font-medium" 
                               placeholder="nama@email.com" required autofocus>
                    </div>
                </div>
                
                <!-- Input Password -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" 
                               class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border @error('password') border-red-400 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition-all text-slate-700 placeholder-slate-400 font-medium" 
                               placeholder="••••••••" required>
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-blue-500 focus:outline-none transition-colors">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Lupa Password & Remember Me -->
                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center cursor-pointer gap-2 group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition-all cursor-pointer">
                        </div>
                        <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Ingat saya</span>
                    </label>
                    
                    <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-700 transition">Lupa sandi?</a>
                </div>
                
                <!-- Tombol Login -->
                <button type="submit" id="loginBtn" class="w-full mt-6 py-4 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-xl font-bold text-base hover:from-blue-700 hover:to-cyan-700 hover:shadow-lg hover:shadow-blue-200/50 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex justify-center items-center gap-2">
                    <span id="btnText">Masuk Sekarang</span>
                    <i id="btnSpinner" class="fas fa-circle-notch fa-spin hidden"></i>
                </button>
            </form>

            <!-- Garis Pemisah -->
            <div class="flex items-center my-8">
                <div class="flex-grow border-t border-slate-200"></div>
                <span class="px-4 text-xs font-bold text-slate-400 bg-white">ATAU MASUK DENGAN</span>
                <div class="flex-grow border-t border-slate-200"></div>
            </div>

            <!-- Tombol Google -->
            <a href="{{ route('google.redirect') }}" class="w-full py-3.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-50 hover:border-slate-300 hover:shadow-sm transition-all flex items-center justify-center gap-3">
                <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </a>

            <!-- Link Register -->
            <p class="text-center mt-10 text-sm text-slate-500 font-medium">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:text-blue-700 hover:underline decoration-2 underline-offset-4 transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </div>
    </div>
    <!-- Script untuk UX -->
    <script>
        // SweetAlert2 Error Notification
        @if ($errors->any())
            let errorMsg = '';
            @foreach ($errors->all() as $error)
                errorMsg += '{{ $error }}<br>';
            @endforeach
            
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                html: errorMsg,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                }
            });
        @endif

        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Button Loading State
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        loginForm.addEventListener('submit', function() {
            loginBtn.disabled = true;
            loginBtn.classList.add('opacity-80', 'cursor-not-allowed');
            btnText.textContent = 'Memproses...';
            btnSpinner.classList.remove('hidden');
        });
    </script>
</body>
</html>