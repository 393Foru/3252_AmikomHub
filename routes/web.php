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

// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])
->name('events.index');
 
Route::get('/events/{id}', [EventController::class,'show'])
->name('events.show');
Route::get('/checkout/{id}', [EventController::class, 'checkout'])
->name('checkout');
Route::get('/tickets', [TicketController::class, 'ticket'])
->name('ticket');

Route::get('/cara-pesan', [HomeController::class, 'howToOrder'])
->name('how-to-order');

// Route Admin Area sesuai modul praktikum 5
Route::prefix('admin')->name('admin.')->group(function ()
{
    // Ini untuk URL: /admin (Halaman Dashboard)
    Route::get('/', [AdminDashboardController::class, 'index'])
    ->name('dashboard');

    // ini untuk URL: /admin/categories (Halaman CRUD Kategori)
    Route::resource('categories', AdminCategoryController::class);

    // Ini untuk URL: /admin/events (Halaman CRUD Event)
    Route::resource('events', AdminEventController::class);
    
    // Ini untuk URL: /admin/transactions (Halaman CRUD Transaksi)
    Route::resource('transactions', AdminTransactionController::class);

    // Ini untuk URL: /admin/partners (Halaman CRUD Partner)
    Route::resource('partners', AdminPartnerController::class);
});

// // Route Admin Area
// Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
//     Route::get('/', [DashboardController::class, 'index'])
//     ->name('dashboard');
//     Route::get('/events', [AdminEventController::class, 'index'])
//     ->name('events.index');
//     Route::get('/categories', [AdminCategoryController::class, 'index'])
//     ->name('categories.index');
//     //dan seterusnya untuk route admin lainnya...
// });

// ... rute beranda kamu yang sudah ada ...

// Route Autentikasi (Guest / Belum Login)
Route::middleware('guest')->group(function () {
    // Route Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Route Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Route Logout (Harus sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');