<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

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
        ->where('date', '>=', now())
        ->orderby('date', 'asc');

        // 3. filter query jika url memiliki parameter pencarian spesifik ?category=...
        if ($request->has('category')&& $request->category != ''){
            // saring berdasarkan relasi tabel rujukan melalui properti slug kategori
            $query->whereHas('category', function ($q) use ($request){
                $q->where('slug', $request->category);
            });
        }

        // 4. eksekusi query dan kirim data hasilnya ke template blade
        $events = $query->paginate(6);
        
        return view('welcome', compact('events', 'categories'));
    }
}
