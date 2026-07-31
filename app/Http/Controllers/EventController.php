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

        // Fitur Status (Mendatang / Terlewat)
        if ($request->has('status') && $request->status != 'semua') {
            if ($request->status == 'terlewat') {
                $query->where('date', '<', now());
            } elseif ($request->status == 'mendatang') {
                $query->where('date', '>=', now());
            }
        }

        // Fitur Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'terdekat':
                    $query->orderBy('date', 'asc');
                    break;
                case 'termurah':
                    $query->orderBy('price', 'asc');
                    break;
                case 'terbaru':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest(); // Default
        }

        // Eksekusi paginasi, 20 event per halaman (4 baris x 5 kolom)
        $events = $query->paginate(20);

        return view('events.index', compact('events', 'categories'));
    }
    
    public function show(Event $event)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = Category::all();

        // Mengambil 4 event serupa berdasarkan kategori yang sama (kecuali event ini sendiri)
        $similarEvents = Event::where('category_id', $event->category_id)
            ->where('id', '!=', $event->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $reviews = $event->reviews()->with('transaction')->latest()->limit(5)->get();
        $averageRating = $event->reviews()->avg('rating') ?? 0;

        // me-render view dengan membawa data kategori, event, dan similarEvents
        return view('event-detail', compact('event', 'categories', 'similarEvents', 'reviews', 'averageRating'));
    }

}
