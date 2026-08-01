@extends('layouts.admin')
@section('title', 'Tambah Pengurus - Admin')
@section('page_title', 'Tambah Pengurus Baru')
@section('page_subtitle', 'Masukkan data pengurus baru untuk organisasi Anda.')

@section('content')
<div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-sm max-w-3xl mx-auto">
    <form action="{{ route('admin.pengurus.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" placeholder="Masukkan nama pengurus..." required>
            @error('name') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Jabatan</label>
                <select name="jabatan_id" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800 appearance-none cursor-pointer" required>
                    <option value="">Pilih Jabatan...</option>
                    @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}" {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                            {{ $jabatan->name }}
                        </option>
                    @endforeach
                </select>
                @error('jabatan_id') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Gaji / Salary (Rp)</label>
                <input type="number" name="salary" value="{{ old('salary', 0) }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" required min="0">
                @error('salary') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi Tugas</label>
            <textarea name="description" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" placeholder="Tugas dan tanggung jawab (opsional)...">{{ old('description') }}</textarea>
            @error('description') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
        </div>
        
        <div class="pt-6 mt-6 flex justify-end gap-3 border-t border-slate-100">
            <a href="{{ route('admin.pengurus.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 hover:text-slate-800 transition shadow-sm">Batal</a>
            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-sm hover:shadow-md hover:-translate-y-0.5">Simpan Pengurus</button>
        </div>
    </form>
</div>
@endsection