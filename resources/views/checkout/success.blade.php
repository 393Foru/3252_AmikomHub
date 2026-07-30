@extends('layouts.app')
@section('title', 'Pembayaran Berhasil')
@section('content')
<main class="max-w-3xl mx-auto px-4 py-16 md:py-24 text-center">
    <div class="bg-white rounded-3xl border border-slate-100 p-10 md:p-14 shadow-xl overflow-hidden relative inline-block w-full max-w-md">
        <!-- Decorative element -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-green-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-emerald-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

        <div class="relative z-10">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h2 class="text-2xl md:text-3xl font-black mb-4 text-slate-800">Terima Kasih!</h2>
            
            <p class="text-slate-500 mb-8 leading-relaxed text-sm md:text-base px-2">
                Pembayaran untuk pesanan <strong class="text-slate-800">{{ $transaction->order_id }}</strong> sedang diproses atau telah berhasil. 
                E-Ticket akan dikirim ke email Anda (<strong class="text-slate-800">{{ $transaction->customer_email }}</strong>) setelah pembayaran terkonfirmasi lunas.
            </p>
            
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-full py-4 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 transition shadow-[0_4px_12px_-4px_rgba(79,70,229,0.5)] hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:scale-95 gap-2">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</main>
@endsection