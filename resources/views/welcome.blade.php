@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-xs md:text-sm font-bold uppercase tracking-widest shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
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
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan <span class="text-slate-900 font-bold underline decoration-indigo-300">aman & cepat</span> dengan Midtrans.
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
                <img class="w-8 h-8 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=User+1&bg=6366f1&color=fff" alt="">
                <img class="w-8 h-8 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=User+2&bg=a855f7&color=fff" alt="">
                <img class="w-8 h-8 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=User+3&bg=ec4899&color=fff" alt="">
            </div>
            <p class="text-sm font-medium"><span class="text-slate-900 font-bold">1,000+</span> Mahasiswa sudah bergabung</p>
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

    <!-- Events Grid -->
    <section id="events" class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>
            <div class="flex gap-2">
                <button class="p-3 border rounded-xl hover:bg-white hover:shadow-md transition">Semua Kategori</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Event Card 1 -->
            <div
                class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="assets/concert.png" alt="Jazz Night"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                        Musik</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">Jazz Night 2024: A
                        Celebration</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>16 November 2024, 19:30</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">Rp 150rb</span>
                        <a href="event-detail.html"
                            class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div
                class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="assets/workshop.png" alt="AI & Future"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                        Technology</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">AI & Future: Unleash The
                        Power</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>26 October 2024, 09:00</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">Rp 50rb</span>
                        <a href="event-detail.html"
                            class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>

            <!-- Event Card 3 -->
            <div
                class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden aspect-[3/4]">
                    <img src="assets/hackathon.png" alt="Hackathon 2024"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                        Coding</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">Hackathon 2024: Ultimate
                        Marathon</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>18-20 October 2024</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t">
                        <span class="text-2xl font-black text-indigo-600">Gratis</span>
                        <a href="event-detail.html"
                            class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection