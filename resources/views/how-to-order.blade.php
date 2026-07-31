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

    <!-- Creative Split-Layout CTA Banner -->
    <div class="mt-20 relative rounded-[2.5rem] bg-gradient-to-br from-[#f8fafc] to-[#eff6ff] shadow-xl shadow-slate-200/50 border border-white step-item opacity-0 translate-y-8 transition-all duration-700 ease-out overflow-hidden">
        
        <!-- Abstract Background Shapes -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-indigo-100/50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center px-8 py-12 md:p-16">
            
            <!-- Left Content: Text & Buttons -->
            <div class="text-center lg:text-left order-2 lg:order-1">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 mb-5 tracking-tight leading-tight">Siap Memulai<br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Pengalaman Baru?</span></h2>
                <p class="text-slate-500 mb-8 text-base md:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0">Temukan ribuan event menarik, perlebar wawasan, dan perluas networking Anda. Kami siap mendukung setiap langkah Anda.</p>
                
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center gap-3 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 whitespace-nowrap">
                        Cari Event Sekarang 
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="mailto:cs@amikomevent.id" class="inline-flex items-center justify-center gap-3 px-6 py-3 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-xl border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow transition-all duration-300 whitespace-nowrap">
                        <i class="fas fa-headset text-slate-400"></i> Butuh Bantuan?
                    </a>
                </div>
            </div>

            <!-- Right Content: Visual/Illustration -->
            <div class="order-1 lg:order-2 flex justify-center items-center relative py-6">
                <!-- Decorative Ticket Illustration -->
                <div class="relative w-full max-w-[280px] sm:max-w-xs group cursor-default perspective-1000 animate-float-ticket">
                    
                    <!-- Backdrop Shadow Box -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-300 to-blue-300 rounded-3xl transform rotate-6 scale-105 opacity-40 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-700"></div>
                    
                    <!-- Main Ticket Card -->
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border border-white p-6 sm:p-8 flex flex-col gap-5 transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        <!-- Cutouts -->
                        <div class="absolute top-1/2 -left-3 -translate-y-1/2 w-6 h-6 bg-[#eff6ff] rounded-full shadow-inner"></div>
                        <div class="absolute top-1/2 -right-3 -translate-y-1/2 w-6 h-6 bg-[#eff6ff] rounded-full shadow-inner"></div>

                        <div class="flex justify-between items-start border-b-2 border-dashed border-slate-200 pb-5 relative">
                            <div>
                                <p class="text-[10px] uppercase font-bold tracking-widest text-indigo-500 mb-1">Eventama</p>
                                <div class="font-black text-2xl text-slate-800">VIP ACCESS</div>
                            </div>
                            <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center border border-slate-100">
                                <i class="fas fa-qrcode text-xl text-slate-400"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-2.5 z-10">
                            <div class="h-2.5 bg-slate-100 rounded-full w-full"></div>
                            <div class="h-2.5 bg-slate-100 rounded-full w-3/4"></div>
                        </div>
                        
                        <div class="flex justify-between items-end pt-3 z-10">
                            <div class="flex -space-x-3">
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-indigo-100 to-indigo-200 z-30 flex items-center justify-center text-xs font-bold text-indigo-600">A</div>
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-blue-100 to-blue-200 z-20 flex items-center justify-center text-xs font-bold text-blue-600">B</div>
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-cyan-100 to-cyan-200 z-10 flex items-center justify-center text-xs font-bold text-cyan-600">+</div>
                            </div>
                            <div class="text-[10px] font-black text-white bg-slate-800 px-3 py-1.5 rounded-lg shadow-sm">ADMIT ONE</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<style>
    @keyframes float-ticket {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }
    .animate-float-ticket {
        animation: float-ticket 4s ease-in-out infinite;
    }
    /* When hovered, we pause/reset the float so the internal hover rotation takes full control smoothly */
    .group:hover.animate-float-ticket {
        animation-play-state: paused;
    }
</style>
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