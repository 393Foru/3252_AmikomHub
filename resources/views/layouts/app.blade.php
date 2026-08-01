<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventama - Temukan Event Seru!</title>
    
    <!-- PWA Config -->
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/icons/icon-192x192.png') }}">
    
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

<body class="bg-blue-50/50 antialiased text-zinc-800 selection:bg-blue-200 selection:text-blue-900">

    <!-- Navigation -->
    <div class="sticky top-6 z-50 mx-4 sm:mx-6 lg:mx-auto max-w-5xl transition-all duration-500">
        <nav
            class="bg-white/70 backdrop-blur-2xl border border-zinc-200/50 shadow-xl shadow-zinc-200/40 rounded-full px-2 py-2 flex justify-between items-center transition-all duration-300">

            <div class="flex-shrink-0 flex items-center pl-4 sm:pl-5 hover:scale-105 transition-transform duration-300">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div
                        class="text-xs w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold">
                        EvT
                    </div>
                    <span
                        class="font-extrabold text-xl md:text-2xl tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-cyan-700">
                        Eventama
                    </span>
                </a>
            </div>

            <div class="flex items-center gap-3 pr-1">
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center bg-zinc-100/50 p-1 rounded-full border border-zinc-200/50">
                    <a href="{{ route('home') }}"
                        class="px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('home') ? 'bg-white text-blue-600 shadow-sm ring-1 ring-zinc-200/50' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100' }}">
                        Beranda
                    </a>
                    <a href="{{ route('events.index') }}"
                        class="px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('events.index') || request()->routeIs('events.show') ? 'bg-white text-blue-600 shadow-sm ring-1 ring-zinc-200/50' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100' }}">
                        Event
                    </a>
                    <a href="{{ route('partners.index') }}"
                        class="px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('partners.index') ? 'bg-white text-blue-600 shadow-sm ring-1 ring-zinc-200/50' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100' }}">
                        Partner
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
                                class="px-5 py-2.5 text-sm font-semibold text-cyan-600 hover:bg-cyan-50 rounded-full transition-colors">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 py-2.5 text-sm font-semibold text-zinc-600 hover:text-blue-600 hover:bg-zinc-100 rounded-full transition-all duration-300">
                            Masuk
                        </a>

                        <a href="{{ route('register') }}"
                            class="px-6 py-2.5 text-sm font-bold bg-gradient-to-r from-blue-600 to-blue-600 text-white rounded-full shadow-lg shadow-blue-200/50 hover:shadow-blue-300/50 hover:scale-105 transition-all duration-300">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center pr-2">
                    <button id="mobile-menu-btn"
                        class="text-zinc-600 hover:text-blue-600 focus:outline-none p-2 rounded-full hover:bg-zinc-100 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu"
            class="hidden md:hidden mt-3 bg-white/95 backdrop-blur-xl border border-zinc-200/50 rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 opacity-0 transform -translate-y-4">
            <div class="p-3 space-y-1 flex flex-col">
                <a href="{{ route('home') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <i
                        class="fas fa-home w-6 text-center text-lg mr-2 {{ request()->routeIs('home') ? 'text-blue-500' : 'text-zinc-400' }}"></i>
                    Beranda
                </a>
                <a href="{{ route('events.index') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('events.index') || request()->routeIs('events.show') ? 'bg-blue-50 text-blue-600' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <i
                        class="fas fa-calendar-alt w-6 text-center text-lg mr-2 {{ request()->routeIs('events.index') || request()->routeIs('events.show') ? 'text-blue-500' : 'text-zinc-400' }}"></i>
                    Event
                </a>
                <a href="{{ route('partners.index') }}"
                    class="flex items-center px-4 py-3.5 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('partners.index') ? 'bg-blue-50 text-blue-600' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                    <i
                        class="fas fa-handshake w-6 text-center text-lg mr-2 {{ request()->routeIs('partners.index') ? 'text-blue-500' : 'text-zinc-400' }}"></i>
                    Partner
                </a>

                
                <div class="h-px bg-zinc-100 my-2 mx-2"></div>

                @auth
                    <div class="px-4 py-3 flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg border border-blue-200 shrink-0">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <span class="block text-[10px] text-zinc-400 font-bold uppercase tracking-wider">Masuk
                                sebagai</span>
                            <span class="block text-sm font-bold text-zinc-800 truncate">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="block w-full mt-1">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 rounded-xl transition">
                            <i class="fas fa-sign-out-alt w-6 text-center text-lg mr-2 text-red-400"></i> Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="flex items-center px-4 py-3.5 rounded-xl text-sm font-bold text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 transition">
                        <i class="fas fa-sign-in-alt w-6 text-center text-lg mr-2 text-zinc-400"></i> Masuk
                    </a>
                    <div class="pt-2">
                        <a href="{{ route('register') }}"
                            class="flex items-center justify-center px-4 py-3.5 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-md hover:bg-blue-700 hover:shadow-lg transition-all">
                            Daftar Sekarang
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6 min-h-[70vh]">
        @yield('content')
    </main>


    <footer class="bg-slate-900 border-t border-slate-800 text-slate-400 py-10 md:py-12 mt-0 md:mt-8 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-6 gap-y-10 lg:gap-12 mb-12">
                <!-- Brand & Contact -->
                <div class="col-span-2 md:col-span-4 lg:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-black text-white text-xs">
                            EvT
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">Event<span
                                class="text-blue-400">ama</span></span>
                    </a>

                    <div
                        class="flex flex-nowrap lg:flex-col gap-6 lg:gap-5 overflow-x-auto pb-2 lg:pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                        <div class="flex items-start gap-2 sm:gap-3 shrink-0">
                            <i
                                class="fas fa-comment-dots text-blue-400 text-base sm:text-lg mt-0.5 w-4 sm:w-5 text-center shrink-0"></i>
                            <div>
                                <p class="font-bold text-white text-xs sm:text-sm">Halo Amikom</p>
                                <p class="text-[10px] sm:text-xs text-slate-500">Chat with us</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2 sm:gap-3 shrink-0">
                            <i
                                class="fas fa-envelope text-blue-400 text-base sm:text-lg mt-0.5 w-4 sm:w-5 text-center shrink-0"></i>
                            <div>
                                <p class="font-bold text-white text-xs sm:text-sm">Email</p>
                                <a href="mailto:cs@amikomevent.id"
                                    class="text-[10px] sm:text-xs text-slate-400 hover:text-blue-400 transition">
                                    cs@amikomevent.id
                                </a>
                            </div>
                        </div>
                        <div class="flex items-start gap-2 sm:gap-3 shrink-0">
                            <i
                                class="fas fa-headset text-blue-400 text-base sm:text-lg mt-0.5 w-4 sm:w-5 text-center shrink-0"></i>
                            <div>
                                <p class="font-bold text-white text-xs sm:text-sm">Call Center</p>
                                <p class="text-[10px] sm:text-xs text-slate-500">Indonesia only<br>+62 88 200 385 9191
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perusahaan -->
                <div class="col-span-1">
                    <h4 class="font-bold text-white text-sm md:text-base mb-4 md:mb-6">Perusahaan</h4>
                    <ul class="space-y-3 md:space-y-4 text-slate-400 text-xs md:text-sm">
                        <li><a href="{{ route('about-us') }}" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                        <li><a href="{{ route('career') }}" class="hover:text-blue-400 transition">Karir</a></li>
                        <li><a href="{{ route('partnership-program') }}" class="hover:text-blue-400 transition">Program Kemitraan</a></li>
                        <li><a href="{{ route('data-protection') }}" class="hover:text-blue-400 transition">Perlindungan Data</a></li>
                    </ul>
                </div>

                <!-- Kategori / Produk -->
                <div class="col-span-1">
                    <h4 class="font-bold text-white text-sm md:text-base mb-4 md:mb-6">Kategori Event</h4>
                    <ul class="space-y-3 md:space-y-4 text-slate-400 text-xs md:text-sm">
                        <li><a href="{{ route('events.index', ['category' => 'seminar-it']) }}" class="hover:text-blue-400 transition">Seminar IT</a></li>
                        <li><a href="{{ route('events.index', ['category' => 'workshop']) }}" class="hover:text-blue-400 transition">Workshop</a></li>
                        <li><a href="{{ route('events.index', ['category' => 'lomba-it']) }}" class="hover:text-blue-400 transition">Lomba & Kompetisi</a></li>
                        <li><a href="{{ route('events.index', ['category' => 'job-fair']) }}" class="hover:text-blue-400 transition">Job Fair</a></li>
                        <li><a href="{{ route('events.index', ['category' => 'pameran']) }}" class="hover:text-blue-400 transition">Pameran Karya</a></li>
                    </ul>
                </div>

                <!-- Dukungan -->
                <div class="col-span-1">
                    <h4 class="font-bold text-white text-sm md:text-base mb-4 md:mb-6">Dukungan</h4>
                    <ul class="space-y-3 md:space-y-4 text-slate-400 text-xs md:text-sm">
                        <li><a href="{{ route('help-center') }}" class="hover:text-blue-400 transition">Pusat Bantuan</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="hover:text-blue-400 transition">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('terms-conditions') }}" class="hover:text-blue-400 transition">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('how-to-order') }}" class="hover:text-blue-400 transition">Panduan Pesan</a></li>
                    </ul>
                </div>

                <!-- App -->
                <div class="col-span-1 md:col-span-1 lg:col-span-1">
                    <h4 class="font-bold text-white text-sm md:text-base mb-4 md:mb-6">Aplikasi</h4>
                    <div class="space-y-3">
                        <a href="#"
                            class="inline-flex w-full max-w-[144px] bg-slate-800 border border-slate-700 text-white rounded-lg px-2 py-1.5 items-center gap-2 hover:bg-slate-700 transition">
                            <i class="fab fa-apple text-xl"></i>
                            <div class="text-left">
                                <p class="text-[8px] leading-none text-slate-400">Download on the</p>
                                <p class="text-[11px] font-bold leading-tight">App Store</p>
                            </div>
                        </a>
                        <a href="#"
                            class="inline-flex w-full max-w-[144px] bg-slate-800 border border-slate-700 text-white rounded-lg px-2 py-1.5 items-center gap-2 hover:bg-slate-700 transition">
                            <i class="fab fa-google-play text-lg"></i>
                            <div class="text-left">
                                <p class="text-[8px] leading-none text-slate-400">GET IT ON</p>
                                <p class="text-[11px] font-bold leading-tight">Google Play</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="auto-scroll-footer border-t border-dashed border-slate-700 pt-8 pb-4 lg:py-8 flex flex-nowrap lg:grid lg:grid-cols-4 gap-10 lg:gap-8 overflow-x-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                <!-- Partner -->
                <div class="shrink-0 w-auto">
                    <h4 class="font-bold text-white mb-4 text-sm md:text-base">Partner Kampus</h4>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-university text-3xl text-blue-400"></i>
                        <div class="leading-tight">
                            <div class="text-sm font-bold text-slate-200">Universitas Amikom</div>
                            <p class="text-[11px] text-slate-400">Yogyakarta, Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- Keamanan -->
                <div class="shrink-0 w-auto">
                    <h4 class="font-bold text-white mb-4 text-sm md:text-base">Transaksi Aman</h4>
                    <div class="flex flex-wrap gap-3 text-2xl md:text-3xl text-slate-500">
                        <i class="fab fa-cc-visa hover:text-white transition cursor-pointer"></i>
                        <i class="fab fa-cc-mastercard hover:text-white transition cursor-pointer"></i>
                        <i class="fab fa-cc-paypal hover:text-white transition cursor-pointer"></i>
                    </div>
                </div>

                <!-- Penghargaan -->
                <div class="shrink-0 w-auto">
                    <h4 class="font-bold text-white mb-4 text-sm md:text-base">Penghargaan</h4>
                    <div class="flex flex-wrap gap-3 text-2xl md:text-3xl text-slate-500">
                        <i class="fas fa-award hover:text-white transition cursor-pointer"></i>
                        <i class="fas fa-medal hover:text-white transition cursor-pointer"></i>
                        <i class="fas fa-trophy hover:text-white transition cursor-pointer"></i>
                    </div>
                </div>

                <!-- Follow us -->
                <div class="shrink-0 w-auto">
                    <h4 class="font-bold text-white mb-4 text-sm md:text-base">Ikuti Kami</h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition"><i
                                class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition"><i
                                class="fab fa-twitter text-sm"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition"><i
                                class="fab fa-linkedin-in text-sm"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition"><i
                                class="fab fa-youtube text-sm"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition"><i
                                class="fab fa-instagram text-sm"></i></a>
                    </div>
                </div>
            </div>

            <div
                class="pt-8 border-t border-slate-800 text-[13px] text-slate-500 flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; {{ date('Y') }} Rahmat Ramadhan (24.12.3252). Hak cipta dilindungi.</p>
                <p>Dibuat dengan <i class="fas fa-heart text-cyan-500 mx-1"></i> di Yogyakarta.</p>
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

        // Auto-scroll logic for footer sections on mobile
        const scrollContainers = document.querySelectorAll('.auto-scroll-footer');
        scrollContainers.forEach(container => {
            // Clone children for infinite loop (hide clones on desktop to preserve grid)
            const children = Array.from(container.children);
            children.forEach(child => {
                const clone = child.cloneNode(true);
                clone.classList.add('lg:hidden');
                container.appendChild(clone);
            });

            let isHovering = false;

            function autoScroll() {
                // Only scroll if content is actually overflowing (mobile mode)
                if (!isHovering && container.scrollWidth > container.clientWidth) {
                    container.scrollLeft += 0.5; // Steady speed to the left

                    // Seamless loop: reset scroll when reaching the start of the cloned set
                    if (container.scrollLeft >= (container.scrollWidth / 2)) {
                        container.scrollLeft = 0;
                    }
                }
                requestAnimationFrame(autoScroll);
            }

            requestAnimationFrame(autoScroll);

            // Pause scrolling when user interacts
            container.addEventListener('mouseenter', () => isHovering = true);
            container.addEventListener('mouseleave', () => isHovering = false);
            container.addEventListener('touchstart', () => isHovering = true, { passive: true });
            container.addEventListener('touchend', () => {
                setTimeout(() => isHovering = false, 1500);
            }, { passive: true });
        });
    </script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then((registration) => {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, (err) => {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
    @stack('scripts')
</body>

</html>