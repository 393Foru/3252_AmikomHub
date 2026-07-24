<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\Jabatan;

class PengurusController extends Controller
{
    public function index()
    {
        $penguruses = Pengurus::with('jabatan')->latest()->paginate(10);
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
        Pengurus::create($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function show(Pengurus $pengurus)
    {
        //
    }

    public function edit(Pengurus $pengurus)
    {
        $jabatans = Jabatan::all(); 
        return view('admin.pengurus.edit', compact('pengurus', 'jabatans'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
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
        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}