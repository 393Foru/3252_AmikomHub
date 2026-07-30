@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')
<main class="py-6 md:py-10">
    
    <!-- Breadcrumb (Full Width) -->
    <nav class="flex items-center text-sm text-slate-500 font-medium mb-8 whitespace-nowrap overflow-x-auto pb-2 scrollbar-hide">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Beranda
        </a>
        <svg class="w-4 h-4 mx-2 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <a href="{{ route('events.index') ?? '#' }}" class="hover:text-indigo-600 transition-colors">Event</a>
        <svg class="w-4 h-4 mx-2 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <a href="{{ route('events.show', $event->id) }}" class="hover:text-indigo-600 transition-colors max-w-[120px] sm:max-w-[200px] truncate" title="{{ $event->title }}">{{ $event->title }}</a>
        <svg class="w-4 h-4 mx-2 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <span class="text-slate-800 font-bold bg-slate-100 px-2.5 py-1 rounded-md">Checkout</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 lg:items-start">
        
        <!-- Header (Left Column on Desktop, Top on Mobile) -->
        <div class="col-span-1 lg:col-span-7 xl:col-span-8">
            <div class="mb-4 lg:mb-6">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">Checkout Tiket</h1>
                <p class="text-slate-500 mt-2 md:mt-3 text-base md:text-lg">Lengkapi data diri Anda di bawah ini untuk mengamankan tiket.</p>
            </div>
            
            <!-- Error Alert -->
            @if(session('error'))
            <div class="mt-6 mb-2 p-4 md:p-5 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-2xl font-bold flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <p class="text-sm md:text-base">{{ session('error') }}</p>
            </div>
            @endif
        </div>

        <!-- Summary Card (Right Column on Desktop, Middle on Mobile) -->
        <div class="col-span-1 lg:col-span-5 xl:col-span-4 lg:row-span-2 lg:sticky lg:top-24">
            <div class="w-full bg-slate-50 rounded-3xl border border-slate-200 p-6 md:p-8 shadow-sm">
                <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Ringkasan Pesanan
                </h3>
                
                <div class="flex gap-4 md:gap-5 items-start mb-6 pb-6 border-b border-slate-200/60">
                    <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/200x200' }}" alt="Event Poster" class="w-20 h-20 md:w-24 md:h-24 rounded-xl object-cover shadow-sm border border-slate-200">
                    <div class="flex-1">
                        <h4 class="font-bold text-slate-800 leading-snug line-clamp-2">{{ $event->title }}</h4>
                        <div class="mt-2 text-xs md:text-sm font-medium text-slate-500 space-y-1.5">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $event->date->format('d M Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="truncate">{{ $event->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4 md:space-y-5">
                    <div class="flex justify-between text-slate-600 text-sm md:text-base">
                        <span>Harga Tiket (1x)</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600 text-sm md:text-base">
                        <span>Biaya Layanan</span>
                        <span class="font-semibold text-slate-800">Rp 5.000</span>
                    </div>
                    
                    <div class="pt-5 mt-3 border-t-2 border-dashed border-slate-200">
                        <div class="flex justify-between items-end">
                            <span class="text-sm md:text-base font-bold text-slate-800">Total Bayar</span>
                            <span class="text-2xl md:text-3xl font-black text-indigo-600 tracking-tight">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card (Left Column on Desktop, Bottom on Mobile) -->
        <div class="col-span-1 lg:col-span-7 xl:col-span-8">
            <div class="w-full bg-white rounded-3xl border border-slate-200 p-6 md:p-8 lg:p-10 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 pb-6 border-b border-slate-100 gap-4">
                    <h3 class="text-xl md:text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                        <div class="bg-indigo-100 text-indigo-600 p-2 md:p-2.5 rounded-xl">
                            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        Data Pemesan
                    </h3>
                    <span class="inline-block w-fit text-xs font-bold bg-amber-100 text-amber-700 px-3 py-1.5 rounded-full ring-1 ring-amber-200/50">Checkout sebagai Tamu</span>
                </div>
                
                <form action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6 md:space-y-7">
                    @csrf
                    
                    <!-- Input Nama -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="customer_name" placeholder="Masukkan nama sesuai KTP" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_name') }}">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-7">
                        <!-- Input Email -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email <span class="text-rose-500">*</span></label>
                            <input type="email" name="customer_email" placeholder="contoh@email.com" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_email') }}">
                            <p class="text-[11px] md:text-xs text-slate-500 mt-2.5 font-medium flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                E-Ticket akan dikirim ke email ini
                            </p>
                        </div>
                        
                        <!-- Input WhatsApp -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">No. WhatsApp <span class="text-rose-500">*</span></label>
                            <input type="tel" name="customer_phone" placeholder="08xxxxxxxxxx" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_phone') }}">
                        </div>
                    </div>
                    
                    <div class="pt-8 mt-8 border-t border-slate-100">
                        <button type="submit" class="w-full py-4 md:py-4 bg-indigo-600 text-white rounded-xl font-bold text-lg shadow-lg shadow-indigo-600/20 hover:bg-indigo-700 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2">
                            Lanjut ke Pembayaran
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        <p class="text-center text-xs text-slate-400 mt-4 md:mt-5">Dengan menekan tombol di atas, Anda menyetujui <a href="#" class="text-indigo-600 hover:underline">Syarat & Ketentuan</a> kami.</p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection