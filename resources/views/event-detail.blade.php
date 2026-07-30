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
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-0 lg:pb-4 pt-4 lg:pt-6 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 relative z-10">
        <!-- Left: Poster -->
        <div class="lg:col-span-5 xl:col-span-4">
            <div class="sticky top-32 space-y-6">
                <!-- Image Wrapper with hover effects, removed dark overlay -->
                <div class="group relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-indigo-200/50 border-4 border-white">
                    <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path)
                    : 'https://placehold.co/400x600/e2e8f0/6366f1?text=' . urlencode($event->title) }}" alt="{{ $event->title }}"
                    class="w-full object-cover aspect-[3/4] transform group-hover:scale-105 transition-transform duration-700 ease-out">
                </div>

                <!-- Organizer Card (Glassmorphism) -->
                <div class="p-6 bg-white/70 backdrop-blur-lg rounded-3xl border border-white shadow-xl shadow-slate-200/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Penyelenggara</h4>
                    <div class="flex items-center gap-4">
                        @php
                            $organizerName = $event->owner->name ?? 'Eventama Partner';
                            $organizerLogo = $event->owner->logo_url ?? null;
                            $hasValidLogo = false;
                            
                            if ($organizerLogo) {
                                if (Str::startsWith($organizerLogo, 'http')) {
                                    $hasValidLogo = true;
                                } else {
                                    $hasValidLogo = Storage::disk('public')->exists($organizerLogo);
                                }
                            }
                        @endphp
                        
                        @if($hasValidLogo)
                            <img src="{{ Str::startsWith($organizerLogo, 'http') ? $organizerLogo : asset('storage/' . $organizerLogo) }}" alt="{{ $organizerName }}" class="w-14 h-14 rounded-full object-cover shadow-lg border-2 border-white bg-white">
                        @else
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg">
                                {{ strtoupper(substr($organizerName, 0, 2)) }}
                            </div>
                        @endif
                        
                        <div>
                            <p class="font-bold text-slate-800 text-lg">{{ $organizerName }}</p>
                            <p class="text-xs text-indigo-600 font-semibold mt-0.5 bg-indigo-50 inline-block px-3 py-1 rounded-full border border-indigo-100">
                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Verified Organizer
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Details -->
        <div class="lg:col-span-7 xl:col-span-8 space-y-10 lg:space-y-14">
            <div class="space-y-6">
                <span
                    class="inline-block px-4 py-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-full text-xs font-bold uppercase tracking-widest shadow-md">{{ $event->category->name }}</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 leading-tight tracking-tight">{{ $event->title }}</h1>
                
                <div class="flex flex-col sm:flex-row flex-wrap gap-4 sm:gap-6 text-slate-600 font-medium pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-3 bg-white px-5 py-4 rounded-2xl shadow-sm border border-slate-50 flex-1 min-w-[240px]">
                        <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Waktu Pelaksanaan</p>
                            <p class="text-slate-800 font-bold text-sm lg:text-base">{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-white px-5 py-4 rounded-2xl shadow-sm border border-slate-50 flex-1 min-w-[240px]">
                        <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Lokasi</p>
                            <p class="text-slate-800 font-bold text-sm lg:text-base">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="prose prose-slate prose-lg max-w-none">
                <h3 class="text-2xl font-black text-slate-800 flex items-center gap-3 mb-6">
                    <span class="w-8 h-1.5 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full inline-block"></span> 
                    Deskripsi Event
                </h3>
                <div class="text-slate-600 leading-relaxed space-y-4 prose-p:mb-4 prose-ul:list-disc prose-ul:ml-5 prose-ol:list-decimal prose-ol:ml-5 prose-headings:font-bold prose-headings:text-slate-800 prose-headings:mt-6 prose-headings:mb-3">
                    {!! $event->description !!}
                </div>
            </div>

            <!-- Booking Section -->
            <div
                class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-200 relative overflow-hidden group">
                
                <!-- Decorative background elements -->
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-50/50 rounded-full group-hover:scale-150 transition-transform duration-700 z-0 pointer-events-none"></div>
                <div class="absolute -left-10 -bottom-10 w-24 h-24 bg-blue-50/50 rounded-full group-hover:scale-150 transition-transform duration-700 z-0 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-6">
                    <div class="flex items-center gap-4 flex-1 min-w-0 w-full sm:w-auto">
                        <!-- Ticket Icon -->
                        <div class="hidden sm:flex w-12 h-12 rounded-xl bg-indigo-50 items-center justify-center text-indigo-600 shrink-0 border border-indigo-100/50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        
                        <div class="flex flex-col justify-center min-w-0 flex-1">
                            <div class="flex items-baseline gap-2 mb-1 whitespace-nowrap">
                                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Rp {{ number_format($event->price, 0, ',', '.') }}</h2>
                                <span class="text-slate-500 font-medium text-sm">/ tiket</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 text-emerald-700 font-bold bg-emerald-100/80 px-2 py-0.5 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
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

            <!-- Ticket Policy -->
            <div class="bg-slate-50/50 rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-200">
                <h3 class="text-xl font-bold mb-6 text-slate-800 flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Kebijakan Tiket
                </h3>
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
        </div>
    </section>
@endsection