<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. adkun admin utama
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // insert kategori event
        $category = \App\Models\Category::create([
            'name' => 'seminar IT',
            'slug' => 'seminar-it',
        ]);

        $category2 = \App\Models\Category::firstOrCreate([
            'name' => 'Entertaiment',
            'slug' => 'entertaiment',
        ]);

        $category3 = \App\Models\Category::firstOrCreate([
            'name' => 'Workshop',
            'slug' => 'workshop',
        ]);

        $category4 = \App\Models\Category::firstOrCreate([
            'name' => 'lomba IT',
            'slug' => 'lomba-it',
        ]);

        $category5 = \App\Models\Category::firstOrCreate([
            'name' => 'sosialisasi',
            'slug' => 'sosialisasi',
        ]);

        $category6 = \App\Models\Category::firstOrCreate([
            'name' => 'job fair',
            'slug' => 'job-fair',
        ]);

        $category7 = \App\Models\Category::firstOrCreate([
            'name' => 'pameran',
            'slug' => 'pameran',
        ]);

        $category8 = \App\Models\Category::firstOrCreate([
            'name' => 'lainnya',
            'slug' => 'lainnya',
        ]);

        // 3. insert sampel events
        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title' => 'Jazz Night 2025',
            'description' => 'Nikmati malam yang indah dengan alunan musik Jazz yang merdu.',
            'date' => '2026-07-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'public/posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'Hackaton - unleash your inner developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
            'date' => '2026-07-05 10:00:00',
            'location' => 'inkubator Amikom',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'public/posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category->id,
            'title' => 'AI & FUTURE TECH SUMMIT 2026',
            'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli di bidangnya.',
            'date' => '2026-07-01 13:00:00',
            'location' => 'Cinema Unit 6',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'public/posters/event-3.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title' => 'Workshop Flutter',
            'description' => 'Pelajari cara membuat aplikasi mobile yang menarik dan responsif dengan Flutter, framework pengembangan aplikasi yang sedang naik daun.',
            'date' => '2026-07-15 09:00:00',
            'location' => 'inkubator Amikom',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => '',
        ]);

        \App\Models\Event::create([
            'category_id' => $category4->id,
            'title' => 'Lomba Desain UI/UX',
            'description' => 'Tunjukkan kreativitas dan keahlian desain kamu dalam lomba desain UI/UX yang menantang ini, dan raih kesempatan untuk memenangkan hadiah menarik!',
            'date' => '2026-07-20 14:00:00',
            'location' => 'inkubator Amikom',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => '',
        ]);

        \App\Models\Event::create([
            'category_id' => $category5->id,
            'title' => 'Sosialisasi Program Magang',
            'description' => 'Dapatkan informasi lengkap tentang program magang yang tersedia, persyaratan, dan tips sukses untuk memulai karir profesional kamu.',
            'date' => '2026-07-25 10:00:00',
            'location' => 'Cinema Unit 6',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => '',
        ]);

            \App\Models\Event::create([
            'category_id' => $category6->id,
            'title' => 'Pameran Teknologi Inovatif',
            'description' => 'Jelajahi berbagai inovasi teknologi terbaru dari berbagai bidang, mulai dari kecerdasan buatan hingga teknologi ramah lingkungan, dalam pameran yang menarik ini.',
            'date' => '2026-07-30 09:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => '',
        ]);
    }
}
