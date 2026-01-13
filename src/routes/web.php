<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;

Route::get('/', [ItemController::class, 'index'])
    ->name('items.index');

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::get('/item/{item}', [ItemController::class, 'show'])
  ->name('items.show');


Route::middleware('auth')->group(function () {
  Route::get('/mypage', [MypageController::class, 'index'])
    ->name('mypage.index');
  Route::get('/mypage/profile', [MypageController::class, 'edit'])
    ->name('mypage.profile');
  Route::post('/mypage/profile', [MypageController::class, 'update'])
        ->name('mypage.profile.update');

  Route::get('/sell', [ItemController::class, 'create'])
    ->name('sell');

  Route::post('/items/{item}/like', [LikeController::class, 'toggle'])
    ->name('items.like');
  Route::post('/items/{item}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

  Route::get('/purchase/{item}', [ItemController::class, 'purchase'])
    ->name('purchase.index');
  Route::get('/purchase/address/{item}', [PurchaseController::class, 'editAddress'])
    ->name('purchase.address-change');
  Route::post('/purchase/address/{item}', [PurchaseController::class, 'storeAddress'])
    ->name('purchase.address.store');
  Route::post('/purchase', [PurchaseController::class, 'store'])
    ->name('purchase.store');

});
