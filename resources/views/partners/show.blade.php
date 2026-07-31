@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-20 relative z-10">
    <x-breadcrumb :items="[
        ['label' => 'Partner Kami', 'url' => route('partners.index')],
        ['label' => $partner->name]
    ]" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
        <!-- Partner Info (Left Column) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm text-center">
                <div class="w-32 h-32 mx-auto mb-6 relative">
                    @if($partner->logo_url && Storage::disk('public')->exists($partner->logo_url))
                        <img src="{{ (\Illuminate\Support\Str::startsWith($partner->logo_url, 'http') ? $partner->logo_url : asset('storage/' . $partner->logo_url)) }}" alt="{{ $partner->name }}" class="w-full h-full object-contain bg-white rounded-2xl p-2 border border-slate-100 shadow-sm">
                    @else
                        <div class="w-full h-full rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 text-white font-bold text-5xl flex items-center justify-center shadow-sm">
                            {{ substr($partner->name, 0, 2) }}
                        </div>
                    @endif
                </div>
                
                <h1 class="text-2xl font-black text-slate-900 mb-2">{{ $partner->name }}</h1>
                <p class="text-slate-500 text-sm mb-6">Bergabung sejak {{ $partner->created_at->translatedFormat('F Y') }}</p>

                <!-- Rating Snippet -->
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 mb-6">
                    <p class="text-slate-600 text-sm font-medium mb-1">Reputasi Penyelenggara</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-3xl font-black text-slate-800">{{ number_format($averageRating, 1) }}</span>
                        <div class="text-amber-400 flex text-lg">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($averageRating))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star text-slate-300"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">{{ $partner->reviews()->count() }} Ulasan Peserta</p>
                </div>
            </div>

            <!-- Recent Events by Partner -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-check text-blue-600"></i>
                    Event Terakhir
                </h3>
                <div class="space-y-4">
                    @forelse($partner->ownedEvents as $event)
                        <a href="{{ route('events.show', $event) }}" class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 transition-colors group">
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                                @if($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                                    <img src="{{ (\Illuminate\Support\Str::startsWith($event->poster_path, 'http') ? $event->poster_path : asset('storage/' . $event->poster_path)) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><i class="fas fa-image text-slate-300 text-xs"></i></div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-700 text-sm line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $event->title }}</h4>
                                <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500 text-center py-4">Belum ada event</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Reviews (Right Column) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-200 shadow-sm h-full">
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100">
                    <h2 class="text-xl font-black text-slate-800 flex items-center gap-2">
                        <i class="fas fa-comments text-blue-600"></i>
                        Testimoni Peserta
                    </h2>
                </div>

                <div class="space-y-6">
                    @forelse($reviews as $review)
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="flex items-start justify-between gap-4 mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 font-bold flex items-center justify-center uppercase">
                                        {{ substr($review->transaction->customer_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">{{ $review->transaction->customer_name }}</p>
                                        <p class="text-xs text-slate-500">Event: <a href="{{ route('events.show', $review->event) }}" class="text-blue-600 hover:underline">{{ $review->event->title }}</a></p>
                                    </div>
                                </div>
                                <div class="text-xs text-slate-400 whitespace-nowrap">
                                    {{ $review->created_at->diffForHumans() }}
                                </div>
                            </div>
                            
                            <div class="flex text-amber-400 text-sm mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star text-slate-300"></i>
                                    @endif
                                @endfor
                            </div>
                            
                            @if($review->comment)
                                <p class="text-slate-600 text-sm italic">"{{ $review->comment }}"</p>
                            @else
                                <p class="text-slate-400 text-sm italic">Tidak ada ulasan tertulis.</p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                                <i class="fas fa-comment-slash text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Ulasan</h3>
                            <p class="text-slate-500 text-sm">Penyelenggara ini belum menerima ulasan dari peserta acara.</p>
                        </div>
                    @endforelse
                </div>

                @if($reviews->hasPages())
                    <div class="mt-8 border-t border-slate-100 pt-6">
                        {{ $reviews->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
