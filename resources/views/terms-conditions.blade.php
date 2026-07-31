@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-6 pb-2">
    <x-breadcrumb :items="[
        ['label' => 'Syarat & Ketentuan']
    ]" />
</div>
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] sm:text-xs uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
            <i class="fas fa-file-contract"></i> Syarat & Ketentuan
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
            Syarat dan Ketentuan <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Eventama</span>
        </h1>
        <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto">
            Harap baca dengan saksama. Dengan mengakses dan menggunakan layanan Eventama, Anda menyetujui seluruh syarat dan ketentuan yang berlaku.
        </p>
    </div>

    <!-- Main Content: Terms and Conditions Details -->
    <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-xl border border-slate-100 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute -top-20 -right-20 w-48 h-48 bg-blue-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-56 h-56 bg-cyan-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

        <div class="relative z-10 prose prose-slate max-w-none">
            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">1. Pendahuluan</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Selamat datang di Eventama. Dokumen ini mengatur syarat dan ketentuan penggunaan platform kami (website dan aplikasi) beserta seluruh layanan yang disediakan oleh Eventama. Dengan mendaftar, mengakses, atau menggunakan layanan kami, Anda dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan yang tercantum di bawah ini.
            </p>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">2. Pendaftaran dan Akun</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Untuk menggunakan beberapa fitur utama, Anda diwajibkan untuk membuat akun.
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li>Anda harus memberikan informasi yang akurat, lengkap, dan terkini saat mendaftar.</li>
                <li>Anda bertanggung jawab penuh untuk menjaga kerahasiaan kata sandi (password) dan keamanan akun Anda.</li>
                <li>Setiap aktivitas yang terjadi di bawah akun Anda adalah tanggung jawab Anda sepenuhnya.</li>
                <li>Eventama berhak menangguhkan atau menghapus akun yang terindikasi melakukan pelanggaran hukum atau syarat dan ketentuan kami.</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">3. Pembelian Tiket dan Pembayaran</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Ketentuan terkait pemesanan dan pembayaran tiket event di platform kami:
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li>Semua harga yang tertera di platform adalah dalam mata uang Rupiah (IDR) dan dapat belum termasuk pajak atau biaya admin dari payment gateway, kecuali dinyatakan lain.</li>
                <li>Tiket hanya sah jika dibeli melalui jalur resmi Eventama. Kami tidak bertanggung jawab atas tiket yang dibeli melalui pihak ketiga yang tidak sah.</li>
                <li>Setelah pembayaran berhasil dikonfirmasi, e-tiket akan dikirimkan ke email terdaftar atau dapat diakses melalui menu riwayat transaksi di dashboard akun Anda.</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">4. Pembatalan dan Pengembalian Dana (Refund)</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Kebijakan pembatalan dan pengembalian dana bervariasi bergantung pada jenis event:
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li><strong>Event Batal/Ditunda:</strong> Jika event dibatalkan oleh penyelenggara, Eventama akan membantu memfasilitasi proses pengembalian dana sesuai kebijakan yang disepakati dengan penyelenggara.</li>
                <li><strong>Pembatalan oleh Pengguna:</strong> Kecuali ditentukan lain secara khusus pada halaman event, tiket yang sudah dibeli umumnya tidak dapat dibatalkan atau dikembalikan (non-refundable).</li>
                <li>Proses refund memakan waktu 7 hingga 14 hari kerja, tergantung metode pembayaran yang digunakan.</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">5. Kewajiban Penyelenggara Event (Mitra)</h2>
            <p class="text-slate-600 leading-relaxed mb-8">
                Bagi Anda yang bertindak sebagai penyelenggara (event creator):
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li>Anda wajib memberikan informasi event yang valid, jelas, dan tidak menyesatkan.</li>
                <li>Anda bertanggung jawab atas kelancaran, keamanan, dan pelaksanaan event yang Anda buat.</li>
                <li>Penyelenggara dilarang membuat event yang mengandung unsur penipuan, kekerasan, SARA, atau melanggar hukum yang berlaku di Indonesia.</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">6. Hak Kekayaan Intelektual</h2>
            <p class="text-slate-600 leading-relaxed mb-8">
                Semua konten di dalam platform Eventama (termasuk logo, desain, teks, grafis, kode sumber, dan perangkat lunak) adalah hak milik intelektual Eventama dan dilindungi oleh undang-undang hak cipta. Pengguna tidak diperkenankan untuk menyalin, mendistribusikan, atau memodifikasi konten tersebut tanpa izin tertulis dari pihak Eventama.
            </p>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">7. Perubahan Syarat dan Ketentuan</h2>
            <p class="text-slate-600 leading-relaxed mb-8">
                Eventama berhak untuk mengubah, memodifikasi, menambah, atau menghapus bagian mana pun dari Syarat dan Ketentuan ini kapan saja. Setiap perubahan akan diunggah ke halaman ini beserta tanggal pembaruan terakhir. Melanjutkan penggunaan platform setelah perubahan tersebut berarti Anda menyetujui versi terbaru dari Syarat dan Ketentuan kami.
            </p>
        </div>
    </div>

    <!-- Contact Support Section -->
    <div class="mt-12 glass p-8 rounded-[2rem] shadow-xl border border-slate-200/60 text-center">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Butuh Bantuan Lebih Lanjut?</h3>
        <p class="text-slate-600 leading-relaxed mb-6 max-w-xl mx-auto">
            Jika Anda memiliki pertanyaan mengenai Syarat dan Ketentuan ini atau layanan kami, tim dukungan (Customer Support) kami siap membantu Anda 24/7.
        </p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="mailto:cs@amikomevent.id" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-slate-700 border border-slate-200 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all duration-300">
                <i class="fas fa-envelope text-blue-500"></i> Email Kami
            </a>
            <a href="{{ route('help-center') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-full font-bold shadow-md shadow-blue-200 hover:bg-blue-700 transition-all duration-300">
                <i class="fas fa-headset"></i> Pusat Bantuan
            </a>
        </div>
    </div>
</div>
@endsection
