@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-extrabold text-[10px] sm:text-xs uppercase tracking-widest mb-4 border border-blue-100 shadow-sm">
            <i class="fas fa-shield-alt"></i> Keamanan & Privasi
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-4">
            Kebijakan Privasi <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-600">Eventama</span>
        </h1>
        <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto">
            Kami berkomitmen penuh untuk melindungi privasi dan data pribadi Anda. Halaman ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.
        </p>
    </div>

    <!-- Main Content: Privacy Policy Details -->
    <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-xl border border-slate-100 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute -top-20 -right-20 w-48 h-48 bg-blue-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-56 h-56 bg-cyan-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

        <div class="relative z-10 prose prose-slate max-w-none">
            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">1. Informasi yang Kami Kumpulkan</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Saat Anda menggunakan platform Eventama, kami dapat mengumpulkan berbagai jenis informasi, antara lain:
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li><strong>Informasi Profil:</strong> Nama lengkap, alamat email, nomor telepon, dan data demografis yang Anda berikan saat mendaftar.</li>
                <li><strong>Data Transaksi:</strong> Rincian pembelian tiket, riwayat transaksi, dan metode pembayaran (kami tidak menyimpan data kartu kredit secara langsung; proses tersebut ditangani oleh gateway pembayaran pihak ketiga yang aman).</li>
                <li><strong>Data Teknis:</strong> Alamat IP, jenis peramban (browser), sistem operasi, dan data analitik penggunaan website.</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">2. Penggunaan Informasi</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Data yang telah dikumpulkan akan kami gunakan untuk berbagai keperluan, termasuk namun tidak terbatas pada:
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li>Memproses pendaftaran akun, pemesanan tiket, dan layanan terkait event.</li>
                <li>Meningkatkan kualitas layanan dan fungsionalitas platform Eventama.</li>
                <li>Mengirimkan notifikasi penting seperti konfirmasi tiket, jadwal event, dan pembaruan sistem.</li>
                <li>Keperluan pemasaran dan promosi event, apabila Anda telah memberikan persetujuan (opt-in).</li>
                <li>Mendeteksi, mencegah, dan menangani masalah teknis maupun tindakan kecurangan (fraud).</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">3. Pembagian Informasi ke Pihak Ketiga</h2>
            <p class="text-slate-600 leading-relaxed mb-6">
                Kami sangat menjaga kerahasiaan data Anda. Kami tidak akan menjual atau menyewakan informasi pribadi Anda kepada pihak ketiga. Namun, kami dapat membagikan informasi Anda kepada:
            </p>
            <ul class="list-disc pl-5 text-slate-600 space-y-2 mb-8">
                <li><strong>Penyelenggara Event (Mitra):</strong> Untuk keperluan absensi dan pengelolaan peserta saat event berlangsung.</li>
                <li><strong>Penyedia Layanan:</strong> Seperti payment gateway atau layanan email blast yang beroperasi di bawah perjanjian kerahasiaan yang ketat.</li>
                <li><strong>Penegak Hukum:</strong> Apabila diwajibkan oleh undang-undang atau peraturan pemerintah yang berlaku di Indonesia.</li>
            </ul>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">4. Keamanan Data Anda</h2>
            <p class="text-slate-600 leading-relaxed mb-8">
                Eventama menerapkan langkah-langkah teknis dan administratif yang dirancang untuk melindungi informasi pribadi Anda dari akses yang tidak sah, pencurian, atau modifikasi. Kami menggunakan enkripsi SSL (Secure Socket Layer) untuk mengamankan transmisi data sensitif di internet.
            </p>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">5. Hak Pengguna (Kontrol Data)</h2>
            <p class="text-slate-600 leading-relaxed mb-8">
                Sebagai pengguna, Anda memiliki hak penuh untuk mengakses, memperbarui, atau meminta penghapusan data pribadi Anda yang ada di sistem kami. Anda juga dapat memilih untuk berhenti menerima email promosi melalui tautan 'unsubscribe' pada bagian bawah email kami. Untuk permintaan penghapusan akun, Anda dapat menghubungi tim dukungan kami.
            </p>

            <h2 class="text-2xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">6. Perubahan Kebijakan Privasi</h2>
            <p class="text-slate-600 leading-relaxed mb-8">
                Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Setiap perubahan signifikan akan kami informasikan melalui email atau melalui pengumuman yang mencolok di platform kami. Penggunaan berkelanjutan Anda atas layanan kami setelah perubahan tersebut berlaku menunjukkan bahwa Anda menyetujui kebijakan privasi yang telah direvisi.
            </p>
        </div>
    </div>

    <!-- Contact Support Section -->
    <div class="mt-12 glass p-8 rounded-[2rem] shadow-xl border border-slate-200/60 text-center">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Pertanyaan Seputar Privasi?</h3>
        <p class="text-slate-600 leading-relaxed mb-6 max-w-xl mx-auto">
            Jika Anda memiliki pertanyaan lebih lanjut mengenai bagaimana kami mengelola data Anda, jangan ragu untuk menghubungi Data Protection Officer kami.
        </p>
        <div class="flex justify-center">
            <a href="mailto:privacy@amikomevent.id" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-slate-700 border border-slate-200 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all duration-300">
                <i class="fas fa-envelope text-blue-500"></i> Hubungi DPO Kami
            </a>
        </div>
    </div>
</div>
@endsection
