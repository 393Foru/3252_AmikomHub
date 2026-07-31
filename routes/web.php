<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartnerController;
// =====================================================
// responsi UAS
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PengurusController;
// =====================================================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;


// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');

// Route Checkout
Route::get('/checkout/{event}', [\App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

// Route Payment
Route::get('/payment/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/failed/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'failed'])->name('checkout.failed');

// Route Midtrans Callback
Route::post(
    '/midtrans/callback',
    [\App\Http\Controllers\MidtransWebhookController::class, 'handle']
);

Route::get('/cara-pesan', [HomeController::class, 'howToOrder'])->name('how-to-order');
Route::get('/tentang-kami', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/karir', [HomeController::class, 'career'])->name('career');
Route::get('/program-kemitraan', [HomeController::class, 'partnershipProgram'])->name('partnership-program');
Route::get('/perlindungan-data', [HomeController::class, 'dataProtection'])->name('data-protection');
Route::get('/pusat-bantuan', [HomeController::class, 'helpCenter'])->name('help-center');
Route::get('/kebijakan-privasi', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/syarat-ketentuan', [HomeController::class, 'termsConditions'])->name('terms-conditions');

// =========================================================
// ROUTE AUTENTIFIKASI USER (biasa)
// =========================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// =========================================================
// ROUTE ADMIN AREA
// =========================================================
Route::prefix('admin')->name('admin.')->group(function () {
    // 1. Admin Guest (Belum Login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    // 2. Admin Auth (Sudah Login)
    Route::middleware('auth')->group(function () {
        // ini untuk URL: /admin (halaman dashboard)
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD ADMIN
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('partners', AdminPartnerController::class);

        // ==================================================================
        // responsi UAS
        Route::resource('jabatan', JabatanController::class);
        Route::resource('pengurus', PengurusController::class)->parameters([
            'pengurus' => 'pengurus'
        ]);
        // ==================================================================

        // Perbaikan Route Transactions Admin sesuai Modul 10
        Route::get('transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');

        // Ini untuk URL: /admin/logout (mengatasi error RouteNotFoundExpection)
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});