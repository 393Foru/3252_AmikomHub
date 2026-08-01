@extends('layouts.app')
@section('content')
    <!-- decorative background -->
    <div class="absolute top-0 inset-x-0 h-[500px] bg-gradient-to-b from-indigo-50/80 to-transparent -z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-0 relative z-10">
        <x-breadcrumb :items="[
            ['label' => 'Katalog Event', 'url' => route('events.index')],
            ['label' => $event->title]
        ]" />
    </div>
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-0 lg:pb-4 pt-4 lg:pt-6 lg:grid lg:grid-cols-12 lg:gap-16 relative z-10 flex flex-col gap-6">
        
        <!-- Header Mobile Only: Kategori & Judul -->
        <div class="block lg:hidden space-y-3 mb-1">
            <span class="inline-block px-3 py-1 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-full text-[10px] font-bold uppercase tracking-widest shadow-sm">
                {{ $event->category->name }}
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 leading-tight tracking-tight break-words">
                {{ $event->title }}
            </h1>
        </div>

        <!-- Left: Poster -->
            <div class="lg:col-span-5 xl:col-span-4">
                <div class="lg:sticky lg:top-24 space-y-6">
                    <!-- Image Wrapper with hover effects, removed dark overlay -->
                <div class="group relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-indigo-200/50 border-4 border-white">
                    <img src="{{ ($event->poster_path) ? (\Illuminate\Support\Str::startsWith($event->poster_path, 'http') ? $event->poster_path : asset('storage/' . $event->poster_path))
                    : 'https://placehold.co/400x600/e2e8f0/6366f1?text=' . urlencode($event->title) }}" alt="{{ $event->title }}"
                    class="w-full object-cover aspect-[3/4] transform group-hover:scale-105 transition-transform duration-700 ease-out">
                </div>

                @php
                    $organizerName = $event->owner->name ?? 'Eventama Partner';
                    $organizerLogo = $event->owner->logo_url ?? null;
                    $hasValidLogo = false;
                    
                    if ($organizerLogo) {
                        if (Str::startsWith($organizerLogo, 'http')) {
                            $hasValidLogo = true;
                        } else {
                            $hasValidLogo = true;
                        }
                    }
                @endphp

                <!-- Organizer Card (Desktop Only - Glassmorphism) -->
                <div class="hidden lg:flex items-start gap-4 p-5 sm:p-6 bg-white/80 backdrop-blur-lg rounded-3xl border border-white shadow-xl shadow-slate-200/40 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    @if($hasValidLogo)
                        <img src="{{ Str::startsWith($organizerLogo, 'http') ? $organizerLogo : asset('storage/' . $organizerLogo) }}" alt="{{ $organizerName }}" class="w-12 h-12 rounded-full object-cover shadow-sm border border-slate-100 bg-white shrink-0 mt-0.5">
                    @else
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-black text-lg shadow-sm shrink-0 mt-0.5">
                            {{ strtoupper(substr($organizerName, 0, 2)) }}
                        </div>
                    @endif
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-[11px] text-slate-400 uppercase tracking-wider mb-1 font-bold">Penyelenggara</p>
                        <p class="font-bold text-slate-800 text-base truncate leading-snug">{{ $organizerName }}</p>
                        <p class="text-[10px] text-indigo-600 font-semibold mt-1 bg-indigo-50 inline-flex items-center px-2 py-0.5 rounded-full border border-indigo-100">
                            <svg class="w-3 h-3 mr-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            <span class="truncate">Verified Organizer</span>
                        </p>
                    </div>
                </div>

                <!-- MOBILE TICKET PASS (Shows only on mobile/tablet) -->
                <div class="block lg:hidden relative bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    <!-- Ticket Cutouts (Half circles on edges) -->
                    <div class="absolute w-6 h-6 bg-slate-50 rounded-full -left-3 top-[55%] -translate-y-1/2 shadow-inner z-10"></div>
                    <div class="absolute w-6 h-6 bg-slate-50 rounded-full -right-3 top-[55%] -translate-y-1/2 shadow-inner z-10"></div>
                    
                    <!-- Top Half: Time & Location -->
                    <div class="grid grid-cols-2 p-5 pb-6 relative bg-gradient-to-br from-white to-slate-50/50">
                        <!-- Waktu -->
                        <div class="border-r-2 border-dashed border-slate-100 pr-4">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-6 h-6 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Tanggal</p>
                            </div>
                            <p class="font-black text-slate-800 text-sm break-words leading-tight">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }}</p>
                            <p class="font-bold text-indigo-600 text-xs mt-0.5">{{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB</p>
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="pl-4 flex flex-col justify-start">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-6 h-6 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Lokasi</p>
                            </div>
                            <p class="font-black text-slate-800 text-sm break-words leading-snug line-clamp-3">{{ $event->location }}</p>
                        </div>
                    </div>
                    
                    <!-- Dashed Divider -->
                    <div class="relative px-6">
                        <div class="w-full border-t-2 border-dashed border-slate-200"></div>
                    </div>

                    <!-- Bottom Half: Organizer -->
                    <div class="p-5 bg-slate-50/50 flex items-center justify-between gap-4 relative">
                        <div class="flex items-center gap-3 min-w-0">
                            @if($hasValidLogo)
                                <img src="{{ Str::startsWith($organizerLogo, 'http') ? $organizerLogo : asset('storage/' . $organizerLogo) }}" alt="{{ $organizerName }}" class="w-10 h-10 rounded-full object-cover shadow-sm border-2 border-white bg-white shrink-0">
                            @else
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-black text-sm shadow-sm border-2 border-white shrink-0">
                                    {{ strtoupper(substr($organizerName, 0, 2)) }}
                                </div>
                            @endif
                            
                            <div class="min-w-0">
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold mb-0.5">Penyelenggara</p>
                                <p class="font-bold text-slate-800 text-sm truncate leading-snug">{{ $organizerName }}</p>
                            </div>
                        </div>
                        
                        <div class="shrink-0 bg-white shadow-sm border border-slate-100 rounded-full w-8 h-8 flex items-center justify-center text-indigo-600" title="Verified Organizer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Details -->
        <div class="lg:col-span-7 xl:col-span-8 flex flex-col gap-5 lg:gap-14">
            
            <!-- Desktop Header & Info Wrapper -->
            <div class="hidden lg:flex flex-col gap-4 lg:gap-6">
                
                <!-- Header Desktop Only -->
                <div class="space-y-6">
                    <span class="inline-block px-4 py-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-full text-xs font-bold uppercase tracking-widest shadow-md">{{ $event->category->name }}</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 leading-tight tracking-tight break-words">{{ $event->title }}</h1>
                </div>
                
                <!-- Info Cards (Waktu & Lokasi) - Desktop Only -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 pt-0 lg:pt-5 lg:border-t lg:border-slate-100">
                    
                    <!-- Waktu -->
                    <div class="flex items-start gap-4 p-5 sm:p-6 bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 hover:-translate-y-1 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0 shadow-inner mt-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] text-slate-400 uppercase tracking-wider mb-1 font-bold">Waktu Pelaksanaan</p>
                            <p class="text-slate-800 font-black text-sm lg:text-base break-words leading-snug">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }}</p>
                            <p class="text-slate-500 font-bold text-sm mt-0.5">{{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                    
                    <!-- Lokasi -->
                    <div class="flex items-start gap-4 p-5 sm:p-6 bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 hover:-translate-y-1 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600 shrink-0 shadow-inner mt-0.5">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[11px] text-slate-400 uppercase tracking-wider mb-1 font-bold">Lokasi Event</p>
                            <p class="text-slate-800 font-black text-sm lg:text-base break-words leading-snug">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="prose prose-slate prose-lg max-w-none">
                <h3 class="text-2xl font-black text-slate-800 flex items-center gap-3 mb-6">
                    <span class="w-8 h-1.5 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full inline-block shrink-0"></span> 
                    Deskripsi Event
                </h3>
                <div class="relative">
                    <div id="description-content" class="text-slate-600 leading-relaxed space-y-4 prose-p:mb-4 prose-ul:list-disc prose-ul:ml-5 prose-ol:list-decimal prose-ol:ml-5 prose-headings:font-bold prose-headings:text-slate-800 prose-headings:mt-6 prose-headings:mb-3 break-words overflow-hidden transition-all duration-700 ease-in-out" style="max-height: 12rem;">
                        {!! $event->description !!}
                    </div>
                    
                    <!-- Gradient Overlay (Fade effect) -->
                    <div id="description-overlay" class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-[#f0f6fa] via-[#f0f6fa]/80 to-transparent pointer-events-none transition-opacity duration-500"></div>
                </div>
                
                <button id="toggle-description" class="mt-3 inline-flex items-center gap-1.5 text-slate-500 font-bold hover:text-slate-800 transition group cursor-pointer">
                    <span id="toggle-text">Baca Selengkapnya</span>
                    <svg id="toggle-icon" class="w-4 h-4 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            <!-- Booking Section -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-200 relative overflow-hidden group">
                
                <!-- Decorative background elements -->
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-50/50 rounded-full group-hover:scale-150 transition-transform duration-700 z-0 pointer-events-none"></div>
                <div class="absolute -left-10 -bottom-10 w-24 h-24 bg-blue-50/50 rounded-full group-hover:scale-150 transition-transform duration-700 z-0 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 sm:gap-6">
                    <div class="flex items-center gap-4 flex-1 min-w-0 w-full sm:w-auto">
                        <!-- Ticket Icon -->
                        <div class="hidden sm:flex w-12 h-12 rounded-xl bg-indigo-50 items-center justify-center text-indigo-600 shrink-0 border border-indigo-100/50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        
                        <div class="flex flex-col justify-center min-w-0 flex-1">
                            <div class="flex flex-wrap items-baseline gap-x-2 gap-y-1 mb-1">
                                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight break-words">Rp {{ number_format($event->price, 0, ',', '.') }}</h2>
                                <span class="text-slate-500 font-medium text-sm">/ tiket</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 text-xs">
                                <span class="inline-flex items-center gap-1.5 text-emerald-700 font-bold bg-emerald-100/80 px-2 py-0.5 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                                    Tersedia
                                </span>
                                <span class="text-slate-300 hidden sm:inline-block shrink-0">•</span>
                                <span class="text-slate-600 font-medium">Sisa <span class="text-indigo-600 font-bold">{{ $event->stock }}</span> kuota</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full sm:w-auto shrink-0">
                        <a href="{{ url('checkout/'.$event->id) }}"
                            class="flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-2.5 bg-indigo-600 text-white rounded-lg font-bold text-sm hover:bg-indigo-700 hover:shadow-md transition-all duration-200 whitespace-nowrap">
                            Pesan Sekarang
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            @if($reviews->count() > 0)
            <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                        <span class="w-8 h-1.5 bg-gradient-to-r from-amber-400 to-amber-500 rounded-full inline-block shrink-0"></span> 
                        Ulasan Peserta
                    </h3>
                    <div class="flex items-center gap-2 font-bold text-amber-500 bg-amber-50 px-3 py-1 rounded-full">
                        <i class="fas fa-star"></i> {{ number_format($averageRating, 1) }}
                    </div>
                </div>
                
                <div class="space-y-4">
                    @foreach($reviews as $review)
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <span class="font-bold text-slate-700 text-sm">{{ $review->transaction->customer_name }}</span>
                            <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex text-amber-400 text-xs mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star text-slate-300"></i>
                                @endif
                            @endfor
                        </div>
                        @if($review->comment)
                            <p class="text-slate-600 text-sm italic line-clamp-3">"{{ $review->comment }}"</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Ticket Policy -->
            <div class="bg-slate-50/50 rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-200">
                <h3 class="text-xl font-bold mb-6 text-slate-800 flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Kebijakan Tiket
                </h3>
                
                <div class="relative">
                    <div id="policy-content" class="overflow-hidden transition-all duration-700 ease-in-out" style="max-height: 11rem;">
                        <ul class="space-y-4">
                            <li class="flex items-start sm:items-center gap-4 bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-slate-100/50 hover:shadow-md transition-shadow">
                                <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="text-sm sm:text-base text-slate-700 font-medium leading-snug">E-Ticket akan dikirimkan otomatis ke email Anda setelah pembayaran terverifikasi.</div>
                            </li>
                            <li class="flex items-start sm:items-center gap-4 bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-slate-100/50 hover:shadow-md transition-shadow">
                                <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <div class="text-sm sm:text-base text-slate-700 font-medium leading-snug">Wajib menunjukkan kartu identitas asli yang sesuai dengan nama pada tiket saat Check-in.</div>
                            </li>
                            <li class="flex items-start sm:items-center gap-4 bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-slate-100/50 hover:shadow-md transition-shadow">
                                <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <div class="text-sm sm:text-base text-slate-700 font-medium leading-snug">Tiket dapat discan di pintu masuk (Check-in) menggunakan QR Code yang sah.</div>
                            </li>
                            <li class="flex items-start sm:items-center gap-4 bg-rose-50/80 p-4 sm:p-5 rounded-xl border border-rose-100 hover:shadow-md transition-shadow">
                                <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <div class="text-sm sm:text-base text-rose-800 font-bold leading-snug">Tiket yang sudah dibeli tidak dapat di-refund, ditukar, atau dibatalkan.</div>
                            </li>
                        </ul>
                    </div>
                    <!-- Gradient Overlay -->
                    <div id="policy-overlay" class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-[#f8fafc] via-[#f8fafc]/90 to-transparent pointer-events-none transition-opacity duration-500"></div>
                </div>
                
                <button id="toggle-policy" class="mt-3 inline-flex items-center gap-1.5 text-slate-500 font-bold hover:text-slate-800 transition group cursor-pointer">
                    <span id="policy-toggle-text">Lihat Semua Kebijakan</span>
                    <svg id="policy-toggle-icon" class="w-4 h-4 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Event Serupa Section -->
    @if($similarEvents->count() > 0)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 border-t border-slate-200/60 mt-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight mb-2">Event Serupa</h2>
                <p class="text-slate-500 text-sm">Temukan event menarik lainnya di kategori {{ $event->category->name }}</p>
            </div>
            <a href="{{ route('events.index', ['category' => $event->category->slug]) }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-full hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition-colors shadow-sm text-sm">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-6">
            @foreach($similarEvents as $index => $similar)
                <div class="{{ $index >= 2 ? 'hidden lg:block' : '' }} h-full">
                    <x-event-card :event="$similar" />
                </div>
            @endforeach
        </div>
        
        <!-- Mobile button -->
        <div class="mt-8 text-center sm:hidden">
            <a href="{{ route('events.index', ['category' => $event->category->slug]) }}" class="inline-flex items-center justify-center w-full gap-2 px-5 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-full hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition-colors shadow-sm text-sm">
                Lihat Semua {{ $event->category->name }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi reusable untuk toggle Read More / Show Less
            function setupToggle(contentId, overlayId, btnId, textId, iconId, maxHeight, showText, hideText) {
                const content = document.getElementById(contentId);
                const overlay = document.getElementById(overlayId);
                const toggleBtn = document.getElementById(btnId);
                const toggleText = document.getElementById(textId);
                const toggleIcon = document.getElementById(iconId);
                
                if (content && toggleBtn) {
                    // Cek apakah konten lebih tinggi dari batas max-height (ditambah sedikit toleransi)
                    if (content.scrollHeight <= maxHeight + 20) {
                        toggleBtn.style.display = 'none';
                        if (overlay) overlay.style.display = 'none';
                        content.style.maxHeight = 'none';
                    } else {
                        let isExpanded = false;
                        
                        toggleBtn.addEventListener('click', function() {
                            isExpanded = !isExpanded;
                            
                            if (isExpanded) {
                                content.style.maxHeight = content.scrollHeight + 'px';
                                if (overlay) overlay.style.opacity = '0';
                                toggleText.textContent = hideText;
                                toggleIcon.classList.remove('group-hover:translate-y-0.5');
                                toggleIcon.classList.add('rotate-180', 'group-hover:-translate-y-0.5');
                            } else {
                                // Set kembali ke tinggi semula (dalam px)
                                content.style.maxHeight = maxHeight + 'px';
                                if (overlay) overlay.style.opacity = '1';
                                toggleText.textContent = showText;
                                toggleIcon.classList.remove('rotate-180', 'group-hover:-translate-y-0.5');
                                toggleIcon.classList.add('group-hover:translate-y-0.5');
                            }
                        });
                    }
                }
            }

            // Inisialisasi Toggle untuk Deskripsi Event (12rem = 192px)
            setupToggle('description-content', 'description-overlay', 'toggle-description', 'toggle-text', 'toggle-icon', 192, 'Baca Selengkapnya', 'Sembunyikan');
            
            // Inisialisasi Toggle untuk Kebijakan Tiket (11rem = 176px)
            setupToggle('policy-content', 'policy-overlay', 'toggle-policy', 'policy-toggle-text', 'policy-toggle-icon', 176, 'Lihat Semua Kebijakan', 'Sembunyikan Kebijakan');
        });
    </script>
    @endpush
@endsection