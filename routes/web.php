<?php

use App\Http\Controllers\APICoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiSignatureController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::post('/login', [ApiAuthController::class, 'login'])->name('login.post');


Route::middleware('auth')->group(function () {

    Route::get('/home', [APICoursController::class, 'index'])->name('home');

    Route::get('/sign/{id}', [ApiSignatureController::class, 'show'])->name('sign');

    Route::post('/sign', [ApiSignatureController::class, 'store'])->name('sign.store');

    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout');
});
