@extends('layouts.admin')

@section('content')

    <section class="flex-1 p-10 overflow-y-auto bg-slate-50 min-h-screen">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-900">Kategori Event</h1>
                <p class="text-slate-500 font-medium mt-1">Kelola jenis-jenis event yang tersedia di platform.</p>
            </div>
            
            <!-- Tombol Tambah -->
            <button class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Kategori
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/80 text-slate-500 text-xs font-bold uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">1</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-base group-hover:text-indigo-600 transition-colors">Seminar</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <!-- Tombol Edit -->
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-bold hover:bg-indigo-600 hover:text-white transition-colors">
                                        Edit
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <button class="px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg text-sm font-bold hover:bg-rose-600 hover:text-white transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">2</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-base group-hover:text-indigo-600 transition-colors">Konser Musik</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-bold hover:bg-indigo-600 hover:text-white transition-colors">
                                        Edit
                                    </button>
                                    <button class="px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg text-sm font-bold hover:bg-rose-600 hover:text-white transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">3</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-base group-hover:text-indigo-600 transition-colors">Workshop & Pelatihan</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-bold hover:bg-indigo-600 hover:text-white transition-colors">
                                        Edit
                                    </button>
                                    <button class="px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg text-sm font-bold hover:bg-rose-600 hover:text-white transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">4</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-base group-hover:text-indigo-600 transition-colors">Kompetisi & Lomba</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <button class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-bold hover:bg-indigo-600 hover:text-white transition-colors">
                                        Edit
                                    </button>
                                    <button class="px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg text-sm font-bold hover:bg-rose-600 hover:text-white transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <!-- Footer / Pagination (Opsional) -->
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50 text-sm text-slate-500 flex justify-between items-center">
                <p>Menampilkan 4 dari 4 kategori</p>
            </div>
        </div>
    </section>

@endsection