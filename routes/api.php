<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


/*  Routes API untuk Fitur Menu  */
Route::middleware('api')
    ->prefix('api')
    ->group(function () {
        //
    });


/*  Routes API untuk Fitur Order  */
Route::middleware('api')
    ->prefix('api')
    ->group(function () {
        Route::get('/order', [OrderController::class, 'index']);
        Route::get('/order/{id}', [OrderController::class, 'show']);
    });


/*  Routes API untuk Fitur Delivery  */
Route::middleware('api')
    ->prefix('api')
    ->group(function () {
        //
    });

/*  Routes API untuk Fitur Feedback  */
Route::middleware('api')
    ->prefix('api')
    ->group(function () {
        //
    });

/*  Routes API untuk Fitur Users  */
Route::middleware('api')
    ->prefix('api')
    ->group(function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/{id}', [UserController::class, 'show']);
    });



