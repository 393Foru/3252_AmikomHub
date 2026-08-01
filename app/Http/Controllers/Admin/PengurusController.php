<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\Jabatan;
use Illuminate\Routing\Controllers\HasMiddleware;

class PengurusController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (auth()->check() && auth()->user()->role === 'admin') {
                    abort(403, 'Super Admin tidak memiliki akses ke halaman ini.');
                }
                return $next($request);
            }
        ];
    }

    public function index()
    {
        $penguruses = Pengurus::with('jabatan')
            ->where('partner_id', auth()->user()->partner_id)
            ->latest()->paginate(10);
        return view('admin.pengurus.index', compact('penguruses'));
    }

    public function create()
    {
        $jabatans = Jabatan::all(); 
        return view('admin.pengurus.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jabatan_id' => 'required|exists:jabatans,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $data['created_by'] = auth()->user()->name;
        $data['partner_id'] = auth()->user()->partner_id;
        Pengurus::create($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        //
    }

    public function edit(Pengurus $pengurus)
    {
        if ($pengurus->partner_id != auth()->user()->partner_id) {
            abort(403, 'Unauthorized action.');
        }
        $jabatans = Jabatan::all(); 
        return view('admin.pengurus.edit', compact('pengurus', 'jabatans'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        if ($pengurus->partner_id != auth()->user()->partner_id) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->validate([
            'jabatan_id' => 'required|exists:jabatans,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $data['updated_by'] = auth()->user()->name;
        $pengurus->update($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->partner_id != auth()->user()->partner_id) {
            abort(403, 'Unauthorized action.');
        }
        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}