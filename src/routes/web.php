<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;

Route::get('/', [ItemController::class, 'index'])
    ->name('items.index');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::get('/item/{item}', [ItemController::class, 'show'])
  ->name('items.show');

Route::middleware('auth')->group(function () {
  Route::get('/mypage', [MyPageController::class, 'index'])
    ->name('mypage.index');

  Route::get('/mypage/profile', [MypageController::class, 'edit'])
    ->name('mypage.profile');

  Route::post('/mypage/profile', [MypageController::class, 'update'])
        ->name('mypage.profile.update');

  Route::get('/sell', [ItemController::class, 'create'])
    ->name('sell');

  Route::post('/items/{item}/like', [LikeController::class, 'toggle'])
    ->name('items.like');

  Route::get('/purchase/{item}', [ItemController::class, 'purchase'])
    ->name('items.purchase');

});
