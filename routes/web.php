<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;

Route::namespace('Frontend')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
    Route::get('sayfa/{slug}', [FrontendController::class, 'showPage'])->name('frontend.page');
    Route::get('kategori/{slug}', [FrontendController::class, 'showCategory'])->name('frontend.category');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::middleware('admin')->group(function () {
        Route::get('/panel', [AdminController::class, 'index'])->name('dashboard');
    });
});

// Kullanıcı yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('users', UserController::class);
});

// Sayfa yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('pages', PageController::class);
});

// Kategori yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('categories', CategoryController::class);

    // Kategori oluşturma route'u
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

    // Kategori düzenleme route'u
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile'); // Profil görüntüleme
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit'); // Profil düzenleme
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update'); // Profil güncelleme
});

