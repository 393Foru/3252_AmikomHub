@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6 pb-2">
    <x-breadcrumb :items="[
        ['label' => 'Program Kemitraan']
    ]" />
</div>
<!-- Hero Section -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-900 via-blue-800 to-cyan-700 p-8 sm:p-12 mb-12 shadow-2xl">
    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-40 h-40 bg-cyan-400 opacity-20 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/20 text-blue-100 text-sm font-semibold mb-6 border border-white/30 backdrop-blur-md">
            <i class="fas fa-handshake"></i> Program Kemitraan
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            Kolaborasi Tanpa Batas <br class="hidden sm:block"> Bersama <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-200">Eventama</span>
        </h1>
        <p class="text-blue-100 text-sm sm:text-lg mb-8 leading-relaxed">
            Jangkau lebih banyak audiens dan dukung kegiatan mahasiswa dengan menjadi bagian dari ekosistem event terbesar di kampus. Mari ciptakan kesuksesan bersama.
        </p>
        <a href="#schemes" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-blue-900 bg-white rounded-full hover:bg-blue-50 transition-all duration-300 shadow-xl hover:shadow-cyan-500/30 hover:-translate-y-1">
            Lihat Skema Kemitraan <i class="fas fa-arrow-down ml-2"></i>
        </a>
    </div>
</div>

<!-- Mengapa Menjadi Partner Section -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-800 mb-3">Keuntungan Kemitraan</h2>
        <p class="text-zinc-500 max-w-2xl mx-auto">Kami menyediakan berbagai keuntungan eksklusif bagi partner untuk meningkatkan brand awareness dan engagement.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Benefit 1 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-lg shadow-zinc-200/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center group">
            <div class="w-16 h-16 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-bullseye"></i>
            </div>
            <h3 class="text-lg font-bold text-zinc-800 mb-2">Target Market Spesifik</h3>
            <p class="text-zinc-500 text-sm leading-relaxed">Jangkau langsung ribuan mahasiswa dan profesional muda yang aktif dan antusias mengikuti berbagai event kampus.</p>
        </div>

        <!-- Benefit 2 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-lg shadow-zinc-200/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center group">
            <div class="w-16 h-16 mx-auto bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-ad"></i>
            </div>
            <h3 class="text-lg font-bold text-zinc-800 mb-2">Promosi Eksklusif</h3>
            <p class="text-zinc-500 text-sm leading-relaxed">Penempatan logo dan materi promosi di berbagai channel kami, termasuk website, media sosial, dan materi cetak event.</p>
        </div>

        <!-- Benefit 3 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-lg shadow-zinc-200/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center group">
            <div class="w-16 h-16 mx-auto bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-chart-bar"></i>
            </div>
            <h3 class="text-lg font-bold text-zinc-800 mb-2">Laporan & Analitik</h3>
            <p class="text-zinc-500 text-sm leading-relaxed">Dapatkan laporan komprehensif mengenai engagement, jumlah peserta, dan efektivitas campaign sponsorhip Anda.</p>
        </div>
    </div>
</div>

<!-- Skema Kemitraan Section -->
<div id="schemes" class="mb-16">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-zinc-800 mb-2">Pilih Skema Kemitraan</h2>
            <p class="text-zinc-500">Berbagai opsi kolaborasi yang bisa disesuaikan dengan kebutuhan Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Scheme 1 -->
        <div class="bg-white rounded-2xl p-8 border border-zinc-200 hover:border-blue-400 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fas fa-bullhorn text-6xl text-blue-600"></i>
            </div>
            <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-6">
                <i class="fas fa-bullhorn"></i>
            </div>
            <h3 class="text-xl font-bold text-zinc-800 mb-2">Media Partner</h3>
            <p class="text-zinc-500 text-sm mb-6 flex-grow">Kerja sama saling menguntungkan dalam hal publikasi event. Tukar menukar exposure di platform masing-masing.</p>
            <ul class="space-y-3 mb-8 text-sm text-zinc-600">
                <li class="flex items-center gap-2"><i class="fas fa-check text-green-500"></i> Logo placement di website</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-green-500"></i> Cross-posting media sosial</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-green-500"></i> Promosi email newsletter</li>
            </ul>
            <a href="mailto:partnership@amikomevent.id?subject=Pengajuan Media Partner" class="w-full block text-center px-6 py-3 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">Ajukan Proposal</a>
        </div>

        <!-- Scheme 2 -->
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 rounded-2xl p-8 border border-blue-700 shadow-xl shadow-blue-900/20 hover:-translate-y-2 transition-all duration-300 flex flex-col relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <i class="fas fa-star text-6xl text-white"></i>
            </div>
            <div class="absolute top-0 right-0 bg-gradient-to-r from-amber-400 to-amber-500 text-xs font-bold text-white py-1 px-3 rounded-bl-lg">
                POPULER
            </div>
            <div class="w-14 h-14 rounded-xl bg-white/10 text-white flex items-center justify-center text-2xl mb-6 backdrop-blur-sm border border-white/20">
                <i class="fas fa-star text-amber-400"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Event Sponsor</h3>
            <p class="text-blue-200 text-sm mb-6 flex-grow">Dukung event-event spesifik kami secara finansial atau in-kind dengan benefit exposure maksimal.</p>
            <ul class="space-y-3 mb-8 text-sm text-blue-100">
                <li class="flex items-center gap-2"><i class="fas fa-check text-amber-400"></i> Booth di lokasi event</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-amber-400"></i> Sesi presentasi khusus (S&K)</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-amber-400"></i> Logo utama di banner & backdrop</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-amber-400"></i> Data analitik peserta event</li>
            </ul>
            <a href="mailto:partnership@amikomevent.id?subject=Pengajuan Event Sponsor" class="w-full block text-center px-6 py-3 bg-white text-blue-900 font-bold rounded-xl hover:bg-blue-50 transition-all shadow-lg">Hubungi Tim</a>
        </div>

        <!-- Scheme 3 -->
        <div class="bg-white rounded-2xl p-8 border border-zinc-200 hover:border-cyan-400 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fas fa-building text-6xl text-cyan-600"></i>
            </div>
            <div class="w-14 h-14 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-6">
                <i class="fas fa-building"></i>
            </div>
            <h3 class="text-xl font-bold text-zinc-800 mb-2">Corporate Partner</h3>
            <p class="text-zinc-500 text-sm mb-6 flex-grow">Kemitraan jangka panjang untuk program-program strategis seperti kampus merdeka, magang, dan rekrutmen.</p>
            <ul class="space-y-3 mb-8 text-sm text-zinc-600">
                <li class="flex items-center gap-2"><i class="fas fa-check text-cyan-500"></i> Akses prioritas rekrutmen talenta</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-cyan-500"></i> Program magang eksklusif</li>
                <li class="flex items-center gap-2"><i class="fas fa-check text-cyan-500"></i> Penyelenggaraan event in-house</li>
            </ul>
            <a href="mailto:partnership@amikomevent.id?subject=Pengajuan Corporate Partner" class="w-full block text-center px-6 py-3 bg-cyan-50 text-cyan-700 font-bold rounded-xl hover:bg-cyan-600 hover:text-white transition-all">Jadwalkan Meeting</a>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-white border border-blue-100 rounded-3xl p-8 sm:p-10 text-center shadow-xl shadow-blue-900/5 relative overflow-hidden">
    <!-- Dekorasi Background -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60 -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-40 h-40 bg-cyan-50 rounded-full blur-3xl opacity-60 -ml-10 -mb-10"></div>
    
    <div class="relative z-10 max-w-2xl mx-auto">
        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
            <i class="fas fa-handshake-angle"></i>
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-800 mb-4">Mari Bangun Ekosistem Bersama</h2>
        <p class="text-zinc-500 mb-8 leading-relaxed">
            Punya ide kolaborasi lain yang tidak tercantum di atas? Tim Partnership kami siap berdiskusi untuk menciptakan program kustom yang paling sesuai dengan target Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="mailto:partnership@amikomevent.id" class="px-8 py-3.5 bg-blue-600 text-white font-bold rounded-full shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-envelope mr-2"></i> partnership@amikomevent.id
            </a>
            <a href="https://wa.me/62882003859191" target="_blank" class="px-8 py-3.5 bg-white text-zinc-700 border border-zinc-200 font-bold rounded-full shadow-sm hover:bg-zinc-50 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                <i class="fab fa-whatsapp text-green-500 mr-2 text-lg"></i> Hubungi WhatsApp
            </a>
        </div>
    </div>
</div>

@endsection
