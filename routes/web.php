<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController; 
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;


// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])
->name('events.index');
 
Route::get('/events/{event}', [EventController::class,'show'])
->name('events.show');
Route::get('/checkout/{id}', [EventController::class, 'checkout'])
->name('checkout');
Route::get('/tickets', [TicketController::class, 'ticket'])
->name('ticket');
Route::get('/cara-pesan', [HomeController::class, 'howToOrder'])
->name('how-to-order');

// =========================================================
// ROUTE AUTENTIFIKASI USER (biasa)
// =========================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// =========================================================
// ROUTE ADMIN AREA
// =========================================================
Route::prefix('admin')->name('admin.')->group(function (){
    // 1. Admin Guest (Belum Login)
    Route::middleware('guest')->group(function () {
        // ini untuk url: /admin/login
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });
    // 2. Admin Auth (Sudah Login)
    // Catatan: pastikan nanti kamu punya middleware tambahan (misal: role: admin)
    // agar user biasa yang login tidak masuk ke sini
    Route::middleware('auth')->group(function (){
        // ini untuk URL: /admin (halaman dashboard)
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        // CRUD ADMIN
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('transactions', AdminTransactionController::class);
        Route::resource('partners', AdminPartnerController::class);

        // ini untuk URL: /admin (halaman dashboard)
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD admin
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('transactions', AdminTransactionController::class);
        Route::resource('partners', AdminPartnerController::class);

        // Ini untuk URL: /admin/logout (mengatasi error RouteNotFoundExpection)
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
