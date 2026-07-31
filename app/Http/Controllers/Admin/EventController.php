<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = \App\Models\Event::with('category')->withCount(['transactions as tickets_sold' => function($q) {
            $q->whereIn('status', ['settlement', 'success']);
        }])->orderBy('date', 'desc');
        
        if ($user->partner_id) {
            $query->where('partner_id', $user->partner_id);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan bulan
        if ($request->filled('month')) {
            $query->whereMonth('date', $request->month);
        }

        $events = $query->paginate(10)->withQueryString();
        $categories = \App\Models\Category::all();
        
        return view('admin.events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // menerapkan validasi data request dari pengguna
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'poster' => 'nullable|image|max:15360' // Maksimal 15MB
        ]);

        if ($request->hasFile('poster')) {
        // Simpan ke direktori storage/app/public/posters
        $data['poster_path'] = $request->file('poster')->store('posters','public');
        }

        if (auth()->user()->partner_id) {
            $data['partner_id'] = auth()->user()->partner_id;
        }

        // menyimpan data yang telah divalidasi ke dalam tabel menggunakan Model
        \App\Models\Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Data Event berhasil ditambahkan.');
    }

    public function destroy(Event $event)
    {
        if (auth()->user()->partner_id && $event->partner_id != auth()->user()->partner_id) {
            abort(403, 'Unauthorized action.');
        }

        // Mengecek apakah event memiliki gambar poster yang tersimpan
        if ($event->poster_path) {
            // Menghapus file gambar fisik dari direktori storage
            \Illuminate\Support\Facades\Storage::disk('public')->delete($event->poster_path);
        }

        // Menghapus data event dari database
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Data event beserta posternya berhasil dihapus secara permanen.');
    }

    public function edit(Event $event)
    {
        if (auth()->user()->partner_id && $event->partner_id != auth()->user()->partner_id) {
            abort(403, 'Unauthorized action.');
        }

        $categories = \App\Models\Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(\Illuminate\Http\Request $request, Event $event)
    {
        if (auth()->user()->partner_id && $event->partner_id != auth()->user()->partner_id) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'poster' => 'nullable|image|max:15360' // Maksimal 15MB
        ]);

        if ($request->hasFile('poster')) {
        // Hapus gambar lama jika sebelumnya sudah memiliki poster
            if ($event->poster_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($event->poster_path);
            }
        // Upload gambar baru
        $data['poster_path'] = $request->file('poster')->store('posters','public');
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Rincian data event berhasil diperbarui.');
    }
}
