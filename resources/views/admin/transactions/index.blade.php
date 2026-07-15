@extends('layouts.admin')

@section('title', 'Laporan Transaksi Admin')
@section('page_title', 'Laporan Transaksi')
@section('page_subtitle', 'Pantau arus kas dan penjualan tiket Anda secara real-time.')

@section('content')
<div class="bg-white rounded-[2rem] border border-slate-200 shadow-lg overflow-hidden">
    
    <!-- Bagian Header Tabel -->
    <div class="p-6 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
        <h2 class="text-lg font-extrabold text-slate-800">Daftar Pesanan Tiket</h2>
        <span class="px-4 py-1.5 bg-indigo-100 text-indigo-700 font-bold text-xs rounded-full ring-1 ring-indigo-300">
            Total Transaksi: {{ $transactions->total() }}
        </span>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-100 text-slate-500 uppercase text-[11px] font-black tracking-wider">
                <tr>
                    <th class="px-8 py-5">Order ID</th>
                    <th class="px-8 py-5">Detail Pembeli</th>
                    <th class="px-8 py-5">Event</th>
                    <th class="px-8 py-5">Tgl Transaksi</th>
                    <th class="px-8 py-5 text-center">Status</th>
                    <th class="px-8 py-5 text-right">Total Tagihan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($transactions as $trx)
                <tr class="hover:bg-indigo-50/40 transition duration-200 ease-in-out {{ $trx->status == 'pending' ? 'opacity-80' : '' }}">
                    
                    <!-- Order ID -->
                    <td class="px-8 py-6">
                        <span class="font-mono font-bold px-3 py-1.5 rounded-lg text-sm tracking-wide shadow-sm border {{ $trx->status == 'pending' ? 'bg-slate-50 border-slate-200 text-slate-500' : 'bg-white border-indigo-100 text-indigo-700' }}">
                            {{ $trx->order_id }}
                        </span>
                    </td>
                    
                    <!-- Detail Pembeli -->
                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-800 capitalize">{{ $trx->customer_name }}</p>
                        <div class="flex flex-col gap-0.5 mt-1">
                            <span class="text-[11px] text-slate-500 font-medium tracking-wide flex items-center gap-1">
                                ✉ {{ $trx->customer_email }}
                            </span>
                            <span class="text-[11px] text-slate-500 font-medium tracking-wide flex items-center gap-1">
                                ✆ {{ $trx->customer_phone }}
                            </span>
                        </div>
                    </td>
                    
                    <!-- Event -->
                    <td class="px-8 py-6">
                        <p class="font-semibold text-slate-700">{{ $trx->event->title ?? 'Event Dihapus' }}</p>
                    </td>
                    
                    <!-- Tanggal -->
                    <td class="px-8 py-6 text-sm text-slate-500 font-medium">
                        {{ $trx->created_at->format('d M Y, H:i') }} WIB
                    </td>
                    
                    <!-- Status -->
                    <td class="px-8 py-6 text-center">
                        @if($trx->status === 'settlement' || $trx->status === 'success')
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[11px] font-black uppercase ring-1 ring-inset ring-emerald-500/30 shadow-sm flex inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Success
                            </span>
                        @elseif ($trx->status === 'pending')
                            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 rounded-xl text-[11px] font-black uppercase ring-1 ring-inset ring-amber-500/30 shadow-sm flex inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-rose-50 text-rose-600 rounded-xl text-[11px] font-black uppercase ring-1 ring-inset ring-rose-500/30 shadow-sm flex inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> {{ $trx->status }}
                            </span>
                        @endif
                    </td>
                    
                    <!-- Total -->
                    <td class="px-8 py-6 text-right font-black text-slate-800 text-base">
                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <!-- Empty State -->
                <tr>
                    <td colspan="6" class="px-8 py-16 text-center bg-slate-50/50">
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-4xl mb-3">📭</span>
                            <h3 class="text-slate-600 font-bold text-lg">Belum ada transaksi</h3>
                            <p class="text-slate-400 text-sm mt-1">Transaksi pelanggan akan otomatis muncul di sini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginasi -->
    <div class="px-8 py-5 bg-slate-50 border-t border-slate-200">
        {{ $transactions->links() }}
    </div>
</div>
@endsection