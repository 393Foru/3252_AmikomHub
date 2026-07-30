@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-0 relative z-10">
    <x-breadcrumb :items="[
        ['label' => 'Panduan Pesan']
    ]" />
</div>

<div class="max-w-4xl mx-auto px-6 pt-6 pb-8">
    <div class="text-center mb-20 step-item opacity-0 translate-y-8 transition-all duration-700 ease-out">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 border border-indigo-100 font-bold text-xs uppercase tracking-widest mb-6 shadow-sm">
            <i class="fas fa-book-open"></i> Panduan Lengkap
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-6 tracking-tight">
            Cara Pesan Tiket
        </h1>
        <p class="text-slate-500 font-medium text-lg max-w-2xl mx-auto leading-relaxed">
            Hanya butuh beberapa menit untuk mengamankan kursimu di event favorit. Ikuti 4 langkah mudah berikut ini.
        </p>
    </div>

    <!-- Glowing Timeline -->
    <div class="space-y-12 relative before:absolute before:inset-0 before:ml-6 md:before:mx-auto md:before:translate-x-0 before:h-full before:w-1 before:bg-gradient-to-b before:from-indigo-400 before:via-cyan-400 before:to-transparent before:opacity-30 before:rounded-full">
        
        <!-- Step 1 -->
        <div class="step-item relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group opacity-0 translate-y-8 transition-all duration-700 ease-out">
            <div class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-white bg-gradient-to-br from-indigo-500 to-indigo-600 text-white shadow-[0_0_15px_rgba(79,70,229,0.4)] shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-all duration-300 group-hover:scale-110 group-hover:shadow-[0_0_25px_rgba(79,70,229,0.6)] group-hover:border-indigo-50">
                <i class="fas fa-search text-base"></i>
            </div>
            <div class="w-[calc(100%-4.5rem)] md:w-[calc(50%-3rem)] bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                <i class="fas fa-search absolute -bottom-8 -right-8 text-9xl text-slate-100 opacity-30 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-700 pointer-events-none"></i>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-cyan-500 font-black text-2xl">01</span>
                        <h3 class="font-bold text-xl text-slate-900">Pilih Event Favoritmu</h3>
                    </div>
                    <p class="text-slate-500 leading-relaxed sm:text-base">Jelajahi halaman beranda atau katalog event. Gunakan filter kategori untuk menemukan seminar atau workshop yang paling sesuai dengan minatmu.</p>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step-item relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group opacity-0 translate-y-8 transition-all duration-700 ease-out" style="transition-delay: 150ms;">
            <div class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-white bg-gradient-to-br from-cyan-500 to-blue-600 text-white shadow-[0_0_15px_rgba(6,182,212,0.4)] shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-all duration-300 group-hover:scale-110 group-hover:shadow-[0_0_25px_rgba(6,182,212,0.6)] group-hover:border-cyan-50">
                <i class="fas fa-user-check text-base"></i>
            </div>
            <div class="w-[calc(100%-4.5rem)] md:w-[calc(50%-3rem)] bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                <i class="fas fa-user-circle absolute -bottom-8 -left-8 md:-left-auto md:-right-8 text-9xl text-slate-100 opacity-30 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-700 pointer-events-none"></i>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600 font-black text-2xl">02</span>
                        <h3 class="font-bold text-xl text-slate-900">Masuk atau Daftar Akun</h3>
                    </div>
                    <p class="text-slate-500 leading-relaxed sm:text-base">Untuk melanjutkan pemesanan, pastikan kamu sudah mendaftar dan masuk (login) ke dalam sistem Eventama agar tiketmu tersimpan dengan aman.</p>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="step-item relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group opacity-0 translate-y-8 transition-all duration-700 ease-out" style="transition-delay: 300ms;">
            <div class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-white bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-[0_0_15px_rgba(59,130,246,0.4)] shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-all duration-300 group-hover:scale-110 group-hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] group-hover:border-blue-50">
                <i class="fas fa-wallet text-base"></i>
            </div>
            <div class="w-[calc(100%-4.5rem)] md:w-[calc(50%-3rem)] bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                <i class="fas fa-credit-card absolute -bottom-8 -right-8 text-9xl text-slate-100 opacity-30 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-700 pointer-events-none"></i>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-600 font-black text-2xl">03</span>
                        <h3 class="font-bold text-xl text-slate-900">Checkout & Pembayaran</h3>
                    </div>
                    <p class="text-slate-500 leading-relaxed sm:text-base mb-4">Klik tombol "Beli Tiket" pada detail event. Periksa kembali pesananmu, lalu selesaikan pembayaran sesuai dengan metode yang diinstruksikan.</p>
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 text-indigo-700 px-4 py-3 rounded-xl border border-indigo-100/50 text-xs font-semibold flex items-start gap-3">
                        <i class="fas fa-info-circle text-indigo-500 text-sm mt-0.5"></i>
                        <span class="leading-relaxed">Untuk <strong>Event Gratis</strong>, langkah ini akan otomatis dilewati dan tiket Anda langsung diterbitkan.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="step-item relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group opacity-0 translate-y-8 transition-all duration-700 ease-out" style="transition-delay: 450ms;">
            <div class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-white bg-gradient-to-br from-green-400 to-emerald-600 text-white shadow-[0_0_15px_rgba(16,185,129,0.4)] shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-all duration-300 group-hover:scale-110 group-hover:shadow-[0_0_25px_rgba(16,185,129,0.6)] group-hover:border-emerald-50">
                <i class="fas fa-ticket-alt text-base"></i>
            </div>
            <div class="w-[calc(100%-4.5rem)] md:w-[calc(50%-3rem)] bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                <i class="fas fa-qrcode absolute -bottom-8 -left-8 md:-left-auto md:-right-8 text-9xl text-slate-100 opacity-30 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-700 pointer-events-none"></i>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600 font-black text-2xl">04</span>
                        <h3 class="font-bold text-xl text-slate-900">Tiket Berhasil Didapatkan</h3>
                    </div>
                    <p class="text-slate-500 leading-relaxed sm:text-base">Selamat! Tiketmu akan langsung masuk ke menu "Tiket Saya". Tunjukkan QR Code dari detail tiket tersebut kepada panitia saat acara berlangsung.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- FAQ Section -->
    <div class="mt-20 pt-10 step-item opacity-0 translate-y-8 transition-all duration-700 ease-out">
        <h2 class="text-2xl md:text-3xl font-black text-center text-slate-900 mb-10">Pertanyaan yang Sering Diajukan (FAQ)</h2>
        <div class="max-w-3xl mx-auto space-y-4">
            
            <details class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 [&_summary::-webkit-details-marker]:hidden" open>
                <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 font-bold focus:outline-none">
                    Apakah tiket perlu dicetak?
                    <span class="shrink-0 transition duration-300 group-open:-rotate-180 bg-slate-50 w-8 h-8 rounded-full flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-slate-500 text-sm leading-relaxed border-t border-slate-50 pt-4 mt-2">
                    Tidak perlu. Anda cukup menunjukkan E-Ticket atau QR Code yang ada di menu "Tiket Saya" melalui layar smartphone Anda kepada panitia saat registrasi ulang di lokasi event.
                </div>
            </details>

            <details class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 font-bold focus:outline-none">
                    Bagaimana jika saya salah memasukkan email saat pendaftaran?
                    <span class="shrink-0 transition duration-300 group-open:-rotate-180 bg-slate-50 w-8 h-8 rounded-full flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-slate-500 text-sm leading-relaxed border-t border-slate-50 pt-4 mt-2">
                    Kami sarankan untuk membuat akun baru dengan email yang benar sebelum melakukan pemesanan tiket. Jika Anda sudah terlanjur membeli tiket, harap segera hubungi Tim Bantuan kami dengan menyertakan bukti pembayaran.
                </div>
            </details>

            <details class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 font-bold focus:outline-none">
                    Apakah tiket yang sudah dibeli bisa di-refund?
                    <span class="shrink-0 transition duration-300 group-open:-rotate-180 bg-slate-50 w-8 h-8 rounded-full flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-slate-500 text-sm leading-relaxed border-t border-slate-50 pt-4 mt-2">
                    Kebijakan refund (pengembalian dana) bergantung pada masing-masing penyelenggara event. Silakan cek detail "Syarat & Ketentuan" pada halaman event yang bersangkutan sebelum melakukan pembelian. Umumnya, tiket tidak dapat di-refund jika tidak ada pembatalan dari pihak penyelenggara.
                </div>
            </details>

        </div>
    </div>

    <!-- Mega CTA Banner -->
    <div class="mt-20 relative overflow-hidden rounded-[2.5rem] bg-slate-900 shadow-2xl step-item opacity-0 translate-y-8 transition-all duration-700 ease-out border border-slate-800">
        <!-- Background decorations -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 to-cyan-900/40 z-0"></div>
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-indigo-300 via-transparent to-transparent z-0"></div>
        <!-- Abstract glowing orbs -->
        <div class="absolute -top-32 -right-32 w-80 h-80 bg-indigo-500 rounded-full mix-blend-screen filter blur-[80px] opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-cyan-500 rounded-full mix-blend-screen filter blur-[80px] opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
        
        <div class="relative z-10 px-6 py-16 md:py-20 text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-6 tracking-tight">Siap Untuk Memulai?</h2>
            <p class="text-indigo-100/80 mb-10 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">Temukan event menarik, tambah wawasan, dan perluas networking Anda sekarang juga. Tim support kami siap membantu jika Anda mengalami kendala.</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-5">
                <a href="{{ route('events.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-cyan-400 to-blue-500 text-white font-bold rounded-full shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:scale-105 transition-all duration-300 group">
                    Cari Event Sekarang 
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="mailto:cs@amikomevent.id" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-full backdrop-blur-md border border-white/10 hover:border-white/30 transition-all duration-300">
                    <i class="fas fa-headset"></i> Butuh Bantuan?
                </a>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-8', 'translate-y-4');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    // Stop observing once animated
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        });

        document.querySelectorAll('.step-item').forEach(item => {
            observer.observe(item);
        });
    });
</script>
@endpush
@endsection