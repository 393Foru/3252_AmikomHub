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
        ->orderByRaw('ABS(UNIX_TIMESTAMP(date) - UNIX_TIMESTAMP(NOW())) ASC');

        // 3. filter query jika url memiliki parameter pencarian spesifik ?category=...
        if ($request->has('category')&& $request->category != ''){
            // saring berdasarkan relasi tabel rujukan melalui properti slug kategori
            $query->whereHas('category', function ($q) use ($request){
                $q->where('slug', $request->category);
            });
        }

        // 4. eksekusi query dan kirim data hasilnya ke template blade (dinamis berdasarkan perangkat)
        $isMobile = false;
        if ($request->hasHeader('User-Agent')) {
            $isMobile = preg_match("/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i", $request->header('User-Agent'));
        }
        $limit = $isMobile ? 4 : 6;
        $events = $query->paginate($limit);


        // Mengambil seluruh partner terbaru untuk ditampilkan di section sponsor
        $partners = Partner::latest()->get();

        
        return view('welcome', compact('events', 'categories', 'partners'));
    }

    public function howToOrder()
    {
        return view('how-to-order');
    }
}
