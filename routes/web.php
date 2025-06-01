<?php

use App\Http\Controllers\OrderController; 
use App\Http\Controllers\MenuController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Routes bawaan untuk Fitur Profil */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*  Routes untuk Fitur Menu  */
    Route::controller(MenuController::class)
    ->prefix('menu')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'index')->name('menu');
        Route::get('create', 'create')->name('menu.create');
        Route::post('store', 'store')->name('menu.store');
        Route::get('show/{id}', 'show')->name('menu.show');
        Route::get('edit/{id}', 'edit')->name('menu.edit');
        Route::put('edit/{id}', 'update')->name('menu.update');
        Route::delete('destroy/{id}', 'destroy')->name('menu.destroy');
    });

    /*  Routes untuk Fitur Order  */
    Route::controller(OrderController::class)
    ->prefix('order')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'index')->name('order');
        Route::get('/create/{menu_code}', 'create')->name('order.create');
        Route::post('/store', 'store')->name('order.store');
        Route::get('/show/{id}', 'show')->name('order.show');
        Route::get('/edit/{id}', 'edit')->name('order.edit');
        Route::put('/edit/{id}', 'update')->name('order.update');
        Route::delete('/destroy/{id}', 'destroy')->name('order.destroy');
    });

    /*  Routes untuk Fitur Delivery  */


    /*  Routes untuk Fitur Feedback  */
    Route::controller(FeedbackController::class)
    ->prefix('feedback')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'index')->name('feedback.index');
        Route::get('create', 'create')->name('feedback.create');
        Route::post('store', 'store')->name('feedback.store');
        Route::get('show/{id}', 'show')->name('feedback.show');
        Route::get('edit/{id}', 'edit')->name('feedback.edit');
        Route::put('edit/{id}', 'update')->name('feedback.update');
        Route::delete('destroy/{id}', 'destroy')->name('feedback.destroy');
    });

    /*  Routes untuk Fitur Users  */
    Route::controller(UserController::class)
    ->prefix('user')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', 'index')->name('user');
        Route::get('/create/{menu_code}', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/show/{id}', 'show')->name('user.show');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::put('/edit/{id}', 'update')->name('user.update');
        Route::delete('/destroy/{id}', 'destroy')->name('user.destroy');
    });
    
});

// Untuk mendeteksi routes/api.php
if (file_exists(base_path('routes/api.php'))) {
    require base_path('routes/api.php');
}

require __DIR__.'/auth.php';
