@extends('layouts.admin')
@section('title', 'Kelola Kategori - Admin')
@section('page_title', 'Kelola Kategori')
@section('page_subtitle', 'Kelola jenis-jenis event yang tersedia di platform.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
    <!-- Header Card -->
    <div class="p-6 md:p-8 border-b bg-white flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="font-black text-xl text-slate-800">Daftar Kategori</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Daftar kategori event yang tersedia</p>
            </div>
            
            <button onclick="toggleForm()" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Kategori
            </button>
        </div>

        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 placeholder-slate-400" placeholder="Cari nama kategori...">
            </div>
            
            @if(request('search'))
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-xl font-medium transition text-sm">
                Reset
            </a>
            @endif
            <button type="submit" class="hidden">Cari</button>
        </form>
    </div>

    <!-- Form Tambah Kategori -->
    <div id="formTambah" class="hidden border-b border-slate-100 bg-slate-50/30 transition-all">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-800">Tambah Kategori Baru</h3>
                <button type="button" onclick="toggleForm()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="flex flex-col sm:flex-row gap-4 items-start">
                    <div class="flex-1 w-full">
                        <input type="text" name="name" 
                            class="w-full rounded-xl border {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-slate-200 focus:ring-indigo-500/20 focus:border-indigo-500' }} px-4 py-2.5 focus:outline-none focus:ring-2 transition-all bg-white font-medium text-sm text-slate-800 placeholder-slate-400" 
                            placeholder="Masukkan nama kategori (contoh: Seminar IT)..." 
                            value="{{ old('name') }}" required>
                        
                        @error('name')
                            <p class="text-red-500 text-sm font-medium mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-emerald-500 text-white rounded-xl text-sm font-bold hover:bg-emerald-600 transition-colors shadow-sm whitespace-nowrap">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg w-16 text-center">No</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4">Tanggal Dibuat</th>
                    <th class="px-6 py-4">Tanggal Diubah</th>
                    <th class="px-6 py-4 w-32 text-center rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t border-slate-100 divide-slate-100">
                @forelse($categories as $category)
                <tr class="hover:bg-slate-50/80 transition duration-200">
                    <td class="px-6 py-4 text-center font-medium text-slate-400 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-bold text-slate-800 text-sm">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-500">{{ $category->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-500">{{ $category->updated_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="openModal('editModal{{ $category->id }}')" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition shadow-sm hover:shadow" title="Edit Kategori">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm hover:shadow btn-delete" title="Hapus Kategori">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <p class="font-bold text-slate-500">Belum ada kategori yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 text-xs font-bold text-slate-500 flex justify-between items-center">
        <p>Total: {{ $categories->count() }} Kategori</p>
    </div>
</div>

@foreach($categories as $category)
<div id="editModal{{ $category->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeModal('editModal{{ $category->id }}')"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md z-10 border border-slate-100">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="bg-white px-6 pb-6 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-xl font-black text-slate-800" id="modal-title">Edit Kategori</h3>
                        <button type="button" onclick="closeModal('editModal{{ $category->id }}')" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <div class="mb-4 text-left">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
                        <input type="text" name="name" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm text-slate-800" value="{{ $category->name }}" required>
                    </div>
                </div>
                
                <div class="bg-slate-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 rounded-b-3xl">
                    <button type="button" onclick="closeModal('editModal{{ $category->id }}')" class="w-full inline-flex justify-center rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-200 hover:bg-slate-50 sm:w-auto transition-all">Batal</button>
                    <button type="submit" class="w-full inline-flex justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 hover:shadow sm:w-auto transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    // Konfirmasi Hapus
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.form-delete');
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Kategori yang dihapus tidak dapat dikembalikan!",
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