@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-6">
    <div class="max-w-md w-full bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-slate-900 mb-2">Selamat Datang Kembali! 👋</h1>
            <p class="text-slate-500 font-medium text-sm">Masuk ke akun AmikomHub untuk mulai menjelajah event.</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" required placeholder="mhs@students.amikom.ac.id"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-slate-700 placeholder-slate-400">
                @error('email')
                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-bold text-slate-700">Kata Sandi</label>
                    <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Lupa sandi?</a>
                </div>
                <input type="password" name="password" id="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-slate-700 placeholder-slate-400">
            </div>

            <button type="submit" 
                class="w-full py-3.5 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 active:scale-[0.98] transition-all mt-4">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500 font-medium">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline decoration-2 underline-offset-4">
                    Daftar di sini
                </a>
            </p>
        </div>

    </div>
</div>
@endsection