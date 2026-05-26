@extends('layouts.admin')

@section('content')

    <section class="flex-1 p-10 overflow-y-auto bg-slate-50 min-h-screen">
        
        <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <form action="{{ route('admin.partners.index') }}" method="GET" class="w-full md:w-96 flex gap-2">
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama partner..." 
                        class="w-full rounded-xl border border-slate-300 pl-11 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-colors shadow-sm">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.partners.index') }}" class="px-4 py-2.5 bg-slate-200 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-300 transition-colors flex items-center">
                        Reset
                    </a>
                @endif
            </form>

            @if(request('search'))
                <p class="text-sm text-slate-500 self-start md:self-center">
                    Hasil pencarian untuk: <span class="font-bold text-slate-800">"{{ request('search') }}"</span>
                </p>
            @endif
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-900">Partner Event</h1>
                <p class="text-slate-500 font-medium mt-1">Kelola daftar sponsor dan partner kolaborasi.</p>
            </div>
            
            <button onclick="toggleForm()" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Partner
            </button>
        </div>

        <div id="formTambah" class="hidden bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8 transition-all">
            <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Tambah Partner Baru</h3>
                <button type="button" onclick="toggleForm()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4 items-start">
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Partner / Perusahaan</label>
                            <input type="text" name="name" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" required>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Logo Partner (JPG/PNG)</label>
                            <input type="file" name="logo" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                        </div>
                        <div class="w-full md:w-auto mt-7">
                            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-emerald-500 text-white rounded-xl font-bold hover:bg-emerald-600 transition-colors shadow-sm">
                                Simpan Partner
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4 w-16">No</th>
                            <th class="px-8 py-4 w-24">Logo</th>
                            <th class="px-8 py-4">Nama Partner</th>
                            <th class="px-8 py-4">Tanggal Dibuat</th>
                            <th class="px-8 py-4">Tanggal Diubah</th>
                            <th class="px-8 py-4 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($partners as $partner)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium text-slate-600">{{ $loop->iteration }}</td>
                            <td class="px-8 py-4">
                                <div class="w-16 h-16 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center p-1">
                                    <img src="{{ Storage::url($partner->logo_url) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain">
                                </div>
                            </td>
                            <td class="px-8 py-4 font-semibold text-slate-900">{{ $partner->name }}</td>
                            <td class="px-8 py-4 text-sm text-slate-500">{{ $partner->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-4 text-sm text-slate-500">{{ $partner->updated_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" onclick="openModal('editModal{{ $partner->id }}')" class="px-3 py-1.5 bg-amber-500 text-white text-xs font-bold rounded-lg hover:bg-amber-600 transition-colors">Edit</button>

                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus partner ini beserta logonya?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-rose-500 text-white text-xs font-bold rounded-lg hover:bg-rose-600 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-8 text-center text-slate-400 font-medium">Belum ada data partner.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50 text-sm text-slate-500 flex justify-between items-center">
                <p>Total: {{ $partners->count() }} Partner</p>
            </div>
        </div>
    </section>

    @foreach($partners as $partner)
    <div id="editModal{{ $partner->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal('editModal{{ $partner->id }}')"></div>
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl sm:w-full sm:max-w-lg z-10">
                <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-white px-6 pb-6 pt-5">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">Edit Partner</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Partner</label>
                            <input type="text" name="name" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ $partner->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Update Logo (Opsional)</label>
                            <div class="flex items-center gap-4 mb-3">
                                <img src="{{ Storage::url($partner->logo_url) }}" class="w-12 h-12 rounded object-contain border bg-slate-50">
                                <span class="text-xs text-slate-500">Logo saat ini</span>
                            </div>
                            <input type="file" name="logo" class="w-full rounded-xl border border-slate-300 px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700">
                        </div>
                    </div>
                    
                    <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse gap-3 border-t">
                        <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-indigo-700">Simpan Perubahan</button>
                        <button type="button" onclick="closeModal('editModal{{ $partner->id }}')" class="rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-slate-700 border hover:bg-slate-50">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
        function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }
        function toggleForm() { document.getElementById('formTambah').classList.toggle('hidden'); }
    </script>
@endsection