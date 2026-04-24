<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

//Route untuk Event
Route::get('/event/{id}', [EventController::class, 'show'])
    ->name('event.show');
Route::get('/event/{id}/checkout', [EventController::class, 'checkout'])
    ->name('event.checkout');


