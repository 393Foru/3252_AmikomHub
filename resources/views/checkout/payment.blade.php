@extends('layouts.app')
@section('title', 'Pembayaran - ' . $transaction->event->title)
@section('content')
<main class="max-w-4xl mx-auto px-4 py-12 md:py-20">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side: Detail & Timer -->
        <div class="w-full md:w-[55%] p-6 md:p-8 bg-slate-50 flex flex-col justify-center relative">
            <div class="absolute right-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-slate-200 to-transparent hidden md:block"></div>
            
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-[10px] font-black tracking-wider rounded-md uppercase">Order #{{ $transaction->order_id }}</span>
                </div>
                <h2 class="text-xl md:text-2xl font-black text-slate-800 mb-2 leading-tight">{{ $transaction->event->title }}</h2>
                <p class="text-slate-500 text-xs md:text-sm leading-relaxed">Selesaikan pembayaran tiket Anda agar tidak kehabisan kuota.</p>
            </div>
            
            <!-- Breakdown Tagihan -->
            <div class="bg-white p-5 rounded-xl border border-slate-100 mb-5 shadow-sm relative overflow-hidden">
                <div class="absolute -right-4 -top-4 opacity-5 pointer-events-none">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.64-2.25 1.64-1.74 0-2.1-.96-2.17-1.92H8.01c.12 1.98 1.2 3.1 2.9 3.44V20h2.4v-1.7c1.71-.32 2.8-1.46 2.8-2.98 0-2.02-1.72-2.88-3.8-3.34z"/></svg>
                </div>
                
                <div class="flex justify-between items-center mb-2.5 relative z-10">
                    <span class="text-xs font-medium text-slate-500">Harga Tiket (1x)</span>
                    <span class="text-sm font-bold text-slate-700">Rp {{ number_format($transaction->event->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-dashed border-slate-200 relative z-10">
                    <span class="text-xs font-medium text-slate-500">Biaya Layanan</span>
                    <span class="text-sm font-bold text-slate-700">{{ $transaction->event->price > 0 ? 'Rp 5.000' : 'Rp 0' }}</span>
                </div>
                <div class="flex justify-between items-end relative z-10">
                    <p class="text-[10px] text-indigo-500 font-bold uppercase tracking-wider mb-1">Total Pembayaran</p>
                    <h3 class="text-2xl md:text-3xl font-black text-indigo-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Timer -->
            <div class="bg-red-50 p-4 rounded-xl border border-red-100 flex flex-row items-center justify-between">
                <div>
                    <p class="text-[10px] text-red-500 font-bold flex items-center gap-1.5 uppercase tracking-wide">
                        <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Batas Waktu
                    </p>
                </div>
                <div class="flex items-center gap-2 text-red-600 font-mono text-xl md:text-2xl font-black" id="countdown">
                    <div class="flex flex-col items-center"><span id="hours">00</span></div>
                    <div class="animate-pulse mb-0.5">:</div>
                    <div class="flex flex-col items-center"><span id="minutes">00</span></div>
                    <div class="animate-pulse mb-0.5">:</div>
                    <div class="flex flex-col items-center"><span id="seconds">00</span></div>
                </div>
            </div>
        </div>

        <!-- Right Side: Action -->
        <div class="w-full md:w-[45%] p-6 md:p-8 flex flex-col items-center justify-center text-center bg-white relative">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            
            <h3 class="text-lg md:text-xl font-black mb-2 text-slate-800">Lanjutkan Pembayaran</h3>
            <p class="text-slate-500 text-xs mb-6 leading-relaxed md:px-2">Pilih metode pembayaran favorit Anda di layar selanjutnya. Transaksi dijamin aman.</p>

            <button id="pay-button" class="relative w-full py-4 bg-indigo-600 text-white rounded-xl font-bold text-sm shadow-[0_4px_12px_-4px_rgba(79,70,229,0.5)] hover:bg-indigo-700 hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all active:scale-95 flex items-center justify-center disabled:opacity-70 disabled:cursor-not-allowed">
                <span id="button-text" class="flex items-center gap-2">
                    Bayar Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
                <svg id="button-spinner" class="w-5 h-5 animate-spin hidden absolute" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            
            <div class="mt-5 mb-2 w-full">
                <p class="text-[9px] text-slate-400 mb-2 uppercase font-bold tracking-widest text-center">Metode Pembayaran</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <span class="px-2 py-1 bg-slate-50 border border-slate-200 text-[10px] text-slate-500 font-semibold rounded shadow-sm">Bank Transfer</span>
                    <span class="px-2 py-1 bg-slate-50 border border-slate-200 text-[10px] text-slate-500 font-semibold rounded shadow-sm">QRIS</span>
                    <span class="px-2 py-1 bg-slate-50 border border-slate-200 text-[10px] text-slate-500 font-semibold rounded shadow-sm">GoPay</span>
                    <span class="px-2 py-1 bg-slate-50 border border-slate-200 text-[10px] text-slate-500 font-semibold rounded shadow-sm">OVO</span>
                </div>
            </div>

            <a href="{{ route('checkout.failed', $transaction->order_id) }}" class="inline-block mt-4 text-xs font-bold text-slate-400 hover:text-rose-500 transition-colors underline underline-offset-4">Batalkan Pesanan & Kembali</a>
        </div>

    </div>
</main>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    const payBtn = document.getElementById('pay-button');
    const btnText = document.getElementById('button-text');
    const btnSpinner = document.getElementById('button-spinner');

    payBtn.onclick = function () {
        // Tampilkan loading state
        payBtn.disabled = true;
        btnText.classList.add('hidden');
        btnSpinner.classList.remove('hidden');

        snap.pay('{{ $transaction->snap_token }}', {
            onSuccess: function (result) {
                window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
            },
            onPending: function(result) {
                window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
            },
            onError: function(result) {
                alert("Pembayaran gagal diproses!");
                resetButton();
            },
            onClose: function () {
                // Muncul alert jika user sengaja menutup pop-up sebelum selesai
                alert("Anda belum menyelesaikan pembayaran, silakan klik Bayar Sekarang kembali untuk melanjutkan.");
                resetButton();
            }
        });
    };

    function resetButton() {
        payBtn.disabled = false;
        btnText.classList.remove('hidden');
        btnSpinner.classList.add('hidden');
    }

    // Timer Logic
    const createdAtIso = "{{ $transaction->created_at->toISOString() }}";
    const createdAt = new Date(createdAtIso).getTime();
    // Asumsi batas waktu adalah 24 jam dari waktu transaksi dibuat
    const expiredAt = createdAt + (24 * 60 * 60 * 1000); 

    const countdownElement = document.getElementById("countdown");
    const hEl = document.getElementById("hours");
    const mEl = document.getElementById("minutes");
    const sEl = document.getElementById("seconds");

    const timerInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = expiredAt - now;

        if (distance < 0) {
            clearInterval(timerInterval);
            countdownElement.innerHTML = "<div class='text-2xl font-black text-red-600 w-full'>WAKTU HABIS</div>";
            
            payBtn.disabled = true;
            payBtn.classList.replace('bg-indigo-600', 'bg-slate-300');
            payBtn.classList.replace('hover:bg-indigo-700', 'hover:bg-slate-300');
            payBtn.classList.remove('active:scale-95', 'hover:-translate-y-0.5', 'hover:shadow-indigo-500/40', 'shadow-[0_4px_12px_-4px_rgba(79,70,229,0.5)]');
            btnText.innerText = "Kadaluarsa";
            payBtn.style.cursor = "not-allowed";
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(hEl && mEl && sEl) {
            hEl.innerText = hours.toString().padStart(2, '0');
            mEl.innerText = minutes.toString().padStart(2, '0');
            sEl.innerText = seconds.toString().padStart(2, '0');
        }
    }, 1000);
</script>
@endsection