<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventama - Temukan Event Seru!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-violet-50/50 antialiased text-zinc-800 selection:bg-violet-200 selection:text-violet-900">

    <!-- Navigation -->
    <div class="sticky top-6 z-50 mx-4 sm:mx-6 lg:mx-auto max-w-5xl transition-all duration-500">
        <nav class="bg-white/70 backdrop-blur-2xl border border-zinc-200/50 shadow-xl shadow-zinc-200/40 rounded-full px-2 py-2 flex justify-between items-center transition-all duration-300">
            
            <div class="flex-shrink-0 flex items-center pl-4 sm:pl-5 hover:scale-105 transition-transform duration-300">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="text-xs w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold">
                        EvT
                    </div>
                    <span class="font-extrabold text-xl md:text-2xl tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-violet-800 to-fuchsia-700">
                        Eventama
                    </span>
                </a>
            </div>

            <div class="flex items-center gap-3 pr-1">
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center bg-zinc-100/50 p-1 rounded-full border border-zinc-200/50">
                    <a href="{{ route('home') }}" 
                    class="px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('home') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-zinc-200/50' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100' }}">
                        Beranda
                    </a>
                    <a href="{{ route('events.index') }}" 
                    class="px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('events.index') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-zinc-200/50' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100' }}">
                        Event
                    </a>
                </div>

                <div class="hidden md:block w-[1.5px] h-6 bg-zinc-200 rounded-full mx-1"></div>

                <!-- Desktop Auth Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    @auth
                        <span class="text-sm font-bold text-zinc-700 mr-2">
                            Halo, {{ Auth::user()->name }} 👋
                        </span>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                            @csrf
                            <button type="submit" 
                                class="px-5 py-2.5 text-sm font-semibold text-rose-600 hover:bg-rose-50 rounded-full transition-colors">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2.5 text-sm font-semibold text-zinc-600 hover:text-indigo-600 hover:bg-zinc-100 rounded-full transition-all duration-300">
                            Masuk
                        </a>
                        
                        <a href="{{ route('register') }}" 
                           class="px-6 py-2.5 text-sm font-bold bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-full shadow-lg shadow-indigo-200/50 hover:shadow-indigo-300/50 hover:scale-105 transition-all duration-300">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center pr-2">
                    <button id="mobile-menu-btn" class="text-zinc-600 hover:text-indigo-600 focus:outline-none p-2 rounded-full hover:bg-zinc-100 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden mt-3 bg-white/95 backdrop-blur-xl border border-zinc-200/50 rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 opacity-0 transform -translate-y-4">
            <div class="px-4 py-4 space-y-2 flex flex-col">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-600' : 'text-zinc-600 hover:bg-zinc-50' }}">Beranda</a>
                <a href="{{ route('events.index') }}" class="block px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('events.index') ? 'bg-indigo-50 text-indigo-600' : 'text-zinc-600 hover:bg-zinc-50' }}">Event</a>
                
                <hr class="border-zinc-200/60 my-2">
                
                @auth
                    <div class="px-4 py-2">
                        <span class="block text-sm font-bold text-zinc-700">Halo, {{ Auth::user()->name }} 👋</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="block w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-base font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-zinc-600 hover:bg-zinc-50 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 text-center mt-2 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-xl text-base font-bold shadow-md hover:shadow-lg transition">Daftar</a>
                @endauth
            </div>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 min-h-[70vh]">
        @yield('content')
    </main>


    <footer class="bg-slate-900 border-t border-slate-800 text-slate-400 py-12 mt-16 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
                <!-- Brand & Contact -->
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center font-black text-white text-xs">
                            EvT
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">Event<span class="text-indigo-400">ama</span></span>
                    </a>
                    
                    <div class="space-y-5">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-comment-dots text-indigo-400 text-lg mt-0.5 w-5 text-center"></i>
                            <div>
                                <p class="font-bold text-white text-sm">Halo Amikom</p>
                                <p class="text-xs text-slate-500">Chat with us</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-envelope text-indigo-400 text-lg mt-0.5 w-5 text-center"></i>
                            <div>
                                <p class="font-bold text-white text-sm">Email</p>
                                <a href="mailto:rahmat.ramadhan.0712@students.amikom.ac.id" class="text-xs text-slate-400 hover:text-indigo-400 break-words transition">
                                    cs@amikomevent.id
                                </a>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-headset text-indigo-400 text-lg mt-0.5 w-5 text-center"></i>
                            <div>
                                <p class="font-bold text-white text-sm">Call Center</p>
                                <p class="text-xs text-slate-500">Indonesia only<br>+62 88 200 385 9191</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perusahaan -->
                <div>
                    <h4 class="font-bold text-white text-base mb-6">Perusahaan</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="#" class="hover:text-indigo-400 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Berita Kampus</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Karir</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Program Kemitraan</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Perlindungan Data</a></li>
                    </ul>
                </div>

                <!-- Kategori / Produk -->
                <div>
                    <h4 class="font-bold text-white text-base mb-6">Kategori Event</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="#" class="hover:text-indigo-400 transition">Seminar IT</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Workshop</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Lomba & Kompetisi</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Job Fair</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Pameran Karya</a></li>
                    </ul>
                </div>

                <!-- Dukungan -->
                <div>
                    <h4 class="font-bold text-white text-base mb-6">Dukungan</h4>
                    <ul class="space-y-4 text-slate-400">
                        <li><a href="#" class="hover:text-indigo-400 transition">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Daftarkan Event Anda</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Panduan Pemesanan</a></li>
                    </ul>
                </div>

                <!-- App -->
                <div>
                    <h4 class="font-bold text-white text-base mb-6">Lebih Mudah di Aplikasi</h4>
                    <div class="space-y-3">
                        <a href="#" class="inline-flex w-36 bg-slate-800 border border-slate-700 text-white rounded-lg px-3 py-1.5 items-center gap-2 hover:bg-slate-700 transition">
                            <i class="fab fa-apple text-2xl"></i>
                            <div class="text-left">
                                <p class="text-[9px] leading-none text-slate-400">Download on the</p>
                                <p class="text-[13px] font-bold leading-tight">App Store</p>
                            </div>
                        </a>
                        <a href="#" class="inline-flex w-36 bg-slate-800 border border-slate-700 text-white rounded-lg px-3 py-1.5 items-center gap-2 hover:bg-slate-700 transition">
                            <i class="fab fa-google-play text-xl"></i>
                            <div class="text-left">
                                <p class="text-[9px] leading-none text-slate-400">GET IT ON</p>
                                <p class="text-[13px] font-bold leading-tight">Google Play</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-dashed border-slate-700 py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Partner -->
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Partner Kampus</h4>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-university text-3xl text-indigo-400"></i>
                        <div class="leading-tight">
                            <div class="text-sm font-bold text-slate-200">Universitas Amikom</div>
                            <p class="text-[11px] text-slate-400">Yogyakarta, Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- Keamanan -->
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Transaksi Aman</h4>
                    <div class="flex gap-4 text-3xl text-slate-500">
                        <i class="fab fa-cc-visa hover:text-white transition cursor-pointer"></i>
                        <i class="fab fa-cc-mastercard hover:text-white transition cursor-pointer"></i>
                        <i class="fab fa-cc-paypal hover:text-white transition cursor-pointer"></i>
                    </div>
                </div>

                <!-- Penghargaan -->
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Penghargaan</h4>
                    <div class="flex gap-4 text-slate-500 text-3xl">
                        <i class="fas fa-award hover:text-white transition cursor-pointer"></i>
                        <i class="fas fa-medal hover:text-white transition cursor-pointer"></i>
                        <i class="fas fa-trophy hover:text-white transition cursor-pointer"></i>
                    </div>
                </div>

                <!-- Follow us -->
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Ikuti Kami</h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 hover:border-indigo-600 transition"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 hover:border-indigo-600 transition"><i class="fab fa-twitter text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 hover:border-indigo-600 transition"><i class="fab fa-linkedin-in text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 hover:border-indigo-600 transition"><i class="fab fa-youtube text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 hover:border-indigo-600 transition"><i class="fab fa-instagram text-sm"></i></a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800 text-[13px] text-slate-500 flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; {{ date('Y') }} Rahmat Ramadhan (24.12.3252). Hak cipta dilindungi.</p>
                <p>Dibuat dengan <i class="fas fa-heart text-rose-500 mx-1"></i> di Yogyakarta.</p>
            </div>
        </div>
    </footer>

<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('opacity-100', 'translate-y-0');
                menu.classList.add('opacity-0', '-translate-y-4');
            } else {
                menu.classList.remove('opacity-0', '-translate-y-4');
                menu.classList.add('opacity-100', 'translate-y-0');
            }
        });
    }
</script>
</body>

</html>