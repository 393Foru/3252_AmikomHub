<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($this->throttleKey($request));
            $request->session()->regenerate();

            // Memanfaatkan fungsi isAdmin() yang sudah kita buat di Model User
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard'); 
            }

            // Jika yang login adalah member biasa, kembalikan ke HomeController
            return redirect()->route('home');
        }

        RateLimiter::hit($this->throttleKey($request));

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    protected function ensureIsNotRateLimited(Request $request)
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.',
        ]);
    }

    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
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