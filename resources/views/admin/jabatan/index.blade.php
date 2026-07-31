@extends('layouts.admin')
@section('title', 'Kelola Jabatan - Admin')
@section('page_title', 'Kelola Jabatan')
@section('page_subtitle', 'Kelola daftar jabatan yang ada di sistem.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col mb-8">
    <div class="p-6 md:p-8 border-b bg-white flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="font-black text-xl text-slate-800">Daftar Jabatan</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Kelola semua role atau jabatan</p>
            </div>
            
            <button onclick="toggleForm()" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Jabatan
            </button>
        </div>

        <form action="{{ route('admin.jabatan.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition font-medium text-sm text-slate-800 placeholder-slate-400" placeholder="Cari nama jabatan...">
            </div>
            @if(request('search'))
                <a href="{{ route('admin.jabatan.index') }}" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition flex items-center text-sm">
                    Reset
                </a>
            @endif
        </form>
        @if(request('search'))
            <p class="text-sm text-slate-500">
                Hasil pencarian untuk: <span class="font-bold text-slate-800">"{{ request('search') }}"</span>
            </p>
        @endif
    </div>

    <!-- Form Tambah (Hidden by default) -->
    <div id="formTambah" class="hidden border-b border-slate-100 bg-slate-50/50 p-6 md:p-8 transition-all">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-lg text-slate-800">Tambah Jabatan Baru</h3>
            <button type="button" onclick="toggleForm()" class="text-slate-400 hover:text-slate-600 bg-white p-1.5 rounded-lg border shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="{{ route('admin.jabatan.store') }}" method="POST">
            @csrf
            <div class="flex flex-col md:flex-row gap-4 items-start">
                <div class="flex-1 w-full">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Jabatan</label>
                    <input type="text" name="name" class="w-full rounded-xl border border-slate-200 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium" placeholder="Misal: Ketua Pelaksana, Sekretaris" required>
                </div>
                <div class="w-full md:w-auto mt-7">
                    <button type="submit" class="w-full md:w-auto px-6 py-3 bg-emerald-500 text-white rounded-xl font-bold hover:bg-emerald-600 transition-colors shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Jabatan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg w-16 text-center">ID</th>
                    <th class="px-6 py-4">Nama Jabatan</th>
                    <th class="px-6 py-4">Dibuat Oleh</th>
                    <th class="px-6 py-4 text-center rounded-tr-lg w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t border-slate-100">
                @forelse($jabatans as $index => $jabatan)
                <tr class="hover:bg-slate-50/80 transition duration-200">
                    <td class="px-6 py-4 text-center text-sm font-bold text-slate-400">{{ $jabatan->id }}</td>
                    <td class="px-6 py-4 font-bold text-sm text-slate-800">{{ $jabatan->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $jabatan->created_by ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="openModal('editModal{{ $jabatan->id }}')" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition shadow-sm hover:shadow" title="Edit Jabatan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <form action="{{ route('admin.jabatan.destroy', $jabatan->id) }}" method="POST" class="inline-block form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm hover:shadow btn-delete" title="Hapus Jabatan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-10 h-10 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="font-bold text-slate-500">Belum ada data jabatan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($jabatans->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $jabatans->links() }}
        </div>
        @endif
    </div>
    
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-between items-center text-sm text-slate-500 font-medium">
        <p>Total: <span class="font-bold text-slate-800">{{ $jabatans->total() }}</span> Jabatan</p>
    </div>
</div>

@foreach($jabatans as $jabatan)
<div id="editModal{{ $jabatan->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeModal('editModal{{ $jabatan->id }}')"></div>
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg z-10 border border-slate-100">
            <form action="{{ route('admin.jabatan.update', $jabatan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="bg-white px-6 pb-6 pt-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-slate-800">Edit Jabatan</h3>
                        <button type="button" onclick="closeModal('editModal{{ $jabatan->id }}')" class="text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 p-2 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Jabatan</label>
                            <input type="text" name="name" class="w-full rounded-xl border border-slate-200 px-4 py-3 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium" value="{{ $jabatan->name }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="bg-slate-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-8 border-t border-slate-100 gap-3">
                    <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 hover:-translate-y-0.5 transition-all sm:ml-3 sm:w-auto">Simpan Perubahan</button>
                    <button type="button" onclick="closeModal('editModal{{ $jabatan->id }}')" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-200 hover:bg-slate-50 transition-all sm:mt-0 sm:w-auto">Batal</button>
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
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }
    function toggleForm() { document.getElementById('formTambah').classList.toggle('hidden'); }

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.form-delete');
            Swal.fire({
                title: 'Hapus Jabatan?',
                text: "Data jabatan akan dihapus secara permanen!",
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