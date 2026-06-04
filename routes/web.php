<?php

use App\Http\Controllers\APICoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiSignatureController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    if (Auth::check()) {
        return response('', 302)->header('Location', '/accueil_session');
    }
    return view('login');
})->name('login');

Route::post('/login', [ApiAuthController::class, 'login'])->name('login.post');


Route::middleware('auth')->group(function () {

    Route::get('/home', [APICoursController::class, 'index'])->name('home');

    Route::get('/sign/{id}', [ApiSignatureController::class, 'show'])->name('sign');

    Route::post('/sign', [ApiSignatureController::class, 'store'])->name('sign.store');

    Route::get('/logout', [ApiAuthController::class, 'logout'])->name('logout');

    
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil.show');

    
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');

    
    Route::post('/profil', [ProfilController::class, 'update'])->name('profil.update');
});
