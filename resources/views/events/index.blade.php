@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-0 relative z-10">
    <x-breadcrumb :items="[
        ['label' => 'Katalog Event']
    ]" />
</div>

<div class="max-w-7xl mx-auto px-6 pt-6 pb-4 text-center md:pt-8 md:pb-6 border-b border-slate-100 mb-4">
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 border border-blue-100 font-bold text-xs uppercase tracking-widest mb-4 shadow-sm">
        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
        Katalog Lengkap
    </div>

    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight">
        Eksplorasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Semua Event</span>
    </h1>

    <p class="text-slate-500 font-medium text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
        Temukan berbagai acara seru, <em>workshop</em>, dan seminar yang akan datang. Filter berdasarkan minatmu dan kembangkan potensimu.
    </p>

</div>

<section id="events" class="max-w-7xl mx-auto px-6 py-4 mb-8">

    <div class="flex flex-col lg:flex-row justify-between items-center lg:items-end mb-12 gap-8">
        
        <div class="text-center lg:text-left w-full lg:w-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                Katalog Event
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3 tracking-tight">Pilih Kategori</h2>
        </div>

        <div class="w-full lg:w-auto">
            <div class="relative w-full">
                <!-- Fade effect on the right side for mobile -->
                <div class="absolute right-0 top-0 bottom-4 w-12 bg-gradient-to-l from-white to-transparent pointer-events-none sm:hidden z-10"></div>
                
                <div class="flex flex-row overflow-x-auto sm:flex-wrap justify-start sm:justify-center lg:justify-end gap-3 w-full pb-4 sm:pb-0 pt-2 px-1 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] snap-x">
                    <a href="{{ route('events.index') }}"
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
                    <a href="{{ route('events.index', ['category' => $cat->slug]) }}"
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
        <div class="col-span-full py-16 text-center bg-blue-50/50 rounded-3xl border border-dashed border-blue-200">
            <div class="w-16 h-16 bg-white shadow-sm border border-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-400 animate-bounce">
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
    
    <x-pagination :data="$events" />

</section>
@endsection