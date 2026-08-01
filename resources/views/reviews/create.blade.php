@extends('layouts.app')

@section('content')
<!-- Decorative background -->
<div class="fixed inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50 z-[-1]"></div>
<div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3 w-96 h-96 bg-indigo-300/20 rounded-full blur-3xl pointer-events-none"></div>
<div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3 w-[30rem] h-[30rem] bg-purple-300/20 rounded-full blur-3xl pointer-events-none"></div>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-24 relative z-10">
    <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-indigo-200/50 border border-white overflow-hidden relative">
        
        <!-- Header -->
        <div class="relative px-8 pt-10 pb-8 text-center">
            <div class="absolute inset-0 bg-gradient-to-b from-indigo-500/10 to-transparent pointer-events-none"></div>
            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg shadow-indigo-500/30 mb-6 transform -rotate-6 hover:rotate-0 transition-transform duration-300">
                <i class="fas fa-comment-dots"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 mb-3 tracking-tight">Pengalaman Anda</h1>
            <p class="text-slate-500 font-medium text-lg">Bantu <span class="text-indigo-600 font-bold">{{ $transaction->event->owner->name ?? 'Penyelenggara' }}</span> menjadi lebih baik!</p>
        </div>

        <div class="px-8 pb-10">
            <!-- Event Info Card -->
            <div class="flex items-center gap-5 p-5 bg-white rounded-3xl border border-slate-100 shadow-sm mb-10 group hover:shadow-md transition-shadow">
                <div class="w-20 h-20 rounded-2xl overflow-hidden shrink-0 bg-slate-100 shadow-inner relative">
                    @if($transaction->event->poster_path)
                        <img src="{{ (\Illuminate\Support\Str::startsWith($transaction->event->poster_path, 'http') ? $transaction->event->poster_path : asset('storage/' . $transaction->event->poster_path)) }}" alt="{{ $transaction->event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i class="fas fa-image text-3xl"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 border border-black/5 rounded-2xl"></div>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mb-1">Event Diikuti</p>
                    <h3 class="font-black text-slate-800 text-lg sm:text-xl truncate">{{ $transaction->event->title }}</h3>
                    <p class="text-slate-500 text-sm mt-1 flex items-center gap-2">
                        <i class="far fa-calendar-alt text-slate-400"></i>
                        {{ \Carbon\Carbon::parse($transaction->event->date)->translatedFormat('d M Y') }}
                    </p>
                </div>
            </div>

            @if(session('error'))
                <div class="mb-8 p-5 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-2xl shadow-sm flex items-start gap-4">
                    <i class="fas fa-exclamation-circle text-xl mt-0.5 text-rose-500"></i>
                    <p class="font-bold">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ URL::signedRoute('reviews.store', ['transaction' => $transaction->id]) }}" method="POST">
                @csrf
                
                <!-- Rating Section -->
                <div class="mb-10 text-center">
                    <label class="block text-slate-800 font-black text-xl mb-6">Seberapa puas Anda?</label>
                    <div class="flex items-center justify-center gap-2 sm:gap-4 star-rating group/rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" {{ old('rating') == $i ? 'checked' : '' }} required />
                            <label for="star{{ $i }}" class="text-4xl sm:text-5xl text-slate-200 cursor-pointer peer-checked:text-amber-400 transition-all duration-300 hover:scale-110">
                                <i class="fas fa-star drop-shadow-sm"></i>
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-rose-500 text-sm mt-3 font-bold bg-rose-50 inline-block px-3 py-1 rounded-full"><i class="fas fa-info-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Comment Section -->
                <div class="mb-10">
                    <label for="comment" class="block text-slate-800 font-black text-lg mb-3 flex items-center gap-2">
                        <i class="fas fa-pen text-indigo-500 text-sm"></i> Tulis Testimoni Anda
                    </label>
                    <div class="relative">
                        <textarea name="comment" id="comment" rows="4" class="w-full bg-slate-50/50 border-2 border-slate-100 rounded-3xl p-5 text-slate-700 focus:ring-0 focus:border-indigo-500 focus:bg-white transition-all resize-none placeholder-slate-400 text-lg shadow-inner" placeholder="Ceritakan keseruan Anda! Apa yang paling berkesan? (Opsional)">{{ old('comment') }}</textarea>
                        <div class="absolute bottom-4 right-4 text-slate-300">
                            <i class="fas fa-quote-right text-2xl opacity-50"></i>
                        </div>
                    </div>
                    @error('comment')
                        <p class="text-rose-500 text-sm mt-3 font-bold bg-rose-50 inline-block px-3 py-1 rounded-full"><i class="fas fa-info-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-4 px-8 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-full font-black text-lg shadow-xl shadow-indigo-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group">
                    Kirim Penilaian Saya
                    <i class="fas fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .star-rating {
        flex-direction: row-reverse;
    }
    .star-rating input:checked ~ label {
        color: #fbbf24;
        text-shadow: 0 0 15px rgba(251, 191, 36, 0.4);
    }
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #fcd34d;
        text-shadow: 0 0 20px rgba(252, 211, 77, 0.6);
    }
</style>
@endsection
