@extends('layouts.admin')

@section('content')

    <section class="flex-1 p-10 overflow-y-auto bg-slate-50 min-h-screen">
        
        <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="w-full md:w-96 flex gap-2">
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama kategori..." 
                        class="w-full rounded-xl border border-slate-300 pl-11 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-colors shadow-sm">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2.5 bg-slate-200 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-300 transition-colors flex items-center">
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
                <h1 class="text-3xl font-black text-slate-900">Kategori Event</h1>
                <p class="text-slate-500 font-medium mt-1">Kelola jenis-jenis event yang tersedia di platform.</p>
            </div>
            
            <button onclick="toggleForm()" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Kategori
            </button>
        </div>

        <div id="formTambah" class="hidden bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8 transition-all">
            <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Tambah Kategori Baru</h3>
                <button type="button" onclick="toggleForm()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4 items-start">
                        <div class="flex-1 w-full">
                            <input type="text" name="name" 
                                class="w-full rounded-xl border {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-slate-300 focus:ring-indigo-500 focus:border-indigo-500' }} px-4 py-3 focus:outline-none focus:ring-2 transition-all" 
                                placeholder="Masukkan nama kategori (contoh: Seminar IT)..." 
                                value="{{ old('name') }}" required>
                            
                            @error('name')
                                <p class="text-red-500 text-sm font-medium mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-auto">
                            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-emerald-500 text-white rounded-xl font-bold hover:bg-emerald-600 transition-colors shadow-sm">
                                Simpan Kategori
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4 w-16">No</th>
                            <th class="px-8 py-4">Nama Kategori</th>
                            <th class="px-8 py-4">Tanggal Dibuat</th>
                            <th class="px-8 py-4">Tanggal Diubah</th>
                            <th class="px-8 py-4 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4 font-medium text-slate-600">{{ $loop->iteration }}</td>
                            <td class="px-8 py-4 font-semibold text-slate-900">{{ $category->name }}</td>
                            <td class="px-8 py-4 text-sm text-slate-500">{{ $category->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-4 text-sm text-slate-500">{{ $category->updated_at->format('d M Y, H:i') }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center gap-2 p-4">
                                    <button type="button" onclick="openModal('editModal{{ $category->id }}')" class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-8 text-center text-slate-400 font-medium">Belum ada data kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50 text-sm text-slate-500 flex justify-between items-center">
                <p>Total: {{ $categories->count() }} Kategori</p>
            </div>
        </div>
    </section>

    @foreach($categories as $category)
    <div id="editModal{{ $category->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeModal('editModal{{ $category->id }}')"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg z-10">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-white px-6 pb-6 pt-5 sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-xl font-bold leading-6 text-slate-900 mb-4" id="modal-title">Edit Kategori</h3>
                            
                            <div class="mb-4 text-left">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Kategori</label>
                                <input type="text" name="name" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" value="{{ $category->name }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-slate-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3 border-t border-slate-200">
                        <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 sm:w-auto transition-all">Simpan Perubahan</button>
                        <button type="button" onclick="closeModal('editModal{{ $category->id }}')" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-all">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // Fungsi Buka Tutup Modal Edit
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Fungsi Buka Tutup Form Tambah Kategori
        function toggleForm() {
            const form = document.getElementById('formTambah');
            form.classList.toggle('hidden');
        }
    </script>

@endsection