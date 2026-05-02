<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\Admin\DashboardController;


// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{id}', [EventController::class,'show'])
->name('events.show');
Route::get('/checkout/{id}', [EventController::class, 'checkout'])
->name('checkout');
Route::get('/my-tickets', [EventController::class, 'ticket'])
->name('ticket');

// Route Admin Area
Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');
    Route::get('/events', [EventController::class, 'indexAdmin'])
    ->name('events.index');
    //dan seterusnya untuk route admin lainnya...
});