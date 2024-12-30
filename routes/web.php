<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Frontend\FrontendController;


Route::get('/', function(){
    return view('Frontend.index');
});

// Yorum Yönetimi
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::put('admin/comments/{id}/status', [CommentController::class, 'updateStatus'])->name('admin.comments.updateStatus');
    Route::delete('/admin/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Admin LOGİN
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

// Admin Profili
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});

// Mesajlar kısmı
Route::prefix('admin')->middleware('admin')->group(function() {
    // Mesajları listele
    Route::get('/messages', [ContactController::class, 'listMessages'])->name('admin.messages');

    // Mesajı yanıtla formu göster
    Route::get('/messages/{id}/reply', [ContactController::class, 'showReplyForm'])->name('admin.messages.reply');

    // Yanıtı gönder
    Route::put('/messages/{id}/reply', [ContactController::class, 'submitReply'])->name('admin.messages.reply.submit');

    // Mesajı sil
    Route::delete('/messages/{message}/delete', [ContactController::class, 'destroy'])->name('admin.messages.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
});