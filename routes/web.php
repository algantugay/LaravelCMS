<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TamplateController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/login', [TamplateController::class, 'login'])->name("login.tamplate");
Route::get('/register', [TamplateController::class, 'register'])->name("register.tamplate");
Route::get('/dashboard', [TamplateController::class, 'dashboard'])->name("dashboard")->middleware('user');
Route::get('overview', [TamplateController::class, 'overview'])->name("profile.overview")->middleware('user');
Route::get('settings', [TamplateController::class, 'settings'])->name("profile.settings")->middleware('user');
Route::get('/logout', [TamplateController::class, 'logout'])->name("logout");

Route::get('/users/{id}', [RegisterController::class, 'show']);

Route::post('/update-email', [RegisterController::class, 'updateEmail'])->name('update-email');
Route::post('/update-password', [RegisterController::class, 'updatePassword'])->name('update-password');

Route::post('/login', [RegisterController::class, 'loginUser'])->name('login');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register');


Route::prefix('profile')->name('profile.')->group(function () {
    Route::post('/update', [RegisterController::class, 'updateName'])->name('update');
});
