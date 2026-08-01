<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Eventama</title>
    
    <!-- PWA Config -->
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('assets/icons/icon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/icons/icon-192x192.png') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 flex min-h-screen">
    
    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-900/50 z-40 hidden md:hidden transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="w-64 bg-indigo-900 text-indigo-100 flex flex-col p-6 space-y-8 fixed md:sticky top-0 h-screen z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">
                    AH
                </div>
                <span class="text-xl font-bold text-white tracking-tight">
                    Eventama
                </span>
            </div>
            <!-- Close Sidebar Button (Mobile Only) -->
            <button onclick="toggleSidebar()" class="md:hidden text-indigo-300 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex-1 space-y-2">
            @php
                $user = auth()->user();
                $pendingOrdersCount = \App\Models\Transaction::where('status', 'pending')
                    ->when($user->partner_id, function($q) use ($user) {
                        $q->whereHas('event', function($eq) use ($user) {
                            $eq->where('partner_id', $user->partner_id);
                        });
                    })->count();
            @endphp

            <p class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 mb-4 px-2">
                Main Menu
            </p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.events.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Kelola Event
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.transactions.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Laporan Transaksi
                @if($pendingOrdersCount > 0)
                <span class="ml-auto bg-rose-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-sm">
                    {{ $pendingOrdersCount }}
                </span>
                @endif
            </a>
            @if(is_null(auth()->user()->partner_id))
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 20 a0020020002v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Kelola Kategori
            </a>
            @endif
            @if(is_null(auth()->user()->partner_id))
            <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.partners.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.partners.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Kelola Partner
            </a>
            @endif

            @if(auth()->user()->partner_id)
            <!-- Navigasi Baru: Kelola Jabatan -->
            <a href="{{ route('admin.jabatan.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.jabatan.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.jabatan.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Kelola Jabatan
            </a>

            <!-- Navigasi Baru: Kelola Pengurus -->
            <a href="{{ route('admin.pengurus.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.pengurus.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.pengurus.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Kelola Pengurus
            </a>
            @endif
            
        </nav>

        <div class="pt-6 border-t border-indigo-800">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-indigo-300 hover:text-white transition font-medium text-left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-6 md:p-10 overflow-y-auto w-full">
        <header class="flex justify-between items-center mb-8 md:mb-10 w-full col-span-full">
            <div class="flex items-center gap-4">
                <!-- Hamburger Menu Button -->
                <button onclick="toggleSidebar()" class="md:hidden p-2 -ml-2 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-2xl md:text-3xl font-black">
                    @yield('page_title', 'Dashboard')
                </h1>
                <p class="text-slate-500 font-medium">
                    @hasSection('page_subtitle')
                        @yield('page_subtitle')
                    @else
                        Selamat datang kembali, {{ auth()->user()->name ?? 'Admin' }}!
                    @endif
                </p>
                </div>
            </div>
            
            <div class="flex-1 flex justify-end mr-4 md:mr-6">
                @yield('header_actions')
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="font-bold">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-xs text-slate-400">
                        {{ auth()->user()->partner_id ? (auth()->user()->partner->name ?? 'Partner Admin') : 'Penyelenggara Utama' }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border flex items-center justify-center p-1">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=6366f1&color=fff" class="rounded-xl">
                </div>
            </div>
        </header>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold text-sm">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </main>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            
            // Toggle sidebar translate
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                // Show backdrop
                backdrop.classList.remove('hidden');
                // Slight delay to allow display block to apply before opacity transition
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                // Hide backdrop
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
            }
        }
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