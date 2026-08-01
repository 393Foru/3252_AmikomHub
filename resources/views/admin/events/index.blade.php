@extends('layouts.admin')
@section('title', 'Kelola Event - Admin')
@section('page_title', 'Kelola Event')

@section('page_subtitle', 'Buat dan atur acara seru Anda di sini.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
    <div class="p-6 md:p-8 border-b bg-white flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="font-black text-xl text-slate-800">Daftar Event</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Kelola semua acara yang Anda selenggarakan</p>
            </div>
            
            <a href="{{ route('admin.events.create') }}" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Event Baru
            </a>
        </div>

        <form action="{{ route('admin.events.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 placeholder-slate-400" placeholder="Cari judul atau lokasi...">
            </div>

            <div class="relative w-full sm:w-40">
                <select name="month" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 appearance-none cursor-pointer">
                    <option value="">Semua Bulan</option>
                    @php
                        $months = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                    @endphp
                    @foreach($months as $num => $name)
                    <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <div class="relative w-full sm:w-48">
                <select name="category_id" onchange="this.form.submit()" class="w-full pl-4 pr-10 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 appearance-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
            
            <button type="submit" class="hidden">Filter</button>
        </form>
    </div>
    
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg w-16 text-center">No</th>
                    <th class="px-6 py-4">Poster</th>
                    <th class="px-6 py-4 w-1/3">Event</th>
                    <th class="px-6 py-4">Harga / Stok</th>
                    <th class="px-6 py-4 text-center rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t border-slate-100">

                @forelse($events as $index => $event)
                <tr class="hover:bg-slate-50/80 transition duration-200">
                    <td class="px-6 py-4 text-center">
                        <span class="text-sm font-bold text-slate-400">{{ $events->firstItem() + $index }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="relative group w-16 h-20 rounded-xl overflow-hidden shadow-sm border border-slate-100">
                            <img loading="lazy" src="{{ ($event->poster_path) ? (\Illuminate\Support\Str::startsWith($event->poster_path, 'http') ? $event->poster_path : (\Illuminate\Support\Str::startsWith($event->poster_path, 'http') ? $event->poster_path : asset('storage/' . $event->poster_path))) : 'https://placehold.co/160x200' }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $eventDate = \Carbon\Carbon::parse($event->date);
                            if ($eventDate->isToday()) {
                                $statusText = 'Hari Ini';
                                $statusClass = 'bg-amber-100 text-amber-700 border-amber-200';
                            } elseif ($eventDate->isPast()) {
                                $statusText = 'Selesai';
                                $statusClass = 'bg-slate-100 text-slate-600 border-slate-200';
                            } else {
                                $statusText = 'Segera Hadir';
                                $statusClass = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                            }
                        @endphp
                        
                        <div class="mb-1.5 flex items-center">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-wider border {{ $statusClass }}">
                                {{ $statusText }}
                            </span>
                        </div>
                        <p class="font-bold text-sm text-slate-800 line-clamp-2 leading-snug mb-1.5">{{ $event->title }}</p>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-wider bg-indigo-50 text-indigo-600 border border-indigo-100">
                                {{ $event->category->name ?? '-' }}
                            </span>
                            <span class="text-xs text-slate-400 font-mono">{{ $eventDate->format('d M Y H:i') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap min-w-[150px]">
                        <p class="font-black text-indigo-600 mb-2">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                        @php
                            $sold = $event->tickets_sold ?? 0;
                            $stock = $event->stock;
                            $percentage = $stock > 0 ? min(round(($sold / $stock) * 100), 100) : 0;
                        @endphp
                        <div class="w-full">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wide">Terjual</span>
                                <span class="text-xs font-black {{ $sold >= $stock ? 'text-rose-500' : 'text-slate-700' }}">{{ $sold }} / {{ $stock }}</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="h-1.5 rounded-full transition-all duration-500 {{ $percentage >= 100 ? 'bg-rose-500' : 'bg-indigo-500' }}" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <!-- tombol edit -->
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition shadow-sm hover:shadow" title="Edit Event">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <!-- tombol hapus -->
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm hover:shadow btn-delete" title="Hapus Event">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-10 h-10 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="font-bold text-slate-500">Belum ada acara yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($events->hasPages())
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.form-delete');
            Swal.fire({
                title: 'Hapus Event?',
                text: "Data dan poster event akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#e11d48',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl border border-slate-100 shadow-xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-bold shadow-sm',
                    cancelButton: 'rounded-xl px-6 py-2.5 font-bold shadow-sm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush