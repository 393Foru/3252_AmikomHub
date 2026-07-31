@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 pt-6 pb-2">
    <x-breadcrumb :items="[
        ['label' => 'Perlindungan Data']
    ]" />
</div>
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] sm:text-xs uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
            <i class="fas fa-user-shield"></i> Privasi & Keamanan
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
            Perlindungan Data <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Eventama</span>
        </h1>
        <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto">
            Komitmen kami dalam menjaga kerahasiaan dan keamanan data pribadi setiap pengguna platform Eventama.
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
                    <i class="fas fa-database text-blue-500"></i> Pengumpulan Data
                </h3>
                <p class="text-slate-600 leading-relaxed mb-3 text-left">
                    Eventama mengumpulkan informasi pribadi yang Anda berikan secara sukarela saat mendaftar, membeli tiket, atau menggunakan layanan kami. Data tersebut meliputi:
                </p>
                <ul class="text-slate-600 leading-relaxed space-y-2 list-disc pl-5 text-left">
                    <li>Nama lengkap, alamat email, dan nomor telepon.</li>
                    <li>Informasi akademik seperti NIM (Nomor Induk Mahasiswa) dan program studi (khusus mahasiswa Amikom).</li>
                    <li>Informasi transaksi saat melakukan pembelian tiket.</li>
                </ul>
            </div>
            
            <div class="h-px bg-slate-200 w-full"></div>

            <div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4 flex items-center justify-center md:justify-start gap-2">
                    <i class="fas fa-lock text-cyan-500"></i> Keamanan & Penggunaan Data
                </h3>
                <p class="text-slate-600 leading-relaxed mb-3 text-left">
                    Data yang kami kumpulkan digunakan secara eksklusif untuk keperluan operasional dan peningkatan layanan, antara lain:
                </p>
                <ul class="text-slate-600 leading-relaxed space-y-2 list-disc pl-5 text-left">
                    <li>Memproses pendaftaran akun dan transaksi tiket event.</li>
                    <li>Mengirimkan informasi, e-ticket, dan pembaruan terkait event yang didaftarkan.</li>
                    <li>Meningkatkan pengalaman pengguna di dalam platform kami.</li>
                </ul>
                <p class="text-slate-600 leading-relaxed mt-4 text-left">
                    Kami tidak akan pernah menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali diwajibkan oleh hukum yang berlaku atau untuk keperluan pemrosesan pembayaran melalui mitra resmi kami.
                </p>
            </div>

            <div class="h-px bg-slate-200 w-full"></div>

            <div>
                <h3 class="text-2xl font-bold text-slate-800 mb-4 flex items-center justify-center md:justify-start gap-2">
                    <i class="fas fa-cookie-bite text-indigo-500"></i> Kebijakan Cookies
                </h3>
                <p class="text-slate-600 leading-relaxed text-left">
                    Platform kami mungkin menggunakan cookies untuk mengingat preferensi Anda dan mengoptimalkan pengalaman browsing Anda. Anda dapat mengatur browser Anda untuk menolak cookies, namun beberapa fitur dari Eventama mungkin tidak berfungsi dengan maksimal.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Contact Privacy -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 hover:-translate-y-1 transition-transform duration-300">
            <h4 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                <i class="fas fa-question-circle text-blue-500"></i> Punya Pertanyaan?
            </h4>
            <p class="text-sm text-slate-500 mb-4">Jika Anda memiliki pertanyaan seputar kebijakan privasi dan perlindungan data ini, silakan hubungi tim kami.</p>
            <a href="mailto:privacy@amikomevent.id" class="text-blue-600 font-semibold hover:text-blue-700 text-sm">privacy@amikomevent.id &rarr;</a>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 border border-slate-100 hover:-translate-y-1 transition-transform duration-300">
            <h4 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                <i class="fas fa-file-contract text-cyan-500"></i> Syarat & Ketentuan
            </h4>
            <p class="text-sm text-slate-500 mb-4">Pelajari lebih lanjut tentang syarat dan ketentuan penggunaan layanan platform Eventama.</p>
            <a href="{{ route('terms-conditions') }}" class="text-cyan-600 font-semibold hover:text-cyan-700 text-sm">Baca S&K &rarr;</a>
        </div>
    </div>
</div>
@endsection
