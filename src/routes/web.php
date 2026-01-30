<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', [ItemController::class, 'index'])
    ->name('items.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::get('/item/{item}', [ItemController::class, 'show'])
    ->name('items.show');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $request->session()->forget('url.intended');

    return redirect()->route('mypage.profile.edit')
        ->with('status', 'メール認証が完了しました');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', '認証メールを再送しました');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])
    ->name('mypage.index');
    Route::get('/mypage/profile', [MypageController::class, 'edit'])
    ->name('mypage.profile.edit');
    Route::post('/mypage/profile', [MypageController::class, 'update'])
        ->name('mypage.profile.update');

    Route::get('/sell', [ItemController::class, 'create'])
    ->name('sell');
    Route::post('/items', [ItemController::class, 'store'])
    ->name('items.store');

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
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
    ->name('purchase.store');

});
