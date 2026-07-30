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
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 lg:pb-16 pt-4 lg:pt-6 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 relative z-10">
        <!-- Left: Poster -->
        <div class="lg:col-span-1">
            <div class="sticky top-32">
                <!-- Memanggil gambar dinamis menggunakan storage -->
                <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path)
                : 'https://placehold.co/400x600/e2e8f0/6366f1?text=' . urlencode($event->title) }}" alt="{{ $event->title }}"
                class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover
                aspect-[3/4]">
                <div class="mt-8 p-6 bg-white rounded-3xl border border-slate-100 shadow-sm">
                    <h4 class="font-bold mb-4">Penyelenggara</h4>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                            AB</div>
                        <div>
                            <p class="font-bold text-slate-800">ABP Productions</p>
                            <p class="text-xs text-slate-500">Verified Organizer</p>
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
                class="bg-indigo-600 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl shadow-indigo-200 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div>
                        <p class="text-indigo-200 font-bold uppercase tracking-widest text-sm mb-2">Harga Tiket</p>
                        <h2 class="text-5xl font-black">Rp {{ number_format($event->price, 0, ',', '.') }} <span class="text-lg font-medium text-indigo-200">/
                                orang</span></h2>
                        <p class="mt-4 text-indigo-100 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Sisa stok: <span class="font-bold underline">{{ $event->stock }} Tiket lagi!</span>
                        </p>
                    </div>
                    <div>
                        <a href="{{ url('checkout/'.$event->id) }}"
                            class="inline-block px-10 py-5 bg-white text-indigo-600 rounded-2xl font-black text-xl hover:scale-105 transition-transform shadow-xl">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
                <!-- Decoration -->
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white opacity-10 rounded-full"></div>
                <div class="absolute -left-10 -top-10 w-32 h-32 bg-indigo-400 opacity-20 rounded-full"></div>
            </div>

            <div class="bg-slate-50/80 rounded-[2rem] p-8 border border-slate-100">
                <h3 class="text-xl font-bold mb-6 text-slate-800 flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    Kebijakan Tiket
                </h3>
                <ul class="space-y-4 text-slate-600">
                    <li class="flex items-start gap-4 bg-white p-5 rounded-2xl shadow-sm border border-slate-100/50">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="mt-2 text-sm md:text-base">E-Ticket akan dikirimkan otomatis ke email Anda setelah pembayaran terverifikasi.</div>
                    </li>
                    <li class="flex items-start gap-4 bg-white p-5 rounded-2xl shadow-sm border border-slate-100/50">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="mt-2 text-sm md:text-base">Tiket dapat discan di pintu masuk (Check-in) menggunakan QR Code.</div>
                    </li>
                    <li class="flex items-start gap-4 bg-rose-50/50 p-5 rounded-2xl border border-rose-100">
                        <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="mt-2 text-sm md:text-base text-rose-700 font-medium">Tiket yang sudah dibeli tidak dapat direfund atau dibatalkan.</div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection