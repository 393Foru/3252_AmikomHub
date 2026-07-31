@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] sm:text-xs uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
            <i class="fas fa-info-circle"></i> Tentang Kami
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
            Mengenal Lebih Dekat <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Eventama</span>
        </h1>
        <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto">
            Platform event terpercaya yang menghubungkan mahasiswa Amikom dengan berbagai kegiatan inspiratif.
        </p>
    </div>

    <!-- Main Content -->
    <div class="glass p-8 md:p-10 rounded-[2rem] shadow-xl border border-slate-200/60 mb-12 relative overflow-hidden text-center md:text-left">
        <!-- Decoration -->
        <div class="absolute -top-16 -right-16 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-cyan-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        
        <div class="relative z-10 space-y-8">
            <div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4 flex items-center justify-center md:justify-start gap-2">
                    <i class="fas fa-bullseye text-blue-500"></i> Visi Kami
                </h3>
                <p class="text-slate-600 leading-relaxed text-left">
                    Menjadi platform event nomor satu di lingkungan kampus yang memudahkan setiap mahasiswa dalam menemukan, mendaftar, dan mengelola partisipasi mereka dalam berbagai kegiatan akademik maupun non-akademik.
                </p>
            </div>
            
            <div class="h-px bg-slate-200 w-full"></div>

            <div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4 flex items-center justify-center md:justify-start gap-2">
                    <i class="fas fa-rocket text-cyan-500"></i> Misi Kami
                </h3>
                <ul class="text-slate-600 leading-relaxed space-y-3 list-disc pl-5 text-left">
                    <li>Menyediakan informasi event yang akurat, lengkap, dan up-to-date.</li>
                    <li>Memberikan pengalaman transaksi tiket yang aman, mudah, dan transparan melalui integrasi dengan Midtrans.</li>
                    <li>Membangun ekosistem kolaboratif bersama berbagai instansi dan komunitas kampus.</li>
                    <li>Mendorong partisipasi aktif mahasiswa dalam berbagai kegiatan yang menunjang soft skill dan hard skill.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Core Values -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 text-center hover:-translate-y-1 transition-transform duration-300">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h4 class="text-lg font-bold text-slate-800 mb-2">Aman Terpercaya</h4>
            <p class="text-sm text-slate-500">Transaksi dijamin aman dengan dukungan sistem pembayaran resmi dan terverifikasi.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 text-center hover:-translate-y-1 transition-transform duration-300">
            <div class="w-14 h-14 bg-cyan-100 text-cyan-600 rounded-xl flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                <i class="fas fa-bolt"></i>
            </div>
            <h4 class="text-lg font-bold text-slate-800 mb-2">Cepat & Mudah</h4>
            <p class="text-sm text-slate-500">Proses pemesanan tiket yang ringkas, tanpa ribet, langsung dari genggaman Anda.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 text-center hover:-translate-y-1 transition-transform duration-300">
            <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                <i class="fas fa-users"></i>
            </div>
            <h4 class="text-lg font-bold text-slate-800 mb-2">Kolaboratif</h4>
            <p class="text-sm text-slate-500">Kami bekerja sama dengan berbagai penyelenggara untuk menyajikan event terbaik.</p>
        </div>
    </div>
</div>
@endsection
