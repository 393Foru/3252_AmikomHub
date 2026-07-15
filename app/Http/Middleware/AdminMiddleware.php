<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user sudah login DAN memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        // jika user biasa yang mencoba akses, tendang kembali ke halaman utama
        return redirect('/')->with('error', 'Kami tidak memiliki akses ke halaman admin.');
    }
}