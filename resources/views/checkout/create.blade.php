@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-12 md:py-20">
    
    <!-- Header & Back Button -->
    <div class="mb-10">
        <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-indigo-600 font-bold rounded-full shadow-sm ring-1 ring-slate-200 hover:shadow-md hover:bg-indigo-50 transition-all mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Detail Event
        </a>
        <h1 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight">Checkout Tiket</h1>
        <p class="text-slate-500 mt-3 text-lg">Lengkapi data diri Anda di bawah ini untuk mengamankan tiket.</p>
    </div>

    <!-- Error Alert -->
    @if(session('error'))
    <div class="mb-8 p-5 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-2xl font-bold flex items-center gap-3 shadow-sm">
        <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 gap-8">
        
        <!-- Summary Card -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 md:p-8 shadow-lg shadow-slate-200/50">
            <h3 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Ringkasan Pesanan
            </h3>
            
            <div class="flex flex-col md:flex-row gap-6 items-start bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/200x200' }}" alt="Event Poster" class="w-24 h-24 md:w-28 md:h-28 rounded-xl object-cover shadow-md ring-1 ring-slate-200">
                <div class="flex-1">
                    <h4 class="font-black text-xl text-slate-800 leading-tight">{{ $event->title }}</h4>
                    <div class="flex flex-wrap items-center gap-3 mt-2 text-sm font-medium text-slate-500">
                        <span class="flex items-center gap-1 bg-white px-3 py-1 rounded-full shadow-sm ring-1 ring-slate-200">
                            📅 {{ $event->date->format('d M Y') }}
                        </span>
                        <span class="flex items-center gap-1 bg-white px-3 py-1 rounded-full shadow-sm ring-1 ring-slate-200">
                            📍 {{ $event->location }}
                        </span>
                    </div>
                    <p class="text-indigo-600 font-black text-lg mt-4">1 x Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <div class="mt-8 space-y-4">
                <div class="flex justify-between text-slate-500 font-medium px-2">
                    <span>Harga Tiket</span>
                    <span class="text-slate-800 font-bold">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-slate-500 font-medium px-2">
                    <span>Biaya Layanan</span>
                    <span class="text-slate-800 font-bold">Rp 5.000</span>
                </div>
                <div class="flex justify-between text-2xl font-black mt-6 pt-6 border-t-2 border-dashed border-slate-200 px-2">
                    <span class="text-slate-800">Total Bayar</span>
                    <span class="text-indigo-600">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 md:p-8 shadow-lg shadow-slate-200/50">
            <h3 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">
                <span class="text-2xl">📦</span> Data Pemesan <span class="text-sm font-semibold bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full ml-2">Tanpa Login</span>
            </h3>
            
            <form action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Input Nama -->
                <div>
                    <label class="block text-xs font-black text-slate-500 mb-2 uppercase tracking-widest">Nama Lengkap</label>
                    <input type="text" name="customer_name" placeholder="Masukkan nama sesuai identitas asli" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_name') }}">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Input Email -->
                    <div>
                        <label class="block text-xs font-black text-slate-500 mb-2 uppercase tracking-widest">Email Aktif</label>
                        <input type="email" name="customer_email" placeholder="contoh@gmail.com" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_email') }}">
                        <p class="text-[11px] text-indigo-500 mt-2 font-bold flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            E-Ticket akan dikirim ke email ini
                        </p>
                    </div>
                    
                    <!-- Input WhatsApp -->
                    <div>
                        <label class="block text-xs font-black text-slate-500 mb-2 uppercase tracking-widest">No. WhatsApp</label>
                        <input type="tel" name="customer_phone" placeholder="08xxxxxxxxxx" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_phone') }}">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-xl font-black text-lg shadow-lg shadow-indigo-600/30 hover:bg-indigo-700 hover:shadow-indigo-600/40 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        Lanjut ke Pembayaran
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <p class="text-center text-xs text-slate-400 mt-4 font-medium">Dengan menekan tombol di atas, Anda menyetujui Syarat & Ketentuan kami.</p>
                </div>
            </form>
        </div>

    </div>
</main>
@endsection