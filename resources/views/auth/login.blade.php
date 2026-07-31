<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Eventama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-white min-h-screen flex">

    <!-- Sisi Kiri: Gambar & Branding -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900">
        <!-- Gambar Background -->
        <img src="https://images.unsplash.com/photo-1540317580384-e5d43616b9aa?q=80&w=1200&auto=format&fit=crop" 
             class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay" alt="Event Background">
        
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

        <div class="relative z-10 p-12 flex flex-col justify-between h-full w-full text-white">
            <!-- Logo Area -->
            <div class="flex items-center gap-3 font-bold text-2xl tracking-tight">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-600 text-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                Eventama
            </div>

            <!-- Testimonial Area -->
            <div class="max-w-md">
                <h2 class="text-3xl font-bold leading-tight mb-4 text-white">
                    "Platform yang sangat membantu digitalisasi event dan aktivitas kemahasiswaan kami."
                </h2>
                <p class="font-medium text-slate-300">Tama</p>
            </div>
        </div>
    </div>

    <!-- Sisi Kanan: Form Login -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
        <div class="max-w-md w-full">
            
            <!-- Header Form -->
            <div class="text-center sm:text-left mb-10">
                <h1 class="text-3xl font-bold text-slate-900 mb-3 tracking-tight">Welcome back to Eventama</h1>
                <p class="text-slate-500 font-medium">Build your event management effortlessly with our powerful dashboard.</p>
            </div>

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100">
                    <div class="flex items-center gap-2 mb-1 text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <strong class="text-sm font-bold">Login Gagal</strong>
                    </div>
                    <ul class="list-none text-sm text-red-600 ml-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ Route::is('admin.*') ? route('admin.login.post') : route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Input Email -->
                <div class="relative border-2 @error('email') border-red-400 @else border-slate-200 focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600 @enderror rounded-xl px-4 py-2 transition bg-white">
                    <label class="block text-xs font-semibold text-slate-500 mb-0.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full outline-none bg-transparent text-slate-900 font-medium text-base placeholder-slate-300" 
                           placeholder="admin@eventama.com" required>
                </div>
                
                <!-- Input Password -->
                <div class="relative border-2 @error('password') border-red-400 @else border-slate-200 focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600 @enderror rounded-xl px-4 py-2 transition bg-white">
                    <label class="block text-xs font-semibold text-slate-500 mb-0.5">Password</label>
                    <input type="password" name="password" 
                           class="w-full outline-none bg-transparent text-slate-900 font-medium text-base placeholder-slate-300" 
                           placeholder="••••••••" required>
                </div>

                <!-- Lupa Password & Remember Me -->
                <div class="flex items-center justify-between pt-2">
                    <a href="#" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition">Forgot password?</a>
                    
                    <label class="flex items-center cursor-pointer gap-3">
                        <span class="text-sm font-medium text-slate-500">Remember sign in details</span>
                        <div class="relative">
                            <input type="checkbox" name="remember" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 transition"></div>
                        </div>
                    </label>
                </div>
                
                <!-- Tombol Login -->
                <button type="submit" class="w-full mt-8 py-3.5 bg-indigo-600 text-white rounded-full font-bold text-base hover:bg-indigo-700 transition duration-200 shadow-lg shadow-indigo-600/20">
                    Log in
                </button>
            </form>

            <!-- Garis Pemisah -->
            <div class="flex items-center my-8">
                <div class="flex-grow border-t border-slate-200"></div>
                <span class="px-4 text-xs font-bold text-slate-400">OR</span>
                <div class="flex-grow border-t border-slate-200"></div>
            </div>

            <!-- Tombol Google -->
            <button type="button" class="w-full py-3.5 bg-slate-50 border border-slate-200 text-slate-700 rounded-full font-bold text-base hover:bg-slate-100 transition flex items-center justify-center gap-3">
                <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </button>

            <!-- Link Register -->
            <p class="text-center mt-8 text-sm text-slate-500 font-medium">
                Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Sign up</a>
            </p>

        </div>
    </div>
</body>
</html>