@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-8 md:py-12">
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
            Partner & Sponsor
        </div>
        <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">Partner Kami</h1>
        <p class="text-slate-500 font-medium text-lg max-w-2xl mx-auto">Eventama didukung oleh berbagai instansi dan perusahaan terpercaya yang berkomitmen untuk memajukan ekosistem event kampus.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($partners as $partner)
            <div class="glass border border-slate-200 rounded-2xl p-6 flex flex-col items-center justify-center text-center shadow-sm hover:shadow-xl hover:border-blue-300 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="w-24 h-24 mb-4 relative z-10 flex items-center justify-center">
                    @if($partner->logo_url && Storage::disk('public')->exists($partner->logo_url))
                        <img src="{{ asset('storage/' . $partner->logo_url) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain filter group-hover:drop-shadow-md transition-all duration-300">
                    @else
                        @php
                            $words = explode(' ', $partner->name);
                            $abbr = '';
                            foreach($words as $w) {
                                $abbr .= mb_substr($w, 0, 1);
                            }
                            $abbr = strtoupper(mb_substr($abbr, 0, 2));
                        @endphp
                        <div class="w-20 h-20 rounded-2xl bg-blue-100 text-blue-600 font-black text-3xl flex items-center justify-center shadow-inner border border-blue-200">
                            {{ $abbr }}
                        </div>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-slate-800 relative z-10">{{ $partner->name }}</h3>
                <p class="text-xs text-slate-500 mt-2 relative z-10 font-medium">{{ $partner->events_count }} Event Kolaborasi</p>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                    <i class="fas fa-handshake text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-1">Belum Ada Partner</h3>
                <p class="text-slate-500">Jadilah partner pertama kami dan buat event seru bersama.</p>
            </div>
        @endforelse
    </div>

    @if($partners->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $partners->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</section>
@endsection
