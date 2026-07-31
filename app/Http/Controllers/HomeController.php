<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. ambil semua jenis kategori untuk tampilan filter tab button
        $categories = Category::all();

        // 2. buat kueri dasar untuk mengambil event:
        // - gunakan eager loading 'category'
        // - hanya tampilkan kegiatan dengan jadwal yang belum kadaluarsa
        // (>= hari ini)
        $query = Event::with('category')
            ->orderBy('date', 'asc');

        // 3. filter query jika url memiliki parameter pencarian spesifik ?category=...
        if ($request->has('category') && $request->category != '') {
            // saring berdasarkan relasi tabel rujukan melalui properti slug kategori
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 4. eksekusi query dan kirim data hasilnya ke template blade
        $limit = 4;
        $events = $query->paginate($limit);


        // Mengambil seluruh partner terbaru untuk ditampilkan di section sponsor
        $partners = Partner::latest()->get();

        // Mengambil 4 event secara acak untuk Rekomendasi
        $recommendedEvents = Event::with('category')->where('date', '>=', now())->inRandomOrder()->limit(4)->get();

        return view('welcome', compact('events', 'categories', 'partners', 'recommendedEvents'));
    }

    public function howToOrder()
    {
        return view('how-to-order');
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function career()
    {
        return view('career');
    }

    public function partnershipProgram()
    {
        return view('partnership-program');
    }

    public function dataProtection()
    {
        return view('data-protection');
    }
}
