<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua kategori untuk ditampilkan di tombol filter
        $categories = Category::all();

        // Membuat kerangka query event
        $query = Event::with('category')->latest();

        // Jika ada request kategori dari URL, saring datanya
        if ($request->has('category')) {
            $categorySlug = $request->category;
            
            // Asumsi relasi kategori menggunakan slug
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Eksekusi paginasi, misalnya 9 event per halaman
        $events = $query->paginate(9);

        return view('events.index', compact('events', 'categories'));
    }
    
        public function show($id)
    {
        return view('event-detail');
    }

    public function checkout($id)
    {
        return view('checkout');
    }
}
