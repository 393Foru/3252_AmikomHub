@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-0 relative z-10">
    <x-breadcrumb :items="[
        ['label' => 'Partner Kami']
    ]" />
</div>

<div class="max-w-7xl mx-auto px-6 pt-6 pb-4 text-center md:pt-8 md:pb-6 border-b border-slate-100 mb-8">
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 border border-blue-100 font-bold text-xs uppercase tracking-widest mb-4 shadow-sm">
        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
        Partner & Sponsor
    </div>

    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight">
        Partner <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Kolaborasi Kami</span>
    </h1>

    <p class="text-slate-500 font-medium text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
        Eventama didukung oleh berbagai instansi dan perusahaan terpercaya yang berkomitmen untuk memajukan talenta mahasiswa.
    </p>
</div>

<section class="max-w-7xl mx-auto px-6 py-4 mb-8">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-16">
        @forelse($partners as $index => $partner)
            @php
                $gradients = [
                    'from-blue-400 to-blue-500',
                    'from-indigo-400 to-indigo-500',
                    'from-cyan-400 to-cyan-500',
                    'from-teal-400 to-teal-500',
                    'from-slate-400 to-slate-500',
                ];
                $gradientClass = $gradients[$index % count($gradients)];
            @endphp
            
            <a href="{{ route('partners.show', $partner->id) }}" class="block h-full bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 flex flex-col items-center text-center shadow-sm hover:shadow-lg hover:border-blue-300 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-20 h-20 sm:w-24 sm:h-24 mb-5 shrink-0 relative flex items-center justify-center">
                    @if($partner->logo_url)
                        <div class="w-full h-full p-2 bg-white rounded-2xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ (\Illuminate\Support\Str::startsWith($partner->logo_url, 'http') ? $partner->logo_url : asset('storage/' . $partner->logo_url)) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain">
                        </div>
                    @else
                        @php
                            $words = explode(' ', $partner->name);
                            $abbr = '';
                            foreach($words as $w) {
                                $abbr .= mb_substr($w, 0, 1);
                            }
                            $abbr = strtoupper(mb_substr($abbr, 0, 2));
                        @endphp
                        <div class="w-full h-full rounded-2xl bg-gradient-to-br {{ $gradientClass }} text-white font-bold text-2xl sm:text-3xl flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform duration-300">
                            {{ $abbr }}
                        </div>
                    @endif
                </div>
                
                <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-2 group-hover:text-blue-600 transition-colors">{{ $partner->name }}</h3>
                <div class="mt-auto pt-2 flex flex-col items-center gap-1">
                    <p class="text-sm text-slate-500 font-medium">{{ $partner->events_count }} Event Kolaborasi</p>
                    <div class="flex items-center text-xs text-amber-500 font-bold bg-amber-50 px-2 py-1 rounded-full mt-2">
                        <i class="fas fa-star mr-1"></i>
                        {{ number_format($partner->reviews()->avg('rating') ?? 0, 1) }}
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full py-16 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 border border-slate-100 shadow-sm">
                    <i class="fas fa-handshake text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-1">Belum Ada Partner</h3>
                <p class="text-slate-500">Jadilah partner pertama kami dan buat event seru bersama.</p>
            </div>
        @endforelse
    </div>

    @if($partners->hasPages())
        <div class="mt-8 mb-16 flex justify-center">
            {{ $partners->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Minimalist Call To Action Section - Variation 2 -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100/50 rounded-3xl p-8 md:p-10 mx-auto overflow-hidden relative shadow-sm">
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-blue-100/40 to-transparent pointer-events-none"></div>
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-200/40 rounded-full blur-2xl pointer-events-none"></div>
        
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 relative z-10">
            <div class="text-center md:text-left md:max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white text-blue-600 font-bold text-[10px] uppercase tracking-widest mb-4 shadow-sm border border-blue-50">
                    <i class="fas fa-rocket"></i> Mari Tumbuh Bersama
                </div>
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 mb-3 tracking-tight">Tertarik Membuka Peluang Baru?</h2>
                <p class="text-slate-600 text-sm md:text-base leading-relaxed">
                    Jangkau lebih banyak audiens mahasiswa dengan menjadi partner kolaborasi di Eventama. Mulai langkah pertama Anda hari ini.
                </p>
            </div>
            
            <div class="flex flex-col items-center gap-3 w-full md:w-auto shrink-0">
                <a href="{{ route('register') }}" class="w-full sm:w-56 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 text-white hover:bg-blue-700 rounded-2xl font-bold text-sm transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <i class="fas fa-user-plus"></i>
                    Daftar Sekarang
                </a>
                <a href="mailto:partnership@eventama.id" class="w-full sm:w-56 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 hover:text-blue-600 rounded-2xl font-bold text-sm transition-all shadow-sm">
                    <i class="fas fa-envelope"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
