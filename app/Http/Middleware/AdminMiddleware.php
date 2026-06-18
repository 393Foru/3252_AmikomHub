<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardConntroller;
use App\Http\Controllers\Admin\EventContrller;
use App\Http\Controllers\Admin\TransactionController;

Route::get('/login', function (){
    return redirect()->route('admin.login');
})->name('login');

// Grouping untuk URL berawalan /admin
Route::prefix('admin')->name('admin.')->group(function(){
    // rute login bebas akses
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Mengamankan Route Administrasi di balik tembok (Middleware)
    Route::middleware(['auth', 'admin'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', EventController::class);
        Route::get('transactions', [TransactionController::class, 'index'])->name('transaction.index');
    });
});