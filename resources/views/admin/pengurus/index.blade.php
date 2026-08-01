@extends('layouts.admin')
@section('title', 'Kelola Pengurus - Admin')
@section('page_title', 'Kelola Pengurus')
@section('page_subtitle', 'Kelola data pengurus untuk organisasi Anda.')

@section('content')

<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
    <div class="p-6 md:p-8 border-b bg-white flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="font-black text-xl text-slate-800">Daftar Pengurus</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Kelola data pengurus organisasi Anda</p>
            </div>
            
            <a href="{{ route('admin.pengurus.create') }}" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-sm hover:shadow-md hover:-translate-y-0.5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pengurus Baru
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead class="bg-slate-50/80 text-slate-500 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg text-center w-16">No</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Jabatan</th>
                    <th class="px-6 py-4">Gaji (Salary)</th>
                    <th class="px-6 py-4 text-center rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t border-slate-100">
                @forelse ($penguruses as $index => $pengurus)
                <tr class="hover:bg-slate-50/80 transition duration-200">
                    <td class="px-6 py-4 text-center">
                        <span class="text-sm font-bold text-slate-400">{{ $penguruses->firstItem() + $index }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-sm text-slate-800">{{ $pengurus->name }}</p>
                        @if($pengurus->description)
                            <p class="text-xs text-slate-400 mt-1 line-clamp-1" title="{{ $pengurus->description }}">{{ $pengurus->description }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-indigo-50 text-indigo-600 border border-indigo-100">
                            {{ $pengurus->jabatan->name ?? 'Tidak Ada' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <p class="font-black text-emerald-600">Rp {{ number_format($pengurus->salary, 0, ',', '.') }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.pengurus.edit', $pengurus->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition shadow-sm hover:shadow" title="Edit Pengurus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.pengurus.destroy', $pengurus->id) }}" method="POST" class="inline-block form-delete">
                                @csrf @method('DELETE')
                                <button type="button" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm hover:shadow btn-delete" title="Hapus Pengurus">
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
                            <svg class="w-10 h-10 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <p class="font-bold text-slate-500">Belum ada data pengurus.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($penguruses->hasPages())
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
        {{ $penguruses->links() }}
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
                title: 'Hapus Pengurus?',
                text: "Data pengurus akan dihapus secara permanen!",
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