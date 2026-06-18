<?php

use App\Http\Controllers\APICoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiSignatureController;
use App\Http\Controllers\ApiProfilController;
use App\Http\Controllers\ApiPasswordController;
use App\Http\Controllers\ApiJustificatifController;



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

    Route::get('/profil', [ApiProfilController::class, 'show'])->name('profil.show');

    Route::get('/profil/edit', [ApiProfilController::class, 'edit'])->name('profil.edit');

    Route::post('/profil', [ApiProfilController::class, 'update'])->name('profil.update');

    Route::get('/profil/password', [ApiPasswordController::class, 'edit'])->name('profil.passwordEdit');

    Route::post('/profil/password', [ApiPasswordController::class, 'update'])->name('profil.passwordUpdate');

    Route::get('/justificatif/create', [ApiJustificatifController::class, 'create'])->name('justificatif.create');

    Route::post('/justificatif', [ApiJustificatifController::class, 'store'])->name('justificatif.store');
});
