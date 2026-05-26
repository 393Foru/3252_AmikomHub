<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Memanfaatkan fungsi isAdmin() yang sudah kita buat di Model User
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard'); 
            }

            // Jika yang login adalah member biasa, kembalikan ke HomeController
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan halaman form pendaftaran
    public function showRegisterForm()
    {
        return view('auth.register');
    }

   // Memproses data pendaftaran
    public function register(Request $request)
    {
        // 1. Validasi inputan dari form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // unique:users memastikan email tidak boleh ada yang sama di database
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 
            // confirmed memastikan password sama dengan inputan 'password_confirmation'
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // 2. Simpan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Password WAJIB di-hash (diacak) demi keamanan, jangan disimpan mentah-mentah
            'password' => Hash::make($request->password), 
            // Kita tidak perlu memasukkan 'role' di sini karena otomatis terisi 'member' dari database
        ]);

        // 3. Otomatis loginkan user setelah berhasil mendaftar
        Auth::login($user);

        // 4. Arahkan pengguna kembali ke halaman utama
        return redirect('/');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}