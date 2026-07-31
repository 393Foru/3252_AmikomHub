<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;

class PartnerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                if (auth()->check() && auth()->user()->partner_id) {
                    abort(403, 'Unauthorized access.');
                }
                return $next($request);
            }
        ];
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $partners = Partner::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->get();

        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // Proses upload file ke folder storage/app/public/partners
        $logoPath = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'logo_url' => $logoPath,
        ]);

        return redirect()->back()->with('success', 'Partner berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Boleh kosong jika tidak ganti foto
        ]);

        $partner = Partner::findOrFail($id);
        $data = ['name' => $request->name];

        // Jika ada file logo baru yang diupload
        if ($request->hasFile('logo')) {
            // Hapus file foto lama dari server
            if (Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            // Upload foto baru
            $data['logo_url'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->back()->with('success', 'Partner berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        // Hapus file foto fisik dari server terlebih dahulu
        if (Storage::disk('public')->exists($partner->logo_url)) {
            Storage::disk('public')->delete($partner->logo_url);
        }
        
        // Hapus data dari database
        $partner->delete();

        return redirect()->back()->with('success', 'Partner berhasil dihapus!');
    }
}