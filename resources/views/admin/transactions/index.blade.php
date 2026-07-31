@extends('layouts.admin')

@section('title', 'Laporan Transaksi Admin')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus kas dan penjualan tiket Anda secara real-time.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
    <!-- Header with Search & Filters -->
    <div class="p-6 md:p-8 border-b bg-white flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="font-black text-xl text-slate-800">Daftar Pesanan Tiket</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Total Transaksi: {{ $transactions->total() }}</p>
            </div>
            
            <button type="button" class="flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 border border-emerald-200 px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:-translate-y-0.5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Laporan
            </button>
        </div>

        <form action="{{ route('admin.transactions.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 placeholder-slate-400" placeholder="Cari Order ID atau nama...">
            </div>

            <div class="relative w-full sm:w-48">
                <select name="status" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed / Expired</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            
            <button type="submit" class="hidden">Filter</button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg">Order ID</th>
                    <th class="px-6 py-4">Detail Pembeli</th>
                    <th class="px-6 py-4 w-1/4">Event</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right rounded-tr-lg">Total Tagihan</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t border-slate-100 bg-white">
                @forelse($transactions as $trx)
                <tr class="hover:bg-slate-50/80 transition duration-200 {{ $trx->status == 'pending' ? 'opacity-90' : '' }}">
                    
                    <!-- Order ID -->
                    <td class="px-6 py-4 align-top">
                        <div class="flex flex-col gap-1.5">
                            <span class="font-mono font-bold px-2 py-1 rounded text-xs tracking-wide border inline-block w-max {{ $trx->status == 'pending' ? 'bg-slate-50 border-slate-200 text-slate-500' : 'bg-indigo-50 border-indigo-100 text-indigo-700' }}">
                                {{ $trx->order_id }}
                            </span>
                            <span class="text-[10px] text-slate-400 font-medium">
                                {{ $trx->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </td>
                    
                    <!-- Detail Pembeli -->
                    <td class="px-6 py-4 align-top">
                        <p class="font-bold text-sm text-slate-800 capitalize mb-1">{{ $trx->customer_name }}</p>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-xs text-slate-500 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $trx->customer_email }}
                            </span>
                            <span class="text-xs text-slate-500 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $trx->customer_phone }}
                            </span>
                        </div>
                    </td>
                    
                    <!-- Event -->
                    <td class="px-6 py-4 align-top">
                        @if($trx->event)
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg overflow-hidden shrink-0 border border-slate-100">
                                    <img src="{{ ($trx->event->poster_path && Storage::disk('public')->exists($trx->event->poster_path)) ? asset('storage/' . $trx->event->poster_path) : 'https://placehold.co/100x100' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-slate-800 line-clamp-2 leading-tight">{{ $trx->event->title }}</p>
                                </div>
                            </div>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-100">
                                Event Dihapus
                            </span>
                        @endif
                    </td>
                    
                    <!-- Status -->
                    <td class="px-6 py-4 align-top text-center">
                        @if(in_array(strtolower($trx->status), ['settlement', 'capture', 'success']))
                            <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold ring-1 ring-inset ring-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-sm"></span> Success
                            </span>
                        @elseif (strtolower($trx->status) === 'pending')
                            <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-xs font-bold ring-1 ring-inset ring-amber-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse shadow-sm"></span> Pending
                            </span>
                        @elseif (in_array(strtolower($trx->status), ['deny', 'cancel', 'expire', 'failure', 'failed']))
                            <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold ring-1 ring-inset ring-rose-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shadow-sm"></span> {{ ucfirst($trx->status) }}
                            </span>
                        @else
                            <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-slate-50 text-slate-600 rounded-lg text-xs font-bold ring-1 ring-inset ring-slate-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 shadow-sm"></span> {{ ucfirst($trx->status) }}
                            </span>
                        @endif
                    </td>
                    
                    <!-- Total -->
                    <td class="px-6 py-4 align-top text-right">
                        <span class="font-black text-indigo-600 text-sm">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
                @empty
                <!-- Empty State -->
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-12 h-12 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="font-bold text-slate-600 text-lg mb-1">Belum ada transaksi</h3>
                            <p class="text-slate-500 text-sm max-w-sm">Transaksi dari pelanggan yang membeli tiket acara Anda akan otomatis muncul di sini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginasi -->
    @if($transactions->hasPages())
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
        {{ $transactions->links() }}
    </div>
    @endif
</div>
@endsection