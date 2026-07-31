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

    <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-6 gap-4 md:gap-8">
        <div class="text-center md:text-left w-full md:w-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                Katalog Event
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Pilih Kategori</h2>
        </div>

        <!-- Sorting & Status Dropdowns -->
        <form action="{{ route('events.index') }}" method="GET" class="w-full md:w-auto shrink-0 relative z-20">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="flex flex-row items-center justify-end gap-2 w-full">
                @if(request('category') || (request('sort') && request('sort') != 'terbaru') || (request('status') && request('status') != 'semua'))
                    <a href="{{ route('events.index') }}" title="Reset Semua Filter" class="flex items-center justify-center h-10 w-10 sm:h-11 sm:w-auto sm:px-4 bg-white border border-slate-200 text-slate-500 hover:text-red-500 hover:border-red-200 hover:bg-red-50 rounded-full transition-colors shadow-sm text-sm font-bold shrink-0">
                        <i class="fas fa-sync-alt sm:mr-1.5"></i>
                        <span class="hidden sm:inline">Reset</span>
                    </a>
                @endif

                <label for="sort" class="text-sm font-bold text-slate-500 hidden lg:block ml-2">Urutkan:</label>
                
                <select name="status" onchange="this.form.submit()" class="flex-1 sm:flex-none bg-white border border-slate-200 text-slate-600 text-xs sm:text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-40 px-3 sm:px-4 py-2.5 sm:py-3 shadow-sm font-bold appearance-none cursor-pointer pr-8 sm:pr-10 hover:border-blue-300 transition-colors" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2364748B%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem top 50%; background-size: 0.65rem auto;">
                    <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="mendatang" {{ request('status') == 'mendatang' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="terlewat" {{ request('status') == 'terlewat' ? 'selected' : '' }}>Sudah Terlewat</option>
                </select>

                <select name="sort" id="sort" onchange="this.form.submit()" class="flex-1 sm:flex-none bg-white border border-slate-200 text-slate-600 text-xs sm:text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-44 px-3 sm:px-4 py-2.5 sm:py-3 shadow-sm font-bold appearance-none cursor-pointer pr-8 sm:pr-10 hover:border-blue-300 transition-colors" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2364748B%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem top 50%; background-size: 0.65rem auto;">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="terdekat" {{ request('sort') == 'terdekat' ? 'selected' : '' }}>Terdekat</option>
                    <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Category Pills -->
    <div class="relative w-full mb-10 overflow-hidden">
        <!-- Fade effect on the right side for mobile -->
        <div class="absolute right-0 top-0 bottom-4 w-12 bg-gradient-to-l from-white to-transparent pointer-events-none sm:hidden z-10"></div>
        
        <div class="flex flex-row overflow-x-auto justify-start gap-3 w-full pb-4 sm:pb-2 pt-2 px-1 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] snap-x">
            <a href="{{ route('events.index', ['sort' => request('sort'), 'status' => request('status')]) }}"
                class="shrink-0 snap-start flex items-center gap-2 px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-105 ring-4 ring-blue-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-blue-300 hover:text-blue-600 hover:shadow-md' }}">
                <svg class="w-4 h-4 {{ !request('category') ? 'text-blue-200' : 'text-slate-400' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Semua
            </a>

            @foreach($categories as $cat)
            <a href="{{ route('events.index', ['category' => $cat->slug, 'sort' => request('sort'), 'status' => request('status')]) }}"
                class="shrink-0 snap-start px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 {{ request('category') == $cat->slug ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-105 ring-4 ring-blue-50' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:border-blue-300 hover:text-blue-600 hover:shadow-md' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
        
        <!-- Text hint for mobile -->
        <div class="flex items-center gap-1.5 text-[10px] text-slate-400 mt-1 pl-2 sm:hidden">
            <i class="fas fa-arrows-alt-h text-slate-300"></i>
            <span>Geser untuk kategori lain</span>
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
            <p class="text-slate-500 mb-6">Coba pilih filter lain atau cek kembali nanti.</p>
            <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-full hover:bg-slate-50 hover:text-blue-600 transition-colors shadow-sm">
                <i class="fas fa-sync-alt"></i> Reset Filter
            </a>
        </div>
        @endforelse
    </div>
    
    <x-pagination :data="$events" />

</section>
@endsection