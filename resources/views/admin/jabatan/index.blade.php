@extends('layouts.admin')
@section('page_title', 'Kelola Jabatan')

@section('content')
<div class="mb-4 text-right">
    <a href="{{ route('admin.jabatan.create') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">+ Tambah Jabatan</a>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
            <tr>
                <th class="px-8 py-4">ID</th>
                <th class="px-8 py-4">Nama Jabatan</th>
                <th class="px-8 py-4">Dibuat Oleh</th>
                <th class="px-8 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y border-t">
            @forelse ($jabatans as $jabatan)
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-8 py-6 font-bold text-slate-400">{{ $jabatan->id }}</td>
                <td class="px-8 py-6 font-black text-slate-800">{{ $jabatan->name }}</td>
                <td class="px-8 py-6 text-sm text-slate-500">{{ $jabatan->created_by ?? '-' }}</td>
                <td class="px-8 py-6 flex gap-2">
                    <a href="{{ route('admin.jabatan.edit', $jabatan->id) }}" class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">Edit</a>
                    <form action="{{ route('admin.jabatan.destroy', $jabatan->id) }}" method="POST" onsubmit="return confirm('Hapus jabatan ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-8 py-10 text-center text-slate-500">Belum ada data jabatan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection