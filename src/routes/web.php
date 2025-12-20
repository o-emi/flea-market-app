<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class, 'index'])
    ->name('items.index');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/item/{item_id}', [ItemController::class, 'show'])
        ->name('items.show');

    Route::get('/mypage/profile', [MypageController::class, 'edit'])
        ->name('mypage.profile');

    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');
});
