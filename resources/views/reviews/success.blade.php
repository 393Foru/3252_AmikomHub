@extends('layouts.app')

@section('content')
<!-- Decorative background -->
<div class="fixed inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50 z-[-1]"></div>
<div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3 w-96 h-96 bg-indigo-300/20 rounded-full blur-3xl pointer-events-none"></div>
<div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3 w-[30rem] h-[30rem] bg-purple-300/20 rounded-full blur-3xl pointer-events-none"></div>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-32 text-center relative z-10">
    <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-indigo-200/50 border border-white p-10 md:p-16 relative overflow-hidden">
        
        <!-- Background elements inside card -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-emerald-50 to-transparent pointer-events-none"></div>

        <div class="relative">
            <div class="w-28 h-28 mx-auto bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-white mb-8 shadow-xl shadow-emerald-200/50 transform hover:scale-110 transition-transform duration-500">
                <i class="fas fa-check text-5xl"></i>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tight">Ulasan Berhasil Dikirim!</h1>
            
            <p class="text-slate-500 text-lg mb-10 leading-relaxed font-medium">
                {{ isset($message) ? $message : 'Terima kasih atas ulasan dan penilaian Anda. Masukan Anda sangat berharga bagi penyelenggara untuk terus menjadi lebih baik!' }}
            </p>
            
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-full font-bold text-lg hover:bg-indigo-600 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                <i class="fas fa-home group-hover:-translate-y-0.5 transition-transform"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
