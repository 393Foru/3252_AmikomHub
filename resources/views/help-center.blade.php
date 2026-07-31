@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-6 pb-2">
    <x-breadcrumb :items="[
        ['label' => 'Pusat Bantuan']
    ]" />
</div>
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] sm:text-xs uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
            <i class="fas fa-headset"></i> Dukungan Pelanggan
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
            Pusat Bantuan <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Eventama</span>
        </h1>
        <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto">
            Temukan jawaban untuk pertanyaan Anda, panduan penggunaan platform, dan hubungi tim support kami jika membutuhkan bantuan lebih lanjut.
        </p>
    </div>

    <!-- Search/Filter Bar (Visual Only) -->
    <div class="max-w-2xl mx-auto mb-12">
        <div class="relative flex items-center w-full h-14 rounded-full focus-within:shadow-lg bg-white overflow-hidden border border-slate-200">
            <div class="grid place-items-center h-full w-12 text-slate-300">
                <i class="fas fa-search text-xl text-blue-500"></i>
            </div>
            <input class="peer h-full w-full outline-none text-sm text-slate-700 pr-2 bg-transparent" type="text" id="search" placeholder="Cari topik bantuan (misal: cara beli tiket, refund, akun)..." /> 
        </div>
    </div>

    <!-- Main Content: FAQ Accordions or Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Category Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 hover:-translate-y-1 transition-transform duration-300 group">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-xl mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Tiket & Pembayaran</h3>
            <p class="text-slate-600 mb-4 text-sm leading-relaxed">Informasi mengenai cara membeli tiket, metode pembayaran yang didukung, dan masalah transaksi.</p>
            <ul class="text-sm text-blue-600 font-medium space-y-2">
                <li><a href="#" class="hover:underline">Cara membeli tiket?</a></li>
                <li><a href="#" class="hover:underline">Status pembayaran pending?</a></li>
                <li><a href="#" class="hover:underline">Panduan penggunaan e-wallet.</a></li>
            </ul>
        </div>
        
        <!-- Category Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 hover:-translate-y-1 transition-transform duration-300 group">
            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center text-cyan-600 text-xl mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-user-circle"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Akun & Profil</h3>
            <p class="text-slate-600 mb-4 text-sm leading-relaxed">Bantuan mengenai pengaturan akun, lupa kata sandi, dan pengelolaan profil pengguna.</p>
            <ul class="text-sm text-cyan-600 font-medium space-y-2">
                <li><a href="#" class="hover:underline">Cara reset kata sandi?</a></li>
                <li><a href="#" class="hover:underline">Ubah alamat email akun.</a></li>
                <li><a href="#" class="hover:underline">Masalah saat login?</a></li>
            </ul>
        </div>

        <!-- Category Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 hover:-translate-y-1 transition-transform duration-300 group">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 text-xl mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Manajemen Event</h3>
            <p class="text-slate-600 mb-4 text-sm leading-relaxed">Panduan untuk mitra dan panitia event dalam membuat, mengelola, dan memantau acara.</p>
            <ul class="text-sm text-indigo-600 font-medium space-y-2">
                <li><a href="#" class="hover:underline">Cara publikasi event baru?</a></li>
                <li><a href="#" class="hover:underline">Cek laporan penjualan tiket.</a></li>
                <li><a href="#" class="hover:underline">Validasi e-ticket di lokasi.</a></li>
            </ul>
        </div>
    </div>

    <!-- Contact Support Section -->
    <div class="glass p-8 md:p-10 rounded-[2rem] shadow-xl border border-slate-200/60 relative overflow-hidden text-center">
        <!-- Decoration -->
        <div class="absolute -top-16 -right-16 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-cyan-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        
        <div class="relative z-10">
            <h3 class="text-2xl font-bold text-slate-800 mb-4">Masih Butuh Bantuan?</h3>
            <p class="text-slate-600 leading-relaxed mb-6 max-w-xl mx-auto">
                Jika Anda tidak menemukan jawaban dari pertanyaan Anda di Pusat Bantuan, tim Customer Support kami siap membantu Anda kapan saja.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#25D366] text-white rounded-full font-bold shadow-lg shadow-green-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                    <i class="fab fa-whatsapp text-lg"></i> Hubungi WhatsApp
                </a>
                <a href="mailto:support@amikomevent.id" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-slate-700 border border-slate-200 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all duration-300">
                    <i class="fas fa-envelope text-blue-500"></i> Email Kami
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
