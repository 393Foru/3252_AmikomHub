<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Temukan Event Seru!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
            
            <div class="flex-shrink-0 flex items-center pl-5 hover:scale-105 transition-transform duration-300">
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

                <div class="flex items-center gap-1">
                    @auth
                        <span class="text-sm font-bold text-zinc-700 mr-2 hidden md:block">
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

            </div>

        </nav>
    </div>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 min-h-[70vh]">
        @yield('content')
    </main>


    <!-- Footer -->
<footer class="bg-indigo-950 text-indigo-200 py-12 px-12 mt-12 border-t border-indigo-800/50">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="space-y-6 col-span-1 md:col-span-2">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-indigo-500 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-500/20">
                        AH
                    </div>
                    <span class="text-2xl font-extrabold text-white tracking-tight">Amikom<span class="text-indigo-400">EventHub</span></span>
                </div>
                <p class="max-w-sm leading-relaxed text-indigo-300/80">
                    Platform reservasi tiket event online terbaik untuk mahasiswa dan penyelenggara profesional. Temukan pengalaman seru di kampusmu.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-indigo-900 flex items-center justify-center hover:bg-indigo-500 transition-all duration-300 group">
                        <i class="fab fa-instagram group-hover:text-white"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-indigo-900 flex items-center justify-center hover:bg-indigo-500 transition-all duration-300 group">
                        <i class="fab fa-twitter group-hover:text-white"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold uppercase tracking-wider text-sm mb-6">Navigasi</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200 flex items-center gap-2">Home</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200 flex items-center gap-2">Semua Event</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition-colors duration-200 flex items-center gap-2">Cara Bayar</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold uppercase tracking-wider text-sm mb-6">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-400">Email:</span>
                        <a href="mailto:rahmat.ramadhan.0712@students.amikom.ac.id" class="hover:text-white transition-colors break-all">
                            rahmat.ramadhan.0712@students.amikom.ac.id
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-indigo-400">Telp:</span>
                        <a href="tel:+62882003859191" class="hover:text-white transition-colors">
                            +62 88 200 385 9191
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-indigo-900 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-medium text-indigo-400/60 uppercase tracking-widest">
            <p>&copy; 2026 - 24.12.3252 - Rahmat Ramadhan - All rights reserved.</p>
            <p>Built with <span class="text-indigo-400">Laravel</span> & <span class="text-indigo-400">Tailwind CSS</span></p>
        </div>
    </div>
</footer>

</body>

</html>