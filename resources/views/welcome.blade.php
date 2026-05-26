@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <div
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-xs md:text-sm font-bold uppercase tracking-widest shadow-sm">
            <span class="relative flex h-2 w-2">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
            </span>
            #1 Event Platform di Amikom
        </div>

        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 leading-[1.1] tracking-tight">
            Temukan & Pesan <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                Tiket Event
            </span>
            Impianmu.
        </h1>

        <p class="text-lg md:text-xl text-slate-600 max-w-xl mx-auto md:mx-0 leading-relaxed font-medium">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan <span
                class="text-slate-900 font-bold underline decoration-indigo-300">aman & cepat</span> dengan Midtrans.
        </p>

        <div class="flex gap-4">
            <a href="#events"
                class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>
            <a href="#"
                class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                Cara Pesan
            </a>
        </div>
        <div class="pt-4 flex items-center justify-center md:justify-start gap-4 text-slate-400">
            <div class="flex -space-x-2">
                <img class="w-8 h-8 rounded-full border-2 border-white"
                    src="https://ui-avatars.com/api/?name=User+1&bg=6366f1&color=fff" alt="">
                <img class="w-8 h-8 rounded-full border-2 border-white"
                    src="https://ui-avatars.com/api/?name=User+2&bg=a855f7&color=fff" alt="">
                <img class="w-8 h-8 rounded-full border-2 border-white"
                    src="https://ui-avatars.com/api/?name=User+3&bg=ec4899&color=fff" alt="">
            </div>
            <p class="text-sm font-medium"><span class="text-slate-900 font-bold">1,000+</span> Mahasiswa sudah
                bergabung</p>
        </div>
    </div>
    <div class="flex-1 relative">
        <div
            class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <img src="assets/concert.png" alt="Concert"
            class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="events" class="max-w-7xl mx-auto px-6 py-12">

    <div class="flex flex-col lg:flex-row justify-between items-center lg:items-end mb-12 gap-8">

        <div class="text-center lg:text-left w-full lg:w-auto">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 font-extrabold text-[10px] uppercase tracking-widest mb-4 border border-indigo-100 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                Jelajahi Kategori
            </div>

            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3 tracking-tight">Event Terdekat</h2>
            <p class="text-slate-500 font-medium text-lg">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>

        <div class="flex flex-wrap justify-center lg:justify-end gap-3 w-full lg:w-auto">

            <a href="{{ route('home') }}#events"
                class="flex items-center gap-2 px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ !request('category') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200 scale-105 ring-4 ring-indigo-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 hover:shadow-md' }}">
                <svg class="w-4 h-4 {{ !request('category') ? 'text-indigo-200' : 'text-slate-400' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Semua Event
            </a>

            @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat->slug]) }}#events"
                class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200 scale-105 ring-4 ring-indigo-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 hover:shadow-md' }}">
                {{ $cat->name }}
            </a>
            @endforeach

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
        <div
            class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="relative overflow-hidden aspect-[3/4]">
                <img src="https://placehold.co/400x600/e2e8f0/6366f1?text={{ urlencode($event->title) }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                <div
                    class="absolute top-4 left-4 px-3 py-1 bg-white/95 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600 shadow-sm">
                    {{ $event->category->name ?? 'Uncategorized' }}
                </div>
            </div>

            <div class="p-6 flex flex-col flex-1">
                <h3 class="text-xl font-bold mb-3 group-hover:text-indigo-600 transition line-clamp-2">
                    {{ $event->title }}
                </h3>

                <div class="flex items-center gap-2 text-slate-500 text-sm mb-6">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-slate-100 mt-auto">
                    <span class="text-2xl font-black text-indigo-600">
                        {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                    </span>

                    <a href="{{ route('events.show', $event->id) }}"
                        class="px-5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
            <div
                class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-700 mb-1">Oops, Belum Ada Event</h3>
            <p class="text-slate-500">Coba pilih kategori lain atau cek kembali nanti.</p>
        </div>
        @endforelse
    </div>
    <div class="mt-12 flex justify-center w-full">
        {{ $events->links() }}
    </div>
</section>

<section class="py-16 bg-slate-50 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-xs font-bold uppercase tracking-widest text-indigo-600 mb-2">Our Network</p>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Didukung Oleh Partner Terbaik</h2>
            <p class="text-slate-500 font-medium mt-1">Kolaborasi erat bersama berbagai instansi dan perusahaan terpercaya.</p>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-16">
            @forelse($partners as $partner)
                <div class="group relative flex items-center justify-center p-4 grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                    <div class="w-32 h-16 flex items-center justify-center">
                        <img src="{{ Storage::url($partner->logo_url) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform" title="{{ $partner->name }}">
                    </div>
                </div>
            @empty
                <div class="text-center text-slate-400 text-sm font-medium py-4">
                    AmikomEventHub membuka peluang kolaborasi bersama partner baru.
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection