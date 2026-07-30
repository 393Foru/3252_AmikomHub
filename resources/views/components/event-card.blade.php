@props(['event'])

<div class="group relative bg-white rounded-2xl sm:rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full">
    {{-- Poster Section --}}
    <div class="relative aspect-[3/4] overflow-hidden bg-slate-100 shrink-0">
        <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/600x800/e2e8f0/2563eb?text=' . urlencode(Str::limit($event->title, 15)) }}"
            alt="{{ $event->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            
        {{-- Overlay Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-60 sm:opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

        {{-- Category Badge (Top Left) --}}
        <div class="absolute top-3 left-3 sm:top-4 sm:left-4 z-10">
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white/95 backdrop-blur-sm text-[10px] sm:text-xs font-bold uppercase tracking-wider text-blue-600 shadow-sm border border-white/20">
                {{ $event->category->name ?? 'Uncategorized' }}
            </span>
        </div>
        
        {{-- Bookmark Button (Top Right) --}}
        <div class="absolute top-3 right-3 sm:top-4 sm:right-4 z-20">
            <button class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-white transition-all shadow-sm focus:outline-none" title="Simpan Event">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
        </div>

        {{-- Stock Badge (Bottom Left) --}}
        <div class="absolute bottom-3 left-3 sm:bottom-4 sm:left-4 z-10 flex flex-col gap-2">
            @if($event->stock > 0 && $event->stock <= 10)
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-red-500/95 backdrop-blur-sm text-[10px] sm:text-xs font-bold uppercase tracking-wider text-white shadow-sm border border-white/20 animate-pulse">
                    Sisa {{ $event->stock }}
                </span>
            @elseif($event->stock == 0)
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-900/95 backdrop-blur-sm text-[10px] sm:text-xs font-bold uppercase tracking-wider text-white shadow-sm border border-white/20">
                    Habis
                </span>
            @endif
        </div>
    </div>

    {{-- Content Section --}}
    <div class="p-4 sm:p-5 flex flex-col flex-grow relative">
        {{-- Make whole card clickable except for z-30 interactive elements --}}
        <a href="{{ route('events.show', $event->id) }}" class="absolute inset-0 z-0" aria-label="Lihat detail {{ $event->title }}"></a>

        {{-- Organizer Info --}}
        <div class="flex items-center gap-2 mb-3 relative z-10 pointer-events-none">
            <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                @if($event->owner && $event->owner->logo_url && Storage::disk('public')->exists($event->owner->logo_url))
                    <img src="{{ asset('storage/' . $event->owner->logo_url) }}" alt="{{ $event->owner->name }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                @endif
            </div>
            <span class="text-[10px] sm:text-xs font-bold text-slate-500 truncate">{{ $event->owner->name ?? 'Eventama Partner' }}</span>
        </div>

        {{-- Title --}}
        <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors leading-snug relative z-10 pointer-events-none">
            {{ $event->title }}
        </h3>

        {{-- Meta Info (Calendar, Time & Location) --}}
        <div class="flex gap-3 sm:gap-4 mb-4 mt-auto relative z-10 pointer-events-none">
            {{-- Calendar Box --}}
            <div class="flex flex-col items-center justify-center bg-blue-50/50 rounded-xl px-2 py-1.5 min-w-[3rem] sm:min-w-[3.5rem] shrink-0 border border-blue-100/50 h-fit">
                <span class="text-[9px] sm:text-[10px] font-bold text-blue-500 uppercase tracking-widest">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('M') }}</span>
                <span class="text-base sm:text-lg font-black text-blue-700 leading-none mt-0.5">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
            </div>
            
            {{-- Time & Location --}}
            <div class="flex flex-col justify-center gap-2 text-slate-500 text-xs sm:text-sm overflow-hidden">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="truncate font-medium">{{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB</span>
                </div>
                
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="truncate">{{ $event->location ?? 'Lokasi belum ditentukan' }}</span>
                </div>
            </div>
        </div>

        {{-- Footer Section --}}
        <div class="pt-4 mt-auto flex items-center justify-between border-t border-slate-100 relative z-30">
            <div class="flex flex-col">
                <span class="text-[9px] sm:text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-0.5">Harga Tiket</span>
                <span class="text-base sm:text-xl font-black text-blue-600 leading-none">
                    {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                </span>
            </div>
            
            <a href="{{ route('events.show', $event->id) }}" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-blue-50 hover:bg-blue-600 text-blue-500 hover:text-white flex items-center justify-center transition-all shadow-sm group-hover:bg-blue-600 group-hover:text-white border border-blue-100 group-hover:border-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 {{ $event->stock == 0 ? 'opacity-50 cursor-not-allowed group-hover:bg-blue-50 group-hover:text-blue-500 group-hover:border-blue-100 pointer-events-none' : '' }}" title="Pesan Tiket">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
