@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Ringkasan')


@section('content')
<!-- Quick Actions -->
<div class="flex flex-wrap items-center gap-4 mb-8">
    <a href="{{ route('admin.events.create') }}" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Buat Event Baru
    </a>
    <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5">
        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Validasi Transaksi
    </a>
    @if(is_null(auth()->user()->partner_id))
    <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5">
        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        Kelola Partner
    </a>
    @endif

    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center gap-3 ml-auto">
        <label for="filter" class="text-sm font-bold text-slate-500 hidden md:block uppercase tracking-wider text-[10px]">Filter:</label>
        <div class="relative">
            <!-- Retain chart_filter if present -->
            <input type="hidden" name="chart_filter" value="{{ $chartFilter ?? '7d' }}">
            <select name="filter" id="filter" onchange="this.form.submit()" class="bg-white border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-40 p-2.5 shadow-sm font-medium cursor-pointer appearance-none pr-10">
                <option value="all" {{ ($filter ?? 'all') == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                <option value="today" {{ ($filter ?? 'all') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="week" {{ ($filter ?? 'all') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                <option value="month" {{ ($filter ?? 'all') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </form>
</div>

  <!-- Top Section: Stats and Category Chart -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
      <!-- Stats Cards (Left Side, 2x2 grid) -->
      <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
    <!-- Revenue Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
      <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full blur-2xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
      <div class="flex justify-between items-start mb-4 relative">
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        @if($trends['revenue'] !== null)
          <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $trends['revenue'] > 0 ? 'bg-emerald-50 text-emerald-600' : ($trends['revenue'] < 0 ? 'bg-rose-50 text-rose-600' : 'bg-slate-50 text-slate-500') }}">
            @if($trends['revenue'] > 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            +{{ $trends['revenue'] }}%
            @elseif($trends['revenue'] < 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
            {{ $trends['revenue'] }}%
            @else
            0%
            @endif
          </span>
        @endif
      </div>
      <p class="text-slate-400 text-sm font-bold uppercase mb-1 tracking-wide relative">Total Pendapatan</p>
      <div class="flex items-end gap-2 relative">
          <h3 class="text-2xl font-black text-slate-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
      </div>
    </div>

    <!-- Tickets Sold Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
      <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full blur-2xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
      <div class="flex justify-between items-start mb-4 relative">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
        </div>
        @if($trends['tickets'] !== null)
          <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $trends['tickets'] > 0 ? 'bg-emerald-50 text-emerald-600' : ($trends['tickets'] < 0 ? 'bg-rose-50 text-rose-600' : 'bg-slate-50 text-slate-500') }}">
            @if($trends['tickets'] > 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            +{{ $trends['tickets'] }}%
            @elseif($trends['tickets'] < 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
            {{ $trends['tickets'] }}%
            @else
            0%
            @endif
          </span>
        @endif
      </div>
      <p class="text-slate-400 text-sm font-bold uppercase mb-1 tracking-wide relative">Tiket Terjual</p>
      <h3 class="text-2xl font-black text-slate-800 relative">{{ number_format($ticketsSold, 0, ',', '.') }}</h3>
    </div>

    <!-- Active Events Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
      <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-50 rounded-full blur-2xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
      <div class="flex justify-between items-start mb-4 relative">
        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        @if($trends['events'] !== null)
          <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $trends['events'] > 0 ? 'bg-emerald-50 text-emerald-600' : ($trends['events'] < 0 ? 'bg-rose-50 text-rose-600' : 'bg-slate-50 text-slate-500') }}">
            @if($trends['events'] > 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            +{{ $trends['events'] }}%
            @elseif($trends['events'] < 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
            {{ $trends['events'] }}%
            @else
            0%
            @endif
          </span>
        @endif
      </div>
      <p class="text-slate-400 text-sm font-bold uppercase mb-1 tracking-wide relative">Event Aktif</p>
      <h3 class="text-2xl font-black text-slate-800 relative">{{ $activeEvents }} <span class="text-lg font-bold text-slate-400">Event</span></h3>
    </div>

    <!-- Pending Orders Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
      <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-50 rounded-full blur-2xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
      <div class="flex justify-between items-start mb-4 relative">
        <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        @if($trends['pending'] !== null)
          <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $trends['pending'] > 0 ? 'bg-rose-50 text-rose-600' : ($trends['pending'] < 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-500') }}">
            @if($trends['pending'] > 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            +{{ $trends['pending'] }}%
            @elseif($trends['pending'] < 0)
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
            {{ $trends['pending'] }}%
            @else
            0%
            @endif
          </span>
        @endif
      </div>
      <p class="text-slate-400 text-sm font-bold uppercase mb-1 tracking-wide relative">Pesanan Pending</p>
      <h3 class="text-2xl font-black text-slate-800 relative">{{ $pendingOrders }} <span class="text-lg font-bold text-slate-400">Pesanan</span></h3>
      </div>
  </div> <!-- Close Stats Grid -->

  <!-- Category Chart (Right Side) -->
  <div class="lg:col-span-1 bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
      <div class="mb-6">
          <h3 class="font-black text-xl text-slate-800">Kategori Terjual</h3>
          <p class="text-sm text-slate-500">Distribusi Penjualan Tiket</p>
      </div>
      <div class="relative flex-1 min-h-[250px] w-full flex justify-center items-center">
          @if(count($categoryChartLabels) > 0)
              <canvas id="categoryChart"></canvas>
          @else
              <div class="text-slate-400 text-sm flex flex-col items-center">
                  <svg class="w-10 h-10 mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                  </svg>
                  Belum ada penjualan
              </div>
          @endif
      </div>
  </div>
</div> <!-- Close Top Section Grid -->

<!-- Analytics Chart (Revenue) -->
<div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm mb-10">
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
            <div>
                <h3 class="font-black text-xl text-slate-800">Tren Pendapatan</h3>
                <p class="text-sm text-slate-500">
                    @if($chartFilter === '1m') 30 Hari Terakhir
                    @elseif($chartFilter === '3m') 3 Bulan Terakhir
                    @elseif($chartFilter === '6m') 6 Bulan Terakhir
                    @elseif($chartFilter === '1y') 1 Tahun Terakhir
                    @else 7 Hari Terakhir
                    @endif
                </p>
            </div>
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center">
                <input type="hidden" name="filter" value="{{ $filter ?? 'all' }}">
                <div class="relative">
                    <select name="chart_filter" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-40 p-2 shadow-sm font-medium cursor-pointer appearance-none pr-10 hover:bg-slate-100 transition">
                        <option value="7d" {{ ($chartFilter ?? '7d') == '7d' ? 'selected' : '' }}>7 Hari Terakhir</option>
                        <option value="1m" {{ ($chartFilter ?? '7d') == '1m' ? 'selected' : '' }}>Sebulan</option>
                        <option value="3m" {{ ($chartFilter ?? '7d') == '3m' ? 'selected' : '' }}>3 Bulan</option>
                        <option value="6m" {{ ($chartFilter ?? '7d') == '6m' ? 'selected' : '' }}>6 Bulan</option>
                        <option value="1y" {{ ($chartFilter ?? '7d') == '1y' ? 'selected' : '' }}>Setahun</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </form>
        </div>
        <div class="relative h-72 w-full">
            <canvas id="revenueChart"></canvas>
        </div>
      </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
  <!-- Latest Sales Table -->
  <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
    <div class="p-6 md:p-8 border-b flex justify-between items-center bg-white">
      <h3 class="font-black text-xl text-slate-800">Transaksi Terakhir</h3>
      <a href="{{ route('admin.transactions.index') }}"
        class="text-indigo-600 font-bold hover:text-indigo-700 hover:underline transition flex items-center gap-1 text-sm">
        Lihat Semua
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </a>
    </div>
    <div class="overflow-x-auto flex-1">
      <table class="w-full text-left border-collapse min-w-[700px]">
        <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] font-black tracking-widest">
          <tr>
            <th class="px-6 py-4 rounded-tl-lg">Tgl Transaksi</th>
            <th class="px-6 py-4">Pembeli</th>
            <th class="px-6 py-4 w-1/4">Event</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-right rounded-tr-lg">Total</th>
          </tr>
        </thead>
        <tbody class="divide-y border-t border-slate-100">
          @forelse($recentTransactions as $trx)
          <tr class="hover:bg-slate-50/80 transition duration-200">
            <td class="px-6 py-4 whitespace-nowrap">
              <p class="text-sm font-bold text-slate-700">{{ $trx->created_at->format('d M y - H:i') }}</p>
              <p class="text-xs text-slate-400 font-mono mt-0.5">{{ $trx->order_id }}</p>
            </td>
            <td class="px-6 py-4">
              <p class="font-bold uppercase tracking-wide text-sm text-slate-800">{{ $trx->customer_name }}</p>
              <p class="text-xs text-slate-500 mt-0.5">{{ $trx->customer_email }}</p>
            </td>
            <td class="px-6 py-4">
              <p class="font-bold text-sm text-slate-700 line-clamp-2 leading-snug">{{ $trx->event->title ?? '-' }}</p>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @php $status = strtolower($trx->status); @endphp
              @if($status === 'settlement' || $status === 'success')
              <span class="inline-flex items-center px-2 py-1 rounded text-[9px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700 border border-emerald-200">
                Success
              </span>
              @elseif($status === 'pending')
              <span class="inline-flex items-center px-2 py-1 rounded text-[9px] font-black uppercase tracking-wider bg-amber-100 text-amber-700 border border-amber-200">
                Pending
              </span>
              @else
              <span class="inline-flex items-center px-2 py-1 rounded text-[9px] font-black uppercase tracking-wider bg-rose-100 text-rose-700 border border-rose-200">
                {{ $trx->status }}
              </span>
              @endif
            </td>
            <td class="px-6 py-4 font-black text-indigo-600 whitespace-nowrap text-right">
              Rp {{ number_format($trx->total_price, 0, ',', '.') }}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-12 text-center">
              <div class="flex flex-col items-center justify-center text-slate-400">
                <svg class="w-10 h-10 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="font-bold text-slate-500">Belum ada transaksi</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Sidebar Widgets (Activity Logs & Top Events) -->
  <div class="lg:col-span-1 flex flex-col gap-6">
    <!-- Activity Logs Widget -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
      <div class="p-6 md:p-8 border-b bg-white">
        <h3 class="font-black text-xl text-slate-800">Log Aktivitas</h3>
        <p class="text-xs text-slate-400 font-medium mt-1">Pembaruan sistem secara real-time</p>
      </div>
      <div class="p-6 md:p-8 flex-1">
        <div class="relative border-l-2 border-slate-100 ml-3 space-y-6">
          @forelse($activityLogs as $log)
          <div class="relative pl-6">
              <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full {{ $log->type === 'event' ? 'bg-indigo-500 ring-4 ring-indigo-50' : 'bg-emerald-500 ring-4 ring-emerald-50' }}"></span>
              <div class="mb-1 text-xs text-slate-400 font-bold tracking-wide">{{ $log->time->diffForHumans() }}</div>
              <p class="font-bold text-slate-700 text-sm leading-snug">{{ $log->title }}</p>
              <p class="text-xs text-slate-500 mt-1">{{ $log->subtitle }}</p>
          </div>
          @empty
          <div class="pl-6 text-sm text-slate-400 flex flex-col items-center justify-center py-6">
              <svg class="w-8 h-8 mb-2 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              Belum ada aktivitas.
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Event Terpopuler -->
<div class="mb-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="font-black text-xl text-slate-800">Event Terpopuler</h3>
            <p class="text-sm text-slate-500 mt-1">Peringkat 5 event dengan penjualan tiket tertinggi</p>
        </div>
    </div>
    
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-6 py-4 font-bold w-20 text-center">Peringkat</th>
                        <th class="px-6 py-4 font-bold">Event</th>
                        <th class="px-6 py-4 font-bold">Penyelenggara</th>
                        <th class="px-6 py-4 font-bold text-center">Tiket Terjual</th>
                        <th class="px-6 py-4 font-bold text-right">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($topEvents as $index => $event)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-center">
                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold text-xs {{ $index === 0 ? 'bg-amber-100 text-amber-600' : ($index === 1 ? 'bg-slate-100 text-slate-500' : ($index === 2 ? 'bg-orange-100 text-orange-600' : 'bg-slate-50 text-slate-500')) }}">
                                #{{ $index + 1 }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $event->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $event->category->name ?? 'Uncategorized' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-600 border border-slate-200/60">
                                {{ $event->owner ? $event->owner->name : 'Penyelenggara Utama' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold text-slate-700">{{ $event->sales_count }}</span>
                            <span class="text-xs text-slate-400 ml-1">Tiket</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-emerald-600">Rp {{ number_format($event->total_revenue, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-10 h-10 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="font-bold text-slate-500">Belum ada data event terpopuler</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Kapasitas Event Aktif -->
<div class="mb-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="font-black text-xl text-slate-800">Kapasitas Event Aktif</h3>
            <p class="text-sm text-slate-500 mt-1">Pantau sisa kuota tiket event yang sedang berjalan</p>
        </div>
    </div>
    
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-6 py-4 font-bold">Event Aktif</th>
                        <th class="px-6 py-4 font-bold text-center">Status Kapasitas</th>
                        <th class="px-6 py-4 font-bold text-center">Tiket Terjual</th>
                        <th class="px-6 py-4 font-bold text-right">Kuota Tersedia (Sisa)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($capacityEvents->take(5) as $event)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-800">{{ $event->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $event->date->format('d M Y, H:i') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="w-full max-w-[150px] mx-auto">
                                <div class="flex justify-between text-[10px] font-bold mb-1 {{ $event->sold_percentage >= 90 ? 'text-rose-600' : ($event->sold_percentage >= 70 ? 'text-amber-600' : 'text-emerald-600') }}">
                                    <span>Terisi</span>
                                    <span>{{ $event->sold_percentage }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-1.5 rounded-full {{ $event->sold_percentage >= 90 ? 'bg-rose-500' : ($event->sold_percentage >= 70 ? 'bg-amber-500' : 'bg-emerald-500') }}" style="width: {{ $event->sold_percentage }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold text-slate-700">{{ $event->sold_tickets }}</span>
                            <span class="text-xs text-slate-400 ml-1">Tiket</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-slate-800">{{ $event->stock }}</span>
                            <span class="text-xs text-slate-400 ml-1">Tiket</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-10 h-10 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <p class="font-bold text-slate-500">Belum ada event aktif.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Chart.js initialization
        const canvas = document.getElementById('revenueChart');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            
            // Create gradient for the line
            const gradientLine = ctx.createLinearGradient(0, 0, 0, 400);
            gradientLine.addColorStop(0, 'rgba(99, 102, 241, 1)');
            gradientLine.addColorStop(1, 'rgba(99, 102, 241, 0.2)');

            // Create gradient for the fill
            const gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
            gradientFill.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
            gradientFill.addColorStop(1, 'rgba(99, 102, 241, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartDates) !!},
                    datasets: [{
                        label: 'Pendapatan',
                        data: {!! json_encode($chartRevenue) !!},
                        borderColor: 'rgba(99, 102, 241, 1)',
                        backgroundColor: gradientFill,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: 'rgba(99, 102, 241, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 13
                            },
                            bodyFont: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 14,
                                weight: 'bold'
                            },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw;
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(241, 245, 249, 1)',
                                drawBorder: false,
                            },
                            ticks: {
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    size: 11
                                },
                                color: '#94a3b8',
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                                    }
                                    return 'Rp ' + value;
                                }
                            },
                            border: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    size: 11
                                },
                                color: '#94a3b8'
                            },
                            border: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        }
        // Category Doughnut Chart
        const catCanvas = document.getElementById('categoryChart');
        if (catCanvas) {
            const catCtx = catCanvas.getContext('2d');
            
            // Modern, vibrant color palette
            const pieColors = [
                '#6366f1', // Indigo
                '#3b82f6', // Blue
                '#10b981', // Emerald
                '#f59e0b', // Amber
                '#ef4444', // Rose
                '#8b5cf6', // Violet
                '#ec4899', // Pink
                '#14b8a6', // Teal
                '#64748b'  // Slate (fallback)
            ];

            new Chart(catCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryChartLabels) !!},
                    datasets: [{
                        data: {!! json_encode($categoryChartData) !!},
                        backgroundColor: pieColors,
                        borderWidth: 4,
                        borderColor: '#ffffff',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    size: 11,
                                    weight: '600'
                                },
                                usePointStyle: true,
                                boxWidth: 8,
                                boxHeight: 8
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 13
                            },
                            bodyFont: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 14,
                                weight: 'bold'
                            },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.raw + ' Penjualan';
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection