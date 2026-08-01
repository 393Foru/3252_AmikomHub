@extends('layouts.app')
@section('title', 'Pembayaran Gagal - ' . $transaction->event->title)
@section('content')
<main class="max-w-4xl mx-auto px-4 py-12 md:py-20">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side: Detail & Breakdown -->
        <div class="w-full md:w-[55%] p-6 md:p-8 bg-slate-50 flex flex-col justify-center relative">
            <div class="absolute right-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-slate-200 to-transparent hidden md:block"></div>
            
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <span class="px-3 py-1 bg-slate-200 text-slate-600 text-[10px] font-black tracking-wider rounded-md uppercase">Order #{{ $transaction->order_id }}</span>
                </div>
                <h2 class="text-xl md:text-2xl font-black text-slate-800 mb-2 leading-tight">{{ $transaction->event->title }}</h2>
                <p class="text-slate-500 text-xs md:text-sm leading-relaxed">Pesanan ini telah kadaluarsa atau dibatalkan.</p>
            </div>
            
            <!-- Breakdown Tagihan -->
            <div class="bg-white p-5 rounded-xl border border-slate-100 mb-5 shadow-sm relative overflow-hidden opacity-75">
                <div class="absolute -right-4 -top-4 opacity-5 pointer-events-none">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.64-2.25 1.64-1.74 0-2.1-.96-2.17-1.92H8.01c.12 1.98 1.2 3.1 2.9 3.44V20h2.4v-1.7c1.71-.32 2.8-1.46 2.8-2.98 0-2.02-1.72-2.88-3.8-3.34z"/></svg>
                </div>
                
                <div class="flex justify-between items-center mb-2.5 relative z-10">
                    <span class="text-xs font-medium text-slate-500">Harga Tiket (1x)</span>
                    <span class="text-sm font-bold text-slate-700 line-through decoration-slate-300">Rp {{ number_format($transaction->event->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-dashed border-slate-200 relative z-10">
                    <span class="text-xs font-medium text-slate-500">Biaya Layanan</span>
                    <span class="text-sm font-bold text-slate-700 line-through decoration-slate-300">{{ $transaction->event->price > 0 ? 'Rp 5.000' : 'Rp 0' }}</span>
                </div>
                <div class="flex justify-between items-end relative z-10">
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider mb-1">Total Dibayar</p>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-600 line-through decoration-slate-300">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Failed Status Badge -->
            <div class="bg-rose-50 p-4 rounded-xl border border-rose-100 flex flex-row items-center justify-center">
                <p class="text-sm text-rose-600 font-bold flex items-center gap-2 uppercase tracking-widest">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Transaksi Gagal
                </p>
            </div>
        </div>

        <!-- Right Side: Failed Message -->
        <div class="w-full md:w-[45%] p-6 md:p-8 flex flex-col items-center justify-center text-center bg-white relative">
            <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            
            <h3 class="text-xl md:text-2xl font-black mb-3 text-slate-800">Pembayaran Gagal!</h3>
            <p class="text-slate-500 text-xs mb-8 leading-relaxed md:px-2">Maaf, pembayaran Anda tidak dapat diproses atau batas waktu telah habis. Silakan buat pesanan baru untuk melanjutkan.</p>

            <a href="{{ route('checkout.create', $transaction->event_id) }}" class="w-full py-4 bg-rose-600 text-white rounded-xl font-bold text-sm shadow-[0_4px_12px_-4px_rgba(225,29,72,0.5)] hover:bg-rose-700 hover:shadow-rose-500/40 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center gap-2">
                Pesan Ulang Tiket
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </a>
            
            <a href="{{ route('home') }}" class="text-[11px] text-slate-400 hover:text-slate-600 transition-colors mt-6 font-medium underline underline-offset-2">Kembali ke Beranda</a>
        </div>

    </div>
</main>
@endsection
