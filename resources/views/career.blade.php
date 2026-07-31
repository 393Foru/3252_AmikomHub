@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6 pb-2">
    <x-breadcrumb :items="[
        ['label' => 'Karir']
    ]" />
</div>
<!-- Hero Section -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-700 p-8 sm:p-12 mb-12 shadow-2xl">
    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-40 h-40 bg-cyan-400 opacity-20 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/20 text-blue-100 text-sm font-semibold mb-6 border border-white/30 backdrop-blur-md">
            <i class="fas fa-rocket"></i> We Are Hiring
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            Bangun Masa Depanmu <br class="hidden sm:block"> Bersama <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-200">Eventama</span>
        </h1>
        <p class="text-blue-100 text-sm sm:text-lg mb-8 leading-relaxed">
            Jadilah bagian dari tim inovatif yang merevolusi industri event di Indonesia. Kami mencari talenta-talenta luar biasa untuk tumbuh bersama kami.
        </p>
        <a href="#open-positions" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-blue-900 bg-white rounded-full hover:bg-blue-50 transition-all duration-300 shadow-xl hover:shadow-cyan-500/30 hover:-translate-y-1">
            Lihat Posisi Terbuka <i class="fas fa-arrow-down ml-2"></i>
        </a>
    </div>
</div>

<!-- Budaya Kerja Section -->
<div class="mb-16">
    <div class="text-center mb-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-800 mb-3">Mengapa Eventama?</h2>
        <p class="text-zinc-500 max-w-2xl mx-auto">Kami tidak hanya menawarkan pekerjaan, tapi juga lingkungan yang mendukung pertumbuhan dan kreativitasmu.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Budaya 1 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-lg shadow-zinc-200/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center group">
            <div class="w-16 h-16 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-lightbulb"></i>
            </div>
            <h3 class="text-lg font-bold text-zinc-800 mb-2">Inovasi Tanpa Batas</h3>
            <p class="text-zinc-500 text-sm leading-relaxed">Kami selalu mendorong ide-ide baru dan berani mencoba teknologi terkini untuk memberikan pengalaman terbaik.</p>
        </div>

        <!-- Budaya 2 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-lg shadow-zinc-200/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center group">
            <div class="w-16 h-16 mx-auto bg-cyan-50 text-cyan-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="text-lg font-bold text-zinc-800 mb-2">Kolaborasi Tim</h3>
            <p class="text-zinc-500 text-sm leading-relaxed">Bekerja bersama individu-individu berbakat dalam lingkungan yang inklusif, suportif, dan kekeluargaan.</p>
        </div>

        <!-- Budaya 3 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-100 shadow-lg shadow-zinc-200/40 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center group">
            <div class="w-16 h-16 mx-auto bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="text-lg font-bold text-zinc-800 mb-2">Perkembangan Karir</h3>
            <p class="text-zinc-500 text-sm leading-relaxed">Dukungan penuh untuk pengembangan skill, mentoring, dan jenjang karir yang jelas bagi setiap karyawan.</p>
        </div>
    </div>
</div>

<!-- Open Positions Section -->
<div id="open-positions" class="mb-16">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-zinc-800 mb-2">Posisi Terbuka</h2>
            <p class="text-zinc-500">Temukan peran yang sesuai dengan passion dan keahlianmu.</p>
        </div>
        
        <!-- Filter Tabs (Visual Only for now) -->
        <div class="flex bg-zinc-100 rounded-lg p-1">
            <button class="px-4 py-2 text-sm font-bold bg-white text-blue-600 rounded shadow-sm">Semua</button>
            <button class="px-4 py-2 text-sm font-bold text-zinc-500 hover:text-zinc-800">Teknologi</button>
            <button class="px-4 py-2 text-sm font-bold text-zinc-500 hover:text-zinc-800">Marketing</button>
        </div>
    </div>

    <div class="space-y-4">
        <!-- Job Card 1 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-200 hover:border-blue-300 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group">
            <div class="flex gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fas fa-code"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-zinc-800 group-hover:text-blue-600 transition-colors">Frontend Developer</h3>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 mt-1">
                        <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-zinc-400"></i> Yogyakarta</span>
                        <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                        <span class="flex items-center gap-1"><i class="fas fa-briefcase text-zinc-400"></i> Full-time</span>
                    </div>
                </div>
            </div>
            <button class="w-full sm:w-auto px-6 py-2.5 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">Lamar Sekarang</button>
        </div>

        <!-- Job Card 2 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-200 hover:border-blue-300 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group">
            <div class="flex gap-4">
                <div class="w-12 h-12 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-zinc-800 group-hover:text-blue-600 transition-colors">UI/UX Designer</h3>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 mt-1">
                        <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-zinc-400"></i> Yogyakarta</span>
                        <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                        <span class="flex items-center gap-1"><i class="fas fa-briefcase text-zinc-400"></i> Full-time</span>
                    </div>
                </div>
            </div>
            <button class="w-full sm:w-auto px-6 py-2.5 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">Lamar Sekarang</button>
        </div>

        <!-- Job Card 3 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-200 hover:border-blue-300 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group">
            <div class="flex gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-zinc-800 group-hover:text-blue-600 transition-colors">Event & Marketing Manager</h3>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 mt-1">
                        <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-zinc-400"></i> Remote</span>
                        <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                        <span class="flex items-center gap-1"><i class="fas fa-briefcase text-zinc-400"></i> Full-time</span>
                    </div>
                </div>
            </div>
            <button class="w-full sm:w-auto px-6 py-2.5 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">Lamar Sekarang</button>
        </div>
        
        <!-- Job Card 4 -->
        <div class="bg-white rounded-2xl p-6 border border-zinc-200 hover:border-blue-300 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group">
            <div class="flex gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fas fa-headset"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-zinc-800 group-hover:text-blue-600 transition-colors">Customer Success Specialist</h3>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-zinc-500 mt-1">
                        <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-zinc-400"></i> Yogyakarta</span>
                        <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                        <span class="flex items-center gap-1"><i class="fas fa-briefcase text-zinc-400"></i> Part-time</span>
                    </div>
                </div>
            </div>
            <button class="w-full sm:w-auto px-6 py-2.5 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">Lamar Sekarang</button>
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
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold text-zinc-800 mb-4">Tidak Menemukan Posisi yang Tepat?</h2>
        <p class="text-zinc-500 mb-8 leading-relaxed">
            Kirimkan CV dan portofolio kamu. Kami selalu terbuka untuk talenta-talenta luar biasa meskipun posisinya belum tersedia saat ini.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="mailto:hrd@amikomevent.id" class="px-8 py-3.5 bg-blue-600 text-white font-bold rounded-full shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Spontaneous Application
            </a>
        </div>
    </div>
</div>

@endsection
