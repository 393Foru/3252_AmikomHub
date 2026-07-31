<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Routing\Controllers\HasMiddleware;

class JabatanController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (auth()->check() && !auth()->user()->partner_id) {
                    abort(403, 'Super Admin tidak memiliki akses ke halaman ini.');
                }
                return $next($request);
            }
        ];
    }
    public function index(Request $request)
    {
        $query = Jabatan::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $jabatans = $query->latest()->paginate(10);
        return view('admin.jabatan.index', compact('jabatans'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
        ]);
        
        $data['created_by'] = auth()->user()->name; 
        Jabatan::create($data);

        return redirect()->route('admin.jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function show(Jabatan $jabatan)
    {
        // 
    }



    public function update(Request $request, Jabatan $jabatan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $data['updated_by'] = auth()->user()->name; 
        $jabatan->update($data);

        return redirect()->route('admin.jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        
        return redirect()->route('admin.jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}