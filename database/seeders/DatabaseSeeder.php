<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // 1. akun admin utama (Super Admin)
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 1. akun user biasa
        \App\Models\User::create([
            'name' => 'User Biasa',
            'email' => 'user@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 1.b Akun User Biasa (Tambahan 20 User)
        for ($i = 0; $i < 20; $i++) {
            \App\Models\User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'role' => 'user',
            ]);
        }

        // 2. insert kategori event
        $categories = [
            \App\Models\Category::create(['name' => 'seminar IT', 'slug' => 'seminar-it']),
            \App\Models\Category::firstOrCreate(['name' => 'Entertaiment', 'slug' => 'entertaiment']),
            \App\Models\Category::firstOrCreate(['name' => 'Workshop', 'slug' => 'workshop']),
            \App\Models\Category::firstOrCreate(['name' => 'lomba IT', 'slug' => 'lomba-it']),
            \App\Models\Category::firstOrCreate(['name' => 'sosialisasi', 'slug' => 'sosialisasi']),
            \App\Models\Category::firstOrCreate(['name' => 'job fair', 'slug' => 'job-fair']),
            \App\Models\Category::firstOrCreate(['name' => 'pameran', 'slug' => 'pameran']),
            \App\Models\Category::firstOrCreate(['name' => 'lainnya', 'slug' => 'lainnya']),
        ];

        // 3. insert Partner (Total 10 Partners)
        $partners = [
            \App\Models\Partner::create(['name' => 'TechCorp', 'logo_url' => 'partners/techcorp.png']),
            \App\Models\Partner::create(['name' => 'EduMedia', 'logo_url' => 'partners/edumedia.png']),
            \App\Models\Partner::create(['name' => 'GoTix', 'logo_url' => 'partners/gotix.png']),
            \App\Models\Partner::create(['name' => 'Dicoding Indonesia', 'logo_url' => 'partners/dicoding.png']),
            \App\Models\Partner::create(['name' => 'Disnaker Yogyakarta', 'logo_url' => 'partners/disnaker.png']),
            \App\Models\Partner::create(['name' => 'BEM Amikom', 'logo_url' => 'partners/bem-amikom.png']),
            \App\Models\Partner::create(['name' => 'Asus ROG', 'logo_url' => 'partners/asus-rog.png']),
            \App\Models\Partner::create(['name' => 'Tokopedia', 'logo_url' => 'partners/tokopedia.png']),
            \App\Models\Partner::create(['name' => 'Gojek', 'logo_url' => 'partners/gojek.png']),
            \App\Models\Partner::create(['name' => 'Bank Mandiri', 'logo_url' => 'partners/bank-mandiri.png']),
        ];

        // 4. Akun Admin Partner (Satu Partner = Satu Akun Admin)
        foreach ($partners as $partner) {
            \App\Models\User::create([
                'name' => 'Admin ' . $partner->name,
                'email' => strtolower(str_replace(' ', '', $partner->name)) . '@partner.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'partner_id' => $partner->id,
            ]);
        }

        // 5. insert Jabatan
        $jabatans = [
            \App\Models\Jabatan::create(['name' => 'Ketua Pelaksana', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
            \App\Models\Jabatan::create(['name' => 'Sekretaris', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
            \App\Models\Jabatan::create(['name' => 'Bendahara', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
            \App\Models\Jabatan::create(['name' => 'Koordinator Acara', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
            \App\Models\Jabatan::create(['name' => 'Humas & Sponsorship', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
            \App\Models\Jabatan::create(['name' => 'Koor Pubdok', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
            \App\Models\Jabatan::create(['name' => 'Koor Keamanan', 'created_by' => 'Admin Amikom', 'updated_by' => 'Admin Amikom']),
        ];

        // 6. insert Pengurus (Variasi Jabatan untuk 10 Partner)
        $pengurusConfig = [
            ['partner' => $partners[0], 'jabatans' => [$jabatans[0], $jabatans[1], $jabatans[3], $jabatans[4]]],
            ['partner' => $partners[1], 'jabatans' => [$jabatans[0], $jabatans[2]]],
            ['partner' => $partners[2], 'jabatans' => [$jabatans[0], $jabatans[2], $jabatans[4], $jabatans[6]]],
            ['partner' => $partners[3], 'jabatans' => [$jabatans[0], $jabatans[1], $jabatans[3]]],
            ['partner' => $partners[4], 'jabatans' => [$jabatans[0], $jabatans[1], $jabatans[2], $jabatans[4]]],
            ['partner' => $partners[5], 'jabatans' => [$jabatans[0], $jabatans[1], $jabatans[2], $jabatans[3], $jabatans[5]]],
            ['partner' => $partners[6], 'jabatans' => [$jabatans[0], $jabatans[4], $jabatans[6]]],
            ['partner' => $partners[7], 'jabatans' => [$jabatans[0], $jabatans[1], $jabatans[2], $jabatans[4], $jabatans[5]]],
            ['partner' => $partners[8], 'jabatans' => [$jabatans[0], $jabatans[3], $jabatans[4], $jabatans[6]]],
            ['partner' => $partners[9], 'jabatans' => [$jabatans[0], $jabatans[2], $jabatans[4]]],
        ];

        foreach ($pengurusConfig as $config) {
            $partner = $config['partner'];
            foreach ($config['jabatans'] as $idx => $jab) {
                \App\Models\Pengurus::create([
                    'partner_id' => $partner->id,
                    'jabatan_id' => $jab->id,
                    'name' => $faker->name,
                    'description' => $jab->name . ' ' . $partner->name,
                    'salary' => 5000000.00 - ($idx * 400000), 
                    'created_by' => 'Admin ' . $partner->name,
                    'updated_by' => 'Admin ' . $partner->name
                ]);
            }
        }

        // 7. insert sampel events (5 Event per kategori = 40 Events)
        $eventsData = [
            'seminar-it' => [
                ['AI & Future Tech Summit 2026', 'Membahas tren masa depan AI, Machine Learning, dan implementasinya di industri.'],
                ['Web3 & Blockchain Introduction', 'Pahami konsep dasar blockchain dan revolusi Web3 di sektor finansial.'],
                ['Cyber Security Awareness', 'Menangkal serangan siber di era digital bersama pakar keamanan IT.'],
                ['Cloud Computing Masterclass', 'Belajar arsitektur cloud AWS dan Google Cloud dari nol hingga mahir.'],
                ['Data Science & Big Data Analytics', 'Seminar tentang bagaimana data science merombak strategi bisnis masa kini.'],
            ],
            'entertaiment' => [
                ['Jazz Night 2026', 'Malam syahdu dengan alunan musik Jazz klasik dan modern bersama musisi lokal berbakat Yogyakarta.'],
                ['Standup Comedy Campus Tour', 'Malam penuh tawa bersama komika-komika nasional.'],
                ['E-Sports Amikom Cup (MLBB)', 'Turnamen Mobile Legends terbesar antar mahasiswa se-Yogyakarta.'],
                ['Konser Akhir Tahun BEM Amikom', 'Festival musik penutup tahun menampilkan band-band indie lokal.'],
                ['Akustik Senja', 'Menikmati kopi dan musik akustik di taman kampus.'],
            ],
            'workshop' => [
                ['Workshop Flutter Masterclass', 'Pelajari cara membangun aplikasi mobile multi-platform dalam 1 hari penuh.'],
                ['UI/UX Prototyping with Figma', 'Praktik langsung membuat wireframe dan prototipe aplikasi yang user-friendly.'],
                ['Dasar-Dasar React JS', 'Workshop intensif untuk pemula belajar frontend web dengan React.'],
                ['Fotografi Produk Menggunakan Smartphone', 'Teknik pencahayaan dan editing foto produk hanya dengan HP.'],
                ['Video Editing dengan Premiere Pro', 'Dari pemula jadi pro! Workshop editing video untuk konten kreator.'],
            ],
            'lomba-it' => [
                ['Hackathon 2026: Unleash Your Inner Developer', 'Kompetisi coding 24 jam non-stop! Pecahkan masalah nyata dengan solusi digital kreatif.'],
                ['Lomba Desain UI/UX Tingkat Nasional 2026', 'Tantang kreativitasmu! Buat desain antarmuka paling intuitif.'],
                ['Capture The Flag (CTF) Cybersecurity', 'Lomba peretasan etis tingkat mahasiswa nasional.'],
                ['Web Programming Competition', 'Adu cepat dan tepat membuat website e-commerce dalam waktu 12 jam.'],
                ['Ideation Pitching Competition', 'Lomba adu ide bisnis startup teknologi.'],
            ],
            'sosialisasi' => [
                ['Sosialisasi Program Magang MSIB Batch 8', 'Kupas tuntas tips lolos seleksi magang bersertifikat dan peluang karir.'],
                ['Sosialisasi Beasiswa LPDP', 'Persiapan dokumen, wawancara, dan strategi lolos beasiswa LPDP.'],
                ['Sosialisasi Kampus Merdeka', 'Penjelasan program pertukaran mahasiswa merdeka dan studi independen.'],
                ['Pengenalan Program Kreativitas Mahasiswa (PKM)', 'Tips dan trik membuat proposal PKM yang didanai Dikti.'],
                ['Sosialisasi Keselamatan Berkendara', 'Pentingnya safety riding untuk mahasiswa di jalan raya.'],
            ],
            'job-fair' => [
                ['Amikom Career & Tech Expo 2026', 'Temukan puluhan perusahaan teknologi terkemuka yang sedang membuka lowongan.'],
                ['Startup Job Fair Yogyakarta', 'Bursa kerja khusus startup dan perusahaan rintisan teknologi.'],
                ['Bursa Kerja Khusus (BKK) IT', 'Rekrutmen langsung oleh mitra industri IT lokal dan nasional.'],
                ['Virtual Career Fair 2026', 'Job fair daring yang bisa diikuti dari mana saja.'],
                ['BUMN Career Opportunity', 'Peluang karir dan management trainee di perusahaan BUMN.'],
            ],
            'pameran' => [
                ['InnoTech Expo 2026', 'Pameran startup dan inovasi teknologi karya mahasiswa se-Yogyakarta.'],
                ['Pameran Karya Seni Mahasiswa', 'Menampilkan karya desain grafis, animasi, dan seni rupa mahasiswa.'],
                ['Hardware & Gadget Show', 'Pameran perangkat keras terbaru dan inovasi gadget masa depan.'],
                ['Amikom Startup Expo', 'Showcase produk-produk inovatif dari inkubator bisnis Amikom.'],
                ['Pameran Fotografi: "Wajah Jogja"', 'Kumpulan foto dokumenter jalanan kota Yogyakarta.'],
            ],
            'lainnya' => [
                ['Aksi Donor Darah Mahasiswa IT', 'Setetes darahmu menyelamatkan nyawa mereka. Mari berpartisipasi.'],
                ['Bakti Sosial Panti Asuhan', 'Berbagi kebahagiaan dan ilmu komputer dasar di panti asuhan.'],
                ['Kunjungan Industri ke Jakarta', 'Field trip mengunjungi kantor pusat startup unicorn Indonesia.'],
                ['Fun Bike & Senam Pagi', 'Olahraga santai akhir pekan bersama seluruh civitas akademika.'],
                ['Pengajian Akbar Kampus', 'Tabligh akbar menyambut bulan suci Ramadhan.'],
            ],
        ];

        $eventFirst = null;
        $eventCount = 1;

        foreach ($categories as $cat) {
            $slug = $cat->slug;
            $items = $eventsData[$slug];

            foreach ($items as $idx => $item) {
                // Pilih partner secara acak (1 hingga 10)
                $partner = $partners[array_rand($partners)];
                
                // Set tanggal bervariasi (beberapa di masa lalu, sebagian besar masa depan)
                // Set tanggal bervariasi (beberapa di masa lalu, sebagian besar masa depan)
                $daysOffset = $eventCount % 2 == 0 ? $faker->numberBetween(10, 60) : -$faker->numberBetween(10, 60);
                $eventDate = Carbon::now()->addDays($daysOffset);
                
                // Sesuaikan jam berdasarkan kategori event
                if ($slug === 'entertaiment') {
                    $eventDate->setTime($faker->randomElement([18, 19, 20]), $faker->randomElement([0, 30]), 0);
                } elseif ($slug === 'lomba-it') {
                    $eventDate->setTime($faker->randomElement([7, 8]), $faker->randomElement([0, 30]), 0);
                } elseif ($slug === 'job-fair' || $slug === 'pameran') {
                    $eventDate->setTime($faker->randomElement([8, 9, 10]), $faker->randomElement([0, 30]), 0);
                } else {
                    $eventDate->setTime($faker->randomElement([8, 9, 13, 14]), $faker->randomElement([0, 30]), 0);
                }
                $date = $eventDate->format('Y-m-d H:i:s');
                
                // Variasi harga dan stok
                $isFree = $faker->boolean(20); // 20% kemungkinan gratis
                $price = $isFree ? 0 : $faker->randomElement([25000, 50000, 75000, 100000, 150000]);
                $stock = $faker->randomElement([0, 5, 8, 15, 50, 100, 200]);
                
                // Tentukan poster path (menggunakan 40 gambar dari user)
                $posterNum = $eventCount; // 1 to 40
                $ext = in_array($posterNum, [1, 2, 3]) ? 'png' : 'jpg';
                $posterPath = 'posters/event-' . $posterNum . '.' . $ext;

                // Tentukan rundown berdasarkan kategori
                $rundown = "";
                if ($slug === 'seminar-it') {
                    $rundown = "<li>08:00 - Registrasi & Pembukaan</li><li>09:30 - Sesi Materi Utama</li><li>12:00 - Ishoma</li><li>13:00 - Sesi Praktik / Diskusi</li><li>15:30 - Penutup & Doorprize</li>";
                } elseif ($slug === 'entertaiment') {
                    $rundown = "<li>18:30 - Open Gate</li><li>19:00 - Pembukaan & Penampilan Pembuka</li><li>20:30 - Penampilan Utama (Guest Star)</li><li>22:30 - Sesi Foto Bersama</li><li>23:00 - Penutupan</li>";
                } elseif ($slug === 'workshop') {
                    $rundown = "<li>08:00 - Registrasi Peserta</li><li>09:00 - Sesi Teori Dasar</li><li>11:30 - Ishoma</li><li>13:00 - Sesi Praktik (Hands-on)</li><li>16:00 - Evaluasi & Sertifikasi</li>";
                } elseif ($slug === 'lomba-it') {
                    $rundown = "<li>07:00 - Registrasi Tim</li><li>08:00 - Technical Meeting & Briefing</li><li>09:00 - Sesi Kompetisi Dimulai</li><li>15:00 - Penjurian & Presentasi Karya</li><li>17:00 - Pengumuman Pemenang</li>";
                } elseif ($slug === 'sosialisasi') {
                    $rundown = "<li>08:30 - Registrasi Kehadiran</li><li>09:00 - Sambutan Pihak Penyelenggara</li><li>09:30 - Sesi Pemaparan Materi</li><li>11:00 - Sesi Tanya Jawab (Q&A)</li><li>12:00 - Penutupan</li>";
                } elseif ($slug === 'job-fair') {
                    $rundown = "<li>08:00 - Open Gate & Registrasi</li><li>09:00 - Walk-in Interview & Drop CV</li><li>11:00 - Company Talkshow 1</li><li>13:30 - Company Talkshow 2</li><li>16:30 - Penutupan Acara</li>";
                } elseif ($slug === 'pameran') {
                    $rundown = "<li>09:00 - Pembukaan Pameran</li><li>10:00 - Sesi Live Demo Inovasi</li><li>12:00 - Istirahat</li><li>13:30 - Sesi Kunjungan Interaktif</li><li>17:00 - Penutupan & Awarding Stand Terbaik</li>";
                } else {
                    $rundown = "<li>08:00 - Registrasi Ulang</li><li>09:00 - Pelaksanaan Acara Utama</li><li>12:00 - Ishoma</li><li>13:00 - Lanjutan Acara</li><li>15:00 - Penutupan</li>";
                }

                $createdEvent = \App\Models\Event::create([
                    'category_id' => $cat->id,
                    'partner_id' => $partner->id,
                    'title' => $item[0],
                    'description' => "<p><strong>" . $item[1] . "</strong></p>" .
                                     "<p>" . $faker->paragraph(3) . "</p>" .
                                     "<h3>Rundown Acara:</h3>" .
                                     "<ul>" . $rundown . "</ul>" .
                                     "<h3>Syarat & Ketentuan:</h3>" .
                                     "<p>1. Tiket yang sudah dibeli tidak dapat dikembalikan.<br>2. Harap hadir 30 menit sebelum acara dimulai.<br>3. Wajib membawa e-tiket (QR Code) saat registrasi ulang.</p>",
                    'date' => $date,
                    'location' => $faker->randomElement(['Cinema Unit 6', 'Inkubator Amikom', 'Pendopo Amikom', 'Lab Komputer 4', 'Basement Amikom', 'Ruang Citra 1', 'Auditorium', 'Gedung BSC']),
                    'price' => $price,
                    'stock' => $stock,
                    'poster_path' => $posterPath,
                ]);

                // Tambahkan 1-2 sponsor (partner lain) secara acak (exclude pemilik)
                $sponsorCount = $faker->numberBetween(0, 2);
                if ($sponsorCount > 0) {
                    $sponsors = collect($partners)->reject(fn($p) => $p->id === $partner->id)->random($sponsorCount)->pluck('id')->toArray();
                    $createdEvent->partners()->attach($sponsors);
                }

                if ($eventCount === 1) {
                    $eventFirst = $createdEvent;
                }

                $eventCount++;
            }
        }

        // 8. insert Transaction (Minimal 11 transaksi bervariatif per event)
        $events = \App\Models\Event::all();
        $regularUsers = \App\Models\User::where('role', 'user')->get();
        
        foreach ($events as $event) {
            // Random minimal 12 hingga 25 transaksi per event
            $numTransactions = $faker->numberBetween(12, 25);
            
            for ($i = 0; $i < $numTransactions; $i++) {
                $randomUser = $regularUsers->random();

                // Probabilitas status transaksi agar realistis (Mayoritas Success)
                $status = $faker->randomElement([
                    'Success', 'Success', 'Success', 'Success', 'Success', 'Success', 'Success', 
                    'Pending', 'Pending', 'Cancelled', 'Failed'
                ]);

                // Kurangi stok jika sukses, atau ubah status ke Failed jika stok habis
                if ($status === 'Success') {
                    if ($event->stock > 0) {
                        $event->decrement('stock');
                        $event->stock--; // update local instance
                    } else {
                        // Batalkan transaksi sukses jika stok sudah habis
                        $status = 'Failed';
                    }
                }

                // Tanggal transaksi diacak antara 1 hingga 30 hari ke belakang agar bervariasi
                $randomDate = Carbon::now()->subDays($faker->numberBetween(1, 30))->subHours($faker->numberBetween(1, 24))->subMinutes($faker->numberBetween(1, 60));

                \App\Models\Transaction::create([
                    'event_id' => $event->id,
                    'order_id' => 'TRX-' . time() . '-' . $event->id . '-' . $i . '-' . $faker->numerify('####'),
                    'customer_name' => $randomUser->name,
                    'customer_email' => $randomUser->email,
                    'customer_phone' => $faker->phoneNumber,
                    'total_price' => $event->price,
                    'status' => $status,
                    'snap_token' => 'dummy-snap-' . \Illuminate\Support\Str::uuid(),
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);
            }
        }
    }
}
