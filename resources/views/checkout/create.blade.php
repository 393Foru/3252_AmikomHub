@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')
<main class="py-6 md:py-8">
    
    <!-- Breadcrumb (Full Width) -->
    <nav class="flex items-center text-sm text-slate-500 font-medium mb-8 whitespace-nowrap overflow-x-auto pb-2 scrollbar-hide">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Beranda
        </a>
        <svg class="w-4 h-4 mx-2 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <a href="{{ route('events.index') ?? '#' }}" class="hover:text-indigo-600 transition-colors">Event</a>
        <svg class="w-4 h-4 mx-2 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <a href="{{ route('events.show', $event->id) }}" class="hover:text-indigo-600 transition-colors max-w-[120px] sm:max-w-[200px] truncate" title="{{ $event->title }}">{{ $event->title }}</a>
        <svg class="w-4 h-4 mx-2 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <span class="text-slate-800 font-bold bg-slate-100 px-2.5 py-1 rounded-md">Checkout</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-x-10 lg:gap-y-8 lg:items-start">
        
        <!-- Header & Alerts (Left Column Top) -->
        <div class="col-span-1 lg:col-span-7 xl:col-span-8">
            <div class="mb-4">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">Checkout Tiket</h1>
                <p class="text-slate-500 mt-2 md:mt-3 text-base md:text-lg">Lengkapi data diri Anda di bawah ini untuk mengamankan tiket.</p>
            </div>
            
            <!-- Error Alert -->
            @if(session('error'))
            <div class="mt-4 mb-2 p-4 md:p-5 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-2xl font-bold flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <p class="text-sm md:text-base">{{ session('error') }}</p>
            </div>
            @endif

            <!-- FOMO / Countdown Timer -->
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start sm:items-center gap-3 md:gap-4 shadow-sm shadow-amber-100/50 mt-4">
                <div class="bg-amber-100 text-amber-600 p-2 rounded-full shrink-0 mt-0.5 sm:mt-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm md:text-base text-amber-800 font-medium">Tiket Anda sedang diamankan sementara.</p>
                    <p class="text-xs md:text-sm text-amber-600/80 mt-0.5">Selesaikan pengisian data dalam <span id="countdown" class="font-bold text-amber-700">15:00</span> menit.</p>
                </div>
            </div>
        </div>

        <!-- Summary Card (Right Column on Desktop, Middle on Mobile) -->
        <div class="col-span-1 lg:col-span-5 xl:col-span-4 lg:row-span-2 lg:sticky lg:top-24">
            <div class="w-full bg-white rounded-3xl border border-slate-200 p-6 md:p-8 shadow-sm">
                <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Ringkasan Pesanan
                </h3>
                
                <div class="flex gap-4 md:gap-5 items-start mb-6 pb-6 border-b border-slate-200/60">
                    <img src="{{ ($event->poster_path) ? (\Illuminate\Support\Str::startsWith($event->poster_path, 'http') ? $event->poster_path : (\Illuminate\Support\Str::startsWith($event->poster_path, 'http') ? $event->poster_path : asset('storage/' . $event->poster_path))) : 'https://placehold.co/160x200' }}" alt="Event Poster" class="w-20 h-20 md:w-24 md:h-24 rounded-xl object-cover shadow-sm border border-slate-200">
                    <div class="flex-1">
                        <h4 class="font-bold text-slate-800 leading-snug line-clamp-2">{{ $event->title }}</h4>
                        <div class="mt-2 text-xs md:text-sm font-medium text-slate-500 space-y-1.5">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $event->date->format('d M Y') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="truncate">{{ $event->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4 md:space-y-5">
                    <div class="flex justify-between text-slate-600 text-sm md:text-base">
                        <span>Harga Tiket (1x)</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600 text-sm md:text-base">
                        <span>Biaya Layanan</span>
                        <span class="font-semibold text-slate-800">Rp 5.000</span>
                    </div>
                    
                    <div class="pt-5 mt-3 border-t-2 border-dashed border-slate-200">
                        <div class="flex justify-between items-end">
                            <span class="text-sm md:text-base font-bold text-slate-800">Total Bayar</span>
                            <span class="text-2xl md:text-3xl font-black text-indigo-600 tracking-tight">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="mt-8 pt-6 border-t border-slate-200/60">
                    <div class="flex items-center justify-center gap-2 text-slate-500 mb-4">
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        <span class="text-xs font-bold uppercase tracking-wider">100% Pembayaran Aman</span>
                    </div>
                    <div class="flex justify-center gap-3 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                        <!-- Simulated Payment Icons -->
                        <div class="w-10 h-6 bg-slate-200 rounded flex items-center justify-center text-[8px] font-black">VISA</div>
                        <div class="w-10 h-6 bg-slate-200 rounded flex items-center justify-center text-[8px] font-black text-blue-900">BCA</div>
                        <div class="w-10 h-6 bg-slate-200 rounded flex items-center justify-center text-[8px] font-black text-green-700">GoPay</div>
                        <div class="w-10 h-6 bg-slate-200 rounded flex items-center justify-center text-[8px] font-black text-purple-700">OVO</div>
                        <div class="w-10 h-6 bg-slate-200 rounded flex items-center justify-center text-[8px] font-black text-red-600">QRIS</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card (Left Column on Desktop, Bottom on Mobile) -->
        <div class="col-span-1 lg:col-span-7 xl:col-span-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 pb-6 border-b border-slate-100 gap-4">
                    <h3 class="text-xl md:text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                        <div class="bg-indigo-100 text-indigo-600 p-2 md:p-2.5 rounded-xl">
                            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        Data Pemesan
                    </h3>
                    
                    <div class="text-right">
                        @auth
                            <span class="inline-block w-fit text-xs font-bold bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-full ring-1 ring-emerald-200/50">Anggota Terdaftar</span>
                        @else
                            <span class="inline-block w-fit text-xs font-bold bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full ring-1 ring-slate-200">Checkout sebagai Tamu</span>
                            <div class="mt-1.5 text-[11px] font-medium text-slate-500">
                                Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-bold">Masuk</a>
                            </div>
                        @endauth
                    </div>
                </div>
                
                <form id="checkoutForm" action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6 md:space-y-7">
                    @csrf
                    
                    <!-- Input Nama -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" name="customer_name" placeholder="Masukkan nama sesuai KTP" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_name', auth()->check() ? auth()->user()->name : '') }}">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-7">
                        <!-- Input Email -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email <span class="text-rose-500">*</span></label>
                            <input type="email" name="customer_email" placeholder="contoh@email.com" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_email', auth()->check() ? auth()->user()->email : '') }}">
                            <p class="text-[11px] md:text-xs text-slate-500 mt-2.5 font-medium flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                E-Ticket akan dikirim ke email ini
                            </p>
                        </div>
                        
                        <!-- Input WhatsApp -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">No. WhatsApp <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none border-r border-slate-200 pr-3">
                                    <span class="text-slate-500 font-bold">+62</span>
                                </div>
                                <input type="tel" name="customer_phone" placeholder="81234567890" class="w-full pl-16 pr-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all font-medium text-slate-800 placeholder-slate-400" required value="{{ old('customer_phone') }}">
                            </div>
                            <p class="text-[11px] md:text-xs text-slate-500 mt-2.5 font-medium flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.964 9.964 0 001.333 4.976L2 22l5.233-1.337a9.982 9.982 0 004.779 1.217h.004c5.505 0 9.988-4.478 9.989-9.984 0-2.669-1.037-5.182-2.923-7.072A9.92 9.92 0 0012.012 2zm5.884 14.161c-.247.697-1.42 1.328-1.942 1.4-1.284.18-2.884-.336-5.834-2.186-3.667-2.302-6.113-6.241-6.3-6.486-.183-.243-1.503-1.996-1.503-3.81 0-1.815.939-2.735 1.272-3.087.33-.35.719-.437.962-.437.243 0 .485.003.7.014.225.011.53-.087.828.634.305.74 1.058 2.585 1.152 2.775.093.19.155.412.03.66-.123.248-.186.398-.372.616-.183.218-.387.48-.553.645-.18.18-.368.379-.16.738.205.358.914 1.517 1.963 2.454 1.353 1.21 2.49 1.583 2.84 1.761.35.178.553.15.758-.083.206-.235.888-1.034 1.127-1.388.24-.355.48-.295.8-.175.322.119 2.035.96 2.383 1.135.347.175.58.263.665.41.085.148.085.856-.162 1.554z"></path></svg>
                                E-Ticket akan dikirim ke WA ini juga
                            </p>
                        </div>
                    </div>
                    
                    <div class="pt-8 mt-8 border-t border-slate-100">
                        <!-- Checkbox S&K -->
                        <div class="mb-6 flex items-start gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors cursor-pointer" onclick="document.getElementById('terms').click()">
                            <div class="flex items-center h-5 mt-0.5">
                                <input id="terms" type="checkbox" required class="w-4 h-4 text-indigo-600 bg-white border-slate-300 rounded focus:ring-indigo-500 focus:ring-2 cursor-pointer transition-colors" onclick="event.stopPropagation()">
                            </div>
                            <label for="terms" class="text-xs md:text-sm text-slate-600 cursor-pointer select-none leading-relaxed">
                                Saya telah memastikan data benar dan menyetujui <a href="{{ route('terms-conditions') }}" class="text-indigo-600 font-bold hover:underline" onclick="event.stopPropagation()">Syarat & Ketentuan</a> serta <a href="{{ route('privacy-policy') }}" class="text-indigo-600 font-bold hover:underline" onclick="event.stopPropagation()">Kebijakan Privasi</a> yang berlaku.
                            </label>
                        </div>

                        <!-- Desktop Submit Button -->
                        <div class="hidden lg:block">
                            <button id="submitBtnDesktop" type="submit" disabled class="w-full py-4 md:py-4 bg-indigo-600 text-white rounded-xl font-bold text-lg shadow-lg shadow-indigo-600/20 hover:bg-indigo-700 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2 group disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:shadow-none disabled:bg-slate-400">
                                <span class="btn-text">Lanjut ke Pembayaran</span>
                                <svg class="btn-icon w-5 h-5 group-disabled:hidden transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                <svg class="btn-spinner hidden w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>

<!-- Mobile Sticky Bottom Button -->
<div class="fixed bottom-0 left-0 right-0 p-4 bg-white border-t border-slate-200 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)] z-50 lg:hidden">
    <div class="max-w-6xl mx-auto flex items-center justify-between gap-4">
        <div class="flex-1">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Total Bayar</p>
            <p class="text-xl font-black text-indigo-600 leading-none">Rp {{ number_format($event->price + 5000, 0, ',', '.') }}</p>
        </div>
        <button id="submitBtnMobile" type="button" disabled onclick="document.getElementById('checkoutForm').requestSubmit()" class="w-[60%] py-3.5 bg-indigo-600 text-white rounded-xl font-bold text-base shadow-lg shadow-indigo-600/30 hover:bg-indigo-700 active:scale-[0.98] transition-all flex items-center justify-center gap-2 group disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none disabled:bg-slate-400 disabled:active:scale-100">
            <span class="btn-text">Bayar</span>
            <svg class="btn-icon w-4 h-4 group-disabled:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            <svg class="btn-spinner hidden w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
        </button>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Simple Countdown Script
        const countdownEl = document.getElementById('countdown');
        if (countdownEl) {
            let timeLeft = 15 * 60; // 15 minutes in seconds
            const timer = setInterval(() => {
                timeLeft--;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    countdownEl.textContent = "Waktu Habis";
                    countdownEl.classList.remove('text-amber-700');
                    countdownEl.classList.add('text-rose-600');
                    return;
                }
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);
        }

        // 2. Checkbox & Submit Loading State
        const form = document.getElementById('checkoutForm');
        const termsCheck = document.getElementById('terms');
        const submitBtnDesktop = document.getElementById('submitBtnDesktop');
        const submitBtnMobile = document.getElementById('submitBtnMobile');
        
        function updateButtonState() {
            const isChecked = termsCheck.checked;
            if(submitBtnDesktop) submitBtnDesktop.disabled = !isChecked;
            if(submitBtnMobile) submitBtnMobile.disabled = !isChecked;
        }
        
        // Initial check and set event listener
        if(termsCheck) {
            updateButtonState();
            termsCheck.addEventListener('change', updateButtonState);
        }
        
        if(form) {
            form.addEventListener('submit', function(e) {
                // Double check validation
                if (termsCheck && !termsCheck.checked) {
                    e.preventDefault();
                    // Optional: add visual shake effect to checkbox if not checked
                    const cbWrapper = termsCheck.closest('div.bg-slate-50');
                    if(cbWrapper) {
                        cbWrapper.classList.add('ring-2', 'ring-rose-400');
                        setTimeout(() => cbWrapper.classList.remove('ring-2', 'ring-rose-400'), 1500);
                    }
                    return false;
                }
                
                // Show loading on Desktop
                if(submitBtnDesktop) {
                    submitBtnDesktop.disabled = true;
                    submitBtnDesktop.querySelector('.btn-text').textContent = "Memproses...";
                    submitBtnDesktop.querySelector('.btn-icon')?.classList.add('hidden');
                    submitBtnDesktop.querySelector('.btn-spinner')?.classList.remove('hidden');
                }
                
                // Show loading on Mobile
                if(submitBtnMobile) {
                    submitBtnMobile.disabled = true;
                    submitBtnMobile.querySelector('.btn-text').textContent = "Proses...";
                    submitBtnMobile.querySelector('.btn-icon')?.classList.add('hidden');
                    submitBtnMobile.querySelector('.btn-spinner')?.classList.remove('hidden');
                }
            });
        }
    });
</script>
@endpush
@endsection