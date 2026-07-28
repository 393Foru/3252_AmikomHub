<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Temukan Event Seru!</title>
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
                        AE
                    </div>
                    <span class="font-extrabold text-xl md:text-2xl tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-violet-800 to-fuchsia-700">
                        AmikomEventHub
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


    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 py-12 md:py-16 mt-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-12 lg:gap-16 mb-12 md:mb-16">
                
                <!-- Brand Section -->
                <div class="md:col-span-12 lg:col-span-5 space-y-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 inline-block">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-600/30">
                            AE
                        </div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">Amikom<span class="text-indigo-400">EventHub</span></span>
                    </a>
                    <p class="leading-relaxed text-slate-400 text-sm md:text-base md:max-w-md">
                        Platform reservasi tiket event online terbaik untuk mahasiswa dan penyelenggara profesional. Temukan pengalaman seru dan tingkatkan keahlianmu di kampus.
                    </p>
                    <div class="flex items-center gap-4 pt-2">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center hover:bg-indigo-600 hover:border-indigo-600 hover:text-white transition-all duration-300 group">
                            <i class="fab fa-instagram text-slate-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center hover:bg-indigo-600 hover:border-indigo-600 hover:text-white transition-all duration-300 group">
                            <i class="fab fa-twitter text-slate-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center hover:bg-indigo-600 hover:border-indigo-600 hover:text-white transition-all duration-300 group">
                            <i class="fab fa-linkedin-in text-slate-400 group-hover:text-white transition-colors"></i>
                        </a>
                    </div>
                </div>

                <!-- Links Section -->
                <div class="md:col-span-5 lg:col-span-3">
                    <h4 class="text-white font-bold text-lg mb-6">Menu Cepat</h4>
                    <ul class="space-y-4 text-sm md:text-base text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition-colors duration-200 flex items-center gap-2">Beranda</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-indigo-400 transition-colors duration-200 flex items-center gap-2">Jelajah Event</a></li>
                        <li><a href="{{ route('how-to-order') }}" class="hover:text-indigo-400 transition-colors duration-200 flex items-center gap-2">Panduan Pemesanan</a></li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="md:col-span-7 lg:col-span-4">
                    <h4 class="text-white font-bold text-lg mb-6">Hubungi Kami</h4>
                    <ul class="space-y-5 text-sm md:text-base text-slate-400">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center shrink-0 text-indigo-400">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="flex flex-col pt-1">
                                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Email Dukungan</span>
                                <a href="mailto:rahmat.ramadhan.0712@students.amikom.ac.id" class="hover:text-indigo-400 transition-colors text-slate-300 break-words">
                                    rahmat.ramadhan.0712@students.amikom.ac.id
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center shrink-0 text-indigo-400">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="flex flex-col pt-1">
                                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Layanan Telepon</span>
                                <a href="tel:+62882003859191" class="hover:text-indigo-400 transition-colors text-slate-300">
                                    +62 88 200 385 9191
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright Bar -->
            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500 text-center">
                <p>&copy; {{ date('Y') }} Rahmat Ramadhan (24.12.3252). Hak cipta dilindungi.</p>
                <p class="flex items-center justify-center gap-2">
                    Dibuat dengan <i class="fas fa-heart text-rose-500"></i> di Yogyakarta
                </p>
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