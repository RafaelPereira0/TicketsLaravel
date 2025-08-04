<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [TicketController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/tickets', TicketController::class)->except('show')->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function(){
    Route::resource('/users', UserController::class)->except('show');
});



require __DIR__.'/auth.php';
