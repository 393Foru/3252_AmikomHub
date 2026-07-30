@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 pt-10 pb-6 md:pt-16 md:pb-8 flex flex-col md:flex-row items-center gap-6 md:gap-12">
    <div class="flex-1 flex flex-col items-center text-center md:items-start md:text-left w-full">
        <div
            class="mb-4 md:mb-6 inline-flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2 bg-blue-50 border border-blue-100 text-blue-700 rounded-full text-[10px] sm:text-xs md:text-sm font-bold uppercase tracking-widest shadow-sm">
            <span class="relative flex h-2 w-2">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
            </span>
            #1 Event Platform di Amikom
        </div>

        <h1 class="mb-4 md:mb-6 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-slate-900 leading-[1.15] md:leading-[1.1] tracking-tight">
            Temukan & Pesan <br class="hidden md:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">
                Tiket Event
            </span> <br class="hidden md:block">
            Impianmu.
        </h1>

        <p class="mb-8 md:mb-10 text-base sm:text-lg md:text-xl text-slate-600 max-w-md md:max-w-xl leading-relaxed font-medium">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan <span
                class="text-slate-900 font-bold underline decoration-blue-300">aman & cepat</span> dengan Midtrans.
        </p>

        <div class="mb-6 md:mb-8 flex flex-row justify-center gap-3 md:gap-4 w-full sm:w-auto">
            <a href="{{ route('events.index') }}"
                class="flex-1 sm:flex-none px-4 sm:px-8 py-3.5 md:py-4 bg-blue-600 text-white rounded-2xl font-bold text-sm sm:text-base md:text-lg shadow-xl shadow-blue-200 hover:scale-105 transition-transform text-center whitespace-nowrap">
                Mulai Jelajah
            </a>
            <a href="{{ route('how-to-order') }}"
                class="flex-1 sm:flex-none px-4 sm:px-8 py-3.5 md:py-4 border-2 border-slate-200 rounded-2xl font-bold text-sm sm:text-base md:text-lg hover:border-blue-600 hover:text-blue-600 transition text-center whitespace-nowrap">
                Cara Pesan
            </a>
        </div>
        

    </div>
    
    <div class="flex-1 flex flex-col w-full max-w-sm sm:max-w-md md:max-w-none mx-auto md:mx-0">
        <div class="relative w-full">
            <div class="absolute -top-10 -left-10 w-48 md:w-64 h-48 md:h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div class="absolute -bottom-10 -right-10 w-48 md:w-64 h-48 md:h-64 bg-cyan-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="{{ asset('storage/assets/concert.png') }}" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <div class="absolute -bottom-4 md:-bottom-6 left-0 right-0 mx-auto md:mx-0 md:-left-6 w-[90%] md:w-auto glass p-3 sm:p-4 md:p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center justify-center md:justify-start gap-3 md:gap-4">
                <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 shrink-0">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <div class="text-left">
                    <p class="text-[10px] md:text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold text-xs sm:text-sm md:text-base leading-tight">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
        </div> <!-- Close relative w-full wrapper -->

        <div class="mt-12 md:mt-16 flex flex-row items-center justify-center gap-3 md:gap-4 text-slate-400">
            <div class="flex -space-x-2">
                <img class="w-8 h-8 rounded-full border-2 border-white"
                    src="https://ui-avatars.com/api/?name=User+1&bg=6366f1&color=fff" alt="">
                <img class="w-8 h-8 rounded-full border-2 border-white"
                    src="https://ui-avatars.com/api/?name=User+2&bg=a855f7&color=fff" alt="">
                <img class="w-8 h-8 rounded-full border-2 border-white"
                    src="https://ui-avatars.com/api/?name=User+3&bg=ec4899&color=fff" alt="">
            </div>
            <p class="text-xs sm:text-sm font-medium"><span class="text-slate-900 font-bold">1,000+</span> Mahasiswa sudah
                bergabung</p>
        </div>
    </div>
</section>

<section id="events" class="max-w-7xl mx-auto px-6 py-8 md:py-12">

    <div class="flex flex-col lg:flex-row justify-between items-center lg:items-end mb-12 gap-8">

        <div class="text-center lg:text-left w-full lg:w-auto">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                Jelajahi Kategori
            </div>

            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3 tracking-tight">Event Terdekat</h2>
            <p class="text-slate-500 font-medium text-lg">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>

        <div class="w-full lg:w-auto">
            <div class="relative w-full">
                <!-- Fade effect on the right side for mobile -->
                <div class="absolute right-0 top-0 bottom-4 w-12 bg-gradient-to-l from-white to-transparent pointer-events-none sm:hidden z-10"></div>
                
                <div class="flex flex-row overflow-x-auto sm:flex-wrap justify-start sm:justify-center lg:justify-end gap-3 w-full pb-4 sm:pb-0 pt-2 px-1 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] snap-x">
                    <a href="{{ route('home') }}#events"
                        class="shrink-0 snap-start flex items-center gap-2 px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-105 ring-4 ring-blue-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-blue-300 hover:text-blue-600 hover:shadow-md' }}">
                        <svg class="w-4 h-4 {{ !request('category') ? 'text-blue-200' : 'text-slate-400' }}" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Semua Event
                    </a>

                    @foreach($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat->slug]) }}#events"
                        class="shrink-0 snap-start px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == $cat->slug ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-105 ring-4 ring-blue-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-blue-300 hover:text-blue-600 hover:shadow-md' }}">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Text hint for mobile -->
            <div class="flex items-center gap-1.5 text-[10px] text-slate-400 mt-1 pl-2 sm:hidden">
                <i class="fas fa-arrows-alt-h text-slate-300"></i>
                <span>Geser untuk melihat semua kategori</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-6">
        @forelse($events as $event)
        <x-event-card :event="$event" />
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
    <x-pagination :data="$events" fragment="events" />
</section>

<section class="pt-6 md:pt-12 pb-0 md:pb-8 bg-slate-50 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6 md:mb-8">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-2">Our Network</p>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Didukung Oleh Partner Terbaik</h2>
            <p class="text-slate-500 font-medium mt-1">Kolaborasi erat bersama berbagai instansi dan perusahaan terpercaya.</p>
        </div>

        <div class="relative w-full overflow-hidden">
            <!-- Smooth fade edges -->
            <div class="absolute inset-y-0 left-0 w-12 md:w-24 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-12 md:w-24 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

            <div id="partner-scroller" class="flex items-center gap-6 md:gap-10 overflow-x-auto flex-nowrap py-4 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] cursor-grab select-none">
                @if($partners->isNotEmpty())
                    {{-- Loop twice to create an infinite scrolling effect --}}
                    @for ($i = 0; $i < 2; $i++)
                        @foreach($partners as $partner)
                            <div class="shrink-0 group relative flex items-center justify-center p-4 grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                                <div class="w-auto min-w-[8rem] h-16 flex items-center justify-center">
                                    @if($partner->logo_url && Storage::disk('public')->exists($partner->logo_url))
                                        <img src="{{ asset('storage/' . $partner->logo_url) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform" title="{{ $partner->name }}" draggable="false">
                                    @else
                                        @php
                                            $words = explode(' ', $partner->name);
                                            $abbr = '';
                                            foreach($words as $w) {
                                                $abbr .= mb_substr($w, 0, 1);
                                            }
                                            $abbr = strtoupper(mb_substr($abbr, 0, 2));
                                        @endphp
                                        <div class="flex items-center gap-3 transform group-hover:scale-105 transition-transform" title="{{ $partner->name }}">
                                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 font-black text-lg flex items-center justify-center tracking-tighter shrink-0 border border-blue-200">
                                                {{ $abbr }}
                                            </div>
                                            <span class="font-extrabold text-slate-700 text-base whitespace-nowrap">{{ $partner->name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endfor
                @else
                    <div class="w-full text-center text-slate-400 text-sm font-medium py-4 shrink-0">
                        Eventama membuka peluang kolaborasi bersama partner baru.
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const scroller = document.getElementById('partner-scroller');
    if (!scroller) return;

    let isDown = false;
    let startX;
    let scrollLeft;
    let isHovering = false;
    let animationId;

    // Auto scroll function
    function autoScroll() {
        if (!isHovering && !isDown) {
            scroller.scrollLeft += 1; // Speed of scroll
            
            // Seamless loop: when scrolled halfway, reset to 0
            // Because content is duplicated exactly once, half of scrollWidth is exactly the start of the second duplicate
            if (scroller.scrollLeft >= (scroller.scrollWidth / 2)) {
                scroller.scrollLeft = 0;
            }
        }
        animationId = requestAnimationFrame(autoScroll);
    }
    
    // Start animation
    animationId = requestAnimationFrame(autoScroll);

    // Pause on hover
    scroller.addEventListener('mouseenter', () => isHovering = true);
    scroller.addEventListener('mouseleave', () => {
        isHovering = false;
        isDown = false;
    });

    // Support touch devices
    scroller.addEventListener('touchstart', () => isHovering = true, {passive: true});
    scroller.addEventListener('touchend', () => {
        setTimeout(() => isHovering = false, 1500); 
    }, {passive: true});

    // Drag to scroll logic for desktop
    scroller.addEventListener('mousedown', (e) => {
        isDown = true;
        scroller.style.cursor = 'grabbing';
        startX = e.pageX - scroller.offsetLeft;
        scrollLeft = scroller.scrollLeft;
    });
    scroller.addEventListener('mouseup', () => {
        isDown = false;
        scroller.style.cursor = 'grab';
    });
    scroller.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault(); // Prevent text/image selection while dragging
        const x = e.pageX - scroller.offsetLeft;
        const walk = (x - startX) * 2; // scroll speed multiplier
        scroller.scrollLeft = scrollLeft - walk;
    });
});
</script>
@endpush

@endsection




