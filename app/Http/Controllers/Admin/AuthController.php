<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //1. Fungsi menampilkan halaman view formulir
    public function showLogin() {
        return view('auth.login');
    }

    // 2. fungsi memproses validasi submit Log In
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard'); // Arahkan ke route dashboard
        }
        return back()->withErrors([
            'email'=>'Email atau password yang anda berikan tidak terdaftar di sistem kami. Silahkan coba lagi.'
        ]);
    }

    // 3. Fungsi memproses Logout (Keluar)
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}