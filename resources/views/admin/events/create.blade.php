@extends('layouts.admin')
@section('title', 'Tambah Event Baru - Admin')
@section('page_title', 'Tambah Event Baru')
@section('page_subtitle', 'Masukkan detail acara baru yang akan diselenggarakan.')

@section('content')
<div class="bg-white p-8 md:p-10 rounded-3xl border border-slate-100 shadow-sm max-w-3xl mx-auto">
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Judul Event</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" placeholder="Misal: Seminar Nasional Teknologi 2026" required>
            @error('title') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori</label>
            <select name="category_id" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800 appearance-none cursor-pointer" required>
                <option value="">Pilih Kategori...</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" placeholder="Tuliskan detail mengenai event ini...">{{ old('description') }}</textarea>
            @error('description') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Tanggal & Waktu</label>
                <input type="datetime-local" name="date" value="{{ old('date') }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800 cursor-pointer" required>
                @error('date') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" placeholder="Contoh: Ruang Citra 1" required>
                @error('location') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', 0) }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" required min="0">
                <p class="text-xs text-slate-400 mt-2">Biarkan 0 jika event gratis.</p>
                @error('price') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Kapasitas (Stok)</label>
                <input type="number" name="stock" value="{{ old('stock', 1) }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800" required min="1">
                @error('stock') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Poster Event (Opsional)</label>
                <input type="file" name="poster" accept="image/*" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition font-medium text-slate-800 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer">
                @error('poster') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Fitur E-Certificate</label>
                <label class="inline-flex items-center mt-3 cursor-pointer">
                    <input type="checkbox" name="has_certificate" value="1" class="w-5 h-5 text-indigo-600 bg-slate-100 border-slate-300 rounded focus:ring-indigo-500 focus:ring-2" {{ old('has_certificate') ? 'checked' : '' }}>
                    <span class="ml-3 text-slate-700 font-medium">Aktifkan E-Certificate Otomatis</span>
                </label>
                <p class="text-xs text-slate-400 mt-1">Sertifikat akan dikirim ke email peserta setelah check-in tiket.</p>
                @error('has_certificate') <span class="text-rose-500 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pt-6 mt-6 flex justify-end gap-3 border-t border-slate-100">
            <a href="{{ route('admin.events.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 hover:text-slate-800 transition shadow-sm">Batal</a>
            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-sm hover:shadow-md hover:-translate-y-0.5">Simpan Event</button>
        </div>
    </form>
</div>
@endsection