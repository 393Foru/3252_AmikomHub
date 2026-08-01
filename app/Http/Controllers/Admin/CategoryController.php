<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str; // <-- 1. Tambahkan baris ini di atas untuk membuat slug otomatis
use Illuminate\Routing\Controllers\HasMiddleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (auth()->check() && auth()->user()->role === 'partner') {
                    abort(403, 'Admin Partner tidak memiliki akses ke halaman ini.');
                }
                return $next($request);
            }
        ];
    }

    public function index(Request $request)
    {
        // Mengambil keyword pencarian dari input bernama 'search'
        $search = $request->input('search');

        // Query dasar: jika ada keyword, lakukan LIKE search. Jika tidak, ambil semua.
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    // CREATE: Menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) // <-- 2. Tambahkan pengisian slug otomatis di sini
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    // UPDATE: Memperbarui nama kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id
        ]);

        $category = Category::findOrFail($id);
        
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) // <-- 3. Tambahkan juga di sini saat di-update
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    // DELETE: Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}