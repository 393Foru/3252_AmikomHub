@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 pt-16 pb-24">
    
    <div class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-600 border border-indigo-100 font-bold text-xs uppercase tracking-widest mb-6 shadow-sm">
            Panduan Lengkap
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">
            Cara Pesan Tiket
        </h1>
        <p class="text-slate-500 font-medium text-lg max-w-2xl mx-auto">
            Hanya butuh beberapa menit untuk mengamankan kursimu di event favorit. Ikuti 4 langkah mudah berikut ini.
        </p>
    </div>

    <div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
        
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-600 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 font-black z-10">
                1
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-xl text-slate-900 mb-2">Pilih Event Favoritmu</h3>
                <p class="text-slate-500 leading-relaxed">Jelajahi halaman beranda atau katalog event. Gunakan filter kategori untuk menemukan seminar atau workshop yang paling sesuai dengan minatmu.</p>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-600 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 font-black z-10">
                2
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-xl text-slate-900 mb-2">Masuk atau Daftar Akun</h3>
                <p class="text-slate-500 leading-relaxed">Untuk melanjutkan pemesanan, pastikan kamu sudah mendaftar dan masuk (login) ke dalam sistem AmikomEventHub agar tiketmu tersimpan dengan aman.</p>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-600 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 font-black z-10">
                3
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-xl text-slate-900 mb-2">Checkout & Pembayaran</h3>
                <p class="text-slate-500 leading-relaxed">Klik tombol "Beli Tiket" pada detail event. Periksa kembali pesananmu, lalu selesaikan pembayaran sesuai dengan metode yang diinstruksikan.</p>
            </div>
        </div>

        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-600 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 font-black z-10">
                4
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="font-bold text-xl text-slate-900 mb-2">Tiket Berhasil Didapatkan</h3>
                <p class="text-slate-500 leading-relaxed">Selamat! Tiketmu akan langsung masuk ke menu "Tiket Saya". Tunjukkan QR Code atau detail tiket tersebut kepada panitia saat acara berlangsung.</p>
            </div>
        </div>

    </div>

    <div class="mt-16 text-center">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-indigo-600 text-white font-bold rounded-full shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:scale-105 transition-all duration-300">
            Mulai Cari Event Sekarang
        </a>
    </div>

</div>
@endsection