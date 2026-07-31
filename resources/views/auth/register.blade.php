@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-6">
    <div class="max-w-md w-full bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-slate-900 mb-2">Buat Akun Baru ✨</h1>
            <p class="text-slate-500 font-medium text-sm">Bergabunglah dan temukan event seru di sekitarmu.</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" required placeholder="cth: Rahmat Ramadhan"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-slate-700 placeholder-slate-400">
                @error('name')
                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" required placeholder="cth: nama@domain.com"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-slate-700 placeholder-slate-400">
                @error('email')
                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi</label>
                <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-slate-700 placeholder-slate-400">
                @error('password')
                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Ulangi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ketik ulang kata sandi"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-slate-700 placeholder-slate-400">
            </div>

            <button type="submit" 
                class="w-full py-3.5 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 active:scale-[0.98] transition-all mt-6">
                Daftar Sekarang
            </button>
        </form>

        <!-- Garis Pemisah -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-slate-200"></div>
            <span class="px-4 text-xs font-bold text-slate-400 bg-white">ATAU</span>
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
            Daftar dengan Google
        </a>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500 font-medium">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline decoration-2 underline-offset-4">
                    Masuk di sini
                </a>
            </p>
        </div>

    </div>
</div>
@endsection