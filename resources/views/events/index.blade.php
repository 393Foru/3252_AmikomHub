@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 pt-16 pb-12 text-center md:pt-24 md:pb-16 border-b border-slate-100 mb-12">
    
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-50 text-slate-600 border border-slate-200 font-bold text-xs uppercase tracking-widest mb-6 shadow-sm">
        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
        Katalog Lengkap
    </div>

    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight">
        Eksplorasi Semua Event
    </h1>

    <p class="text-slate-500 font-medium text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
        Temukan berbagai acara seru, <em>workshop</em>, dan seminar yang akan datang. Filter berdasarkan minatmu dan kembangkan potensimu.
    </p>

</div>

<section id="events" class="max-w-7xl mx-auto px-6 py-4 mb-20">

    <div class="flex flex-col lg:flex-row justify-between items-center lg:items-end mb-12 gap-8">
        
        <div class="text-center lg:text-left w-full lg:w-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 font-extrabold text-[10px] uppercase tracking-widest mb-4 border border-indigo-100 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                Katalog Event
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3 tracking-tight">Pilih Kategori</h2>
        </div>

        <div class="flex flex-wrap justify-center lg:justify-end gap-3 w-full lg:w-auto">
            <a href="{{ route('events.index') }}"
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
            <a href="{{ route('events.index', ['category' => $cat->slug]) }}"
                class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200 scale-105 ring-4 ring-indigo-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 hover:shadow-md' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="relative overflow-hidden aspect-[3/4]">
                <img src="https://placehold.co/400x600/e2e8f0/6366f1?text={{ urlencode($event->title) }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                <div class="absolute top-4 left-4 px-3 py-1 bg-white/95 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600 shadow-sm">
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
            <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
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
    
    <div class="mt-12 pt-8 border-t border-slate-100 flex justify-center w-full">
        <div class="bg-white p-1 rounded-xl border border-slate-200 shadow-sm [&_nav_span]:!shadow-none [&_nav_a]:!shadow-none [&_nav_span]:!rounded-lg [&_nav_a]:!rounded-lg">
            {{ $events->links() }}
        </div>
    </div>

</section>
@endsection